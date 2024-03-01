<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ob_start();
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Function to send verification email
function sendVerificationEmail($user_email, $otp, $firstname, $lastname)
{
    date_default_timezone_set('Africa/Nairobi');
    require '../../vendor/autoload.php'; // Path to composer autoload

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'felixprogrammer76@gmail.com';
        $mail->Password = 'yodxzwuqsjprfqde';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        //$mail->Port = 587; // Port for TLS
        $mail->Port = 465; // Port for SMTPS
        $mail->setFrom('felixprogrammer76@gmail.com', 'Bulk Emails');
        $mail->addAddress($user_email, $firstname . ' ' . $lastname);
        $mail->addReplyTo('felixprogrammer76@gmail.com', 'Bulk Emails');

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = '
            <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Verify Your Account Email</title>
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
                        max-width: 550px;
                        border-radius: 0 0 10px 10px; /* Rounded bottom corners */
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="card">
                        <h3>Email Verification</h3>
                        <p><strong>Dear ' . $firstname . ',</strong></p>
                        <p>Please use the following code to verify your email: <strong>' . $otp . '</strong></p>
                        <p>The code is only valid for one day. After which you will need to request another one if you will not have verified your email.</p>
                        <p>Thank you.</p>
                    </div>
                    <footer>Bulk Emails</footer>
                </div>
            </body>
            </html>
        ';

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}

include_once './includes/config.php';
include_once './includes/mysqli_connection.php';

$response = [
    'success' => false,
    'message' => 'An unexpected error occurred.'
];

$username = $password = $confirm_password = $firstname = $lastname = $email = null;
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $email_err = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
        $response = [
            'success' => false,
            'message' => 'Please enter a username.'
        ];
    } else {
        $sql = "SELECT user_id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $username_err = "This username is already taken.";
                    $response = [
                        'success' => false,
                        'message' => 'This username is already taken.'
                    ];
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }

            mysqli_stmt_close($stmt);
        } else {
            $response = [
                'success' => false,
                'message' => 'An error occurred.'
            ];
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
        $response = [
            'success' => false,
            'message' => 'Please enter a password.'
        ];
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
        $response = [
            'success' => false,
            'message' => 'Password must have at least 8 characters.'
        ];
    } else {
        $password = trim($_POST['password']);
    }

    if (empty(trim($_POST["conf_password"]))) {
        $confirm_password_err = "Please confirm password.";
        $response = [
            'success' => false,
            'message' => 'Please confirm password.'
        ];
    } else {
        $confirm_password = trim($_POST['conf_password']);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
            $response = [
                'success' => false,
                'message' => 'Password did not match.'
            ];
        }
    }

    if (empty(trim($_POST["first_name"]))) {
        $firstname_err = "Firstname cannot be empty";
        $response = [
            'success' => false,
            'message' => 'Firstname cannot be empty.'
        ];
    } else {
        $firstname = trim($_POST['first_name']);
    }

    if (empty(trim($_POST["last_name"]))) {
        $lastname_err = "Lastname cannot be empty";
        $response = [
            'success' => false,
            'message' => 'Lastname cannot be empty.'
        ];
    } else {
        $lastname = trim($_POST['last_name']);
    }

    if (empty(trim($_POST["email_address"]))) {
        $email_err = "Email cannot be empty";
        $response = [
            'success' => false,
            'message' => 'Email cannot be empty.'
        ];
    } else {
        $email_query = "SELECT user_id FROM users WHERE email = ?";
        if ($statement = mysqli_prepare($conn, $email_query)) {
            mysqli_stmt_bind_param($statement, "s", $param_user_email);

            $param_user_email = trim($_POST["email_address"]);

            if (mysqli_stmt_execute($statement)) {
                mysqli_stmt_store_result($statement);

                if (mysqli_stmt_num_rows($statement) > 0) {
                    $email_err = "An account with that email already exists.";
                    $response = [
                        'success' => false,
                        'message' => 'An account with that email already exists.'
                    ];
                } else {
                    $email = trim($_POST['email_address']);
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }

            mysqli_stmt_close($statement);
        } else {
            $response = [
                'success' => false,
                'message' => 'An error occurred.'
            ];
        }
    }



    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err)) {
        $otp = mt_rand(100000, 999999);
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );

        $expDate = date("Y-m-d H:i:s", $expFormat);
        $query = "INSERT INTO users (first_name, last_name, email, username, password, code, code_expiry, registerDate ) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssssis', $param_firstname, $param_lastname, $param_email, $param_username, $param_password, $param_code, $param_code_expiry);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_code = $otp;
            $param_code_expiry = $expDate;

            if (mysqli_stmt_execute($stmt)) {
                $email_otp = sendVerificationEmail($email, $otp, $firstname, $lastname);
                if ($email_otp) {
                    $response = [
                        'success' => true,
                        'message' => 'We have sent a verification code to your email account. Use the code to verify and start using your account.',
                        'email' => $email
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Failed to send verification code.',
                    ];
                }

            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = [
                'success' => false,
                'message' => 'An error occurred.'
            ];
        }

        // Generate the referral link
        $referral_token = bin2hex(random_bytes(16));
        $referral_link = "https://2e85-105-162-50-190.ngrok-free.app/purple-pay-v3-final/PurplePay/sign-up.php?ref=$username-$referral_token";
    }
    mysqli_close($conn);
}
ob_end_clean();

echo json_encode($response);