<?php
ob_start();
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendResetLink($user_email, $firstname, $fullname, $reset_link)
{
    date_default_timezone_set('Africa/Nairobi');

    require '../../vendor/autoload.php'; // Path to composer autoload


    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'xxxxxx@gmail.com';
        $mail->Password = 'xxxxxx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        $mail->setFrom('xxxxxx@gmail.com', 'Bulk Emails');
        $mail->addAddress($user_email, $fullname);
        $mail->addReplyTo('xxxxxx@gmail.com', 'Bulk Emails');


        $mail->isHTML(true);
        $mail->Subject = 'Reset your Password';
        $mail->Body = '
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 576px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
    
                .card {
                    border: 1px solid #e1e1e1;
                    border-radius: 5px;
                    padding: 20px;
                    background-color: #ffffff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 550px;

                }

                h3 {
                    color: #333333;
                    font-size: 1.5rem;
                    text-align: center;
                }

                p {
                    color: #555555;
                    font-size: 1rem;
                }

                a.button {
                    display: inline-block;
                    padding: 1rem 2rem;
                    background-color: #4834d4;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 0.875rem;
                }

                img {
                    max-width: 100%;
                    height: auto;
                }

                footer {
                    margin-top: 10px;
                    text-align: center;
                    color: #ffffff;
                    font-size: 0.875rem; /* 14px */
                    background: linear-gradient(to right, #3498db, #2980b9, #1f618d, #154360, #0b325e); /* Shades of blue */
                    padding: 10px;
                    max-width: 576px;
                    border-radius: 0 0 10px 10px; /* Rounded bottom corners */
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="card">
                    <h3>Password Reset</h3>
                    <p><strong>Hey ' . $firstname . ',</strong></p>
                    <p>You are receiving this email because we received a password reset request for your account.</p>
        
                    <p>This link is valid for 10 minutes.</p>
                    <p>Click the button below to reset your password:</p>
                    <a href="' . $reset_link . '" class="button">Reset Password</a>
        
                    <p>If you did not make such a request, please disregard this message.</p>
                </div>
                <footer>Bulk Emails</footer>
            </div>
        </body>
        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

require_once './includes/config.php';
require_once './includes/mysqli_connection.php';
$response = [
    'success' => false,
    'message' => 'Cannot complete request.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = trim($_POST['email']);

    if (empty($user_email)) {
        $response = [
            'success' => false,
            'message' => 'Please provide your registered email.'
        ];
    } else {
        $query = "SELECT user_id, first_name, CONCAT(first_name, ' ', last_name) AS fullname FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_id, $firstname, $fullname);
            mysqli_stmt_fetch($stmt);

            $token = bin2hex(random_bytes(32));

            $expFormat = mktime(
                date("H"),
                date("i") + 10,
                date("s"),
                date("m"),
                date("d"),
                date("Y")
            );

            $expDate = date("Y-m-d H:i:s", $expFormat);
            $reset_link = "http://localhost/bulk-email/dashboard/user/reset-password.php?email=$user_email&token=$token";

            $updateQuery = "UPDATE users SET token = ?, token_expiry = ? WHERE email = ?";
            $statement = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($statement, "sss", $param_token, $param_expiry, $param_email);

            $param_token = $token;
            $param_expiry = $expDate;
            $param_email = $user_email;

            if (mysqli_stmt_execute($statement)) {
                $resetMail = sendResetLink($user_email, $firstname, $fullname, $reset_link);
                if ($resetMail) {
                    $response = [
                        'success' => true,
                        'message' => 'We have sent a password reset link to your email.',
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Failed to send reset link.',
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong.',
                ];
            }
            mysqli_stmt_close($statement);

        } else {
            $response = [
                'success' => false,
                'message' => 'No account associated with that email.'
            ];
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
ob_end_clean();

echo json_encode($response);