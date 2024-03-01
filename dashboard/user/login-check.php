<?php
header('Content-Type: application/json');

include_once './includes/config.php';
include_once './includes/mysqli_connection.php';


$response = [
    'success' => false,
    'message' => 'unexpected error occurred.'
];

$email = $password = "";
$email_err = $password_err = $verification_err = "";
$redirect = './verification.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
        $response = [
            'success' => false,
            'message' => 'Please enter your email.'
        ];
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
        $response = [
            'success' => false,
            'message' => 'Please enter your password.'
        ];
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS fullname, email, username, verified, password FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $userId, $fullname, $email, $username, $verification_status, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        if ($verification_status == 0) {
                            $verification_err = "Please verify your account.";
                            $response = [
                                'success' => false,
                                'message' => 'Please verify your account.',
                                'redirect' => $redirect,
                                'email' => $email
                            ];
                        } else {
                            if (password_verify($password, $hashed_password)) {
                                $sub_query = "SELECT DATE_FORMAT(sub_expiry, '%d-%b-%Y') AS formattedDate,
                                            CASE
                                                WHEN sub_status = 1 THEN 'Active'
                                                WHEN sub_status = 2 THEN 'Pending'
                                                WHEN sub_status = 0 THEN 'Expired'
                                                ELSE 'Expired'
                                            END AS sub_status, package,
                                            CASE
                                                WHEN package = 1 THEN 'Free'
                                                WHEN package = 2 THEN 'Basic'
                                                WHEN package = 3 THEN 'Professional'
                                                WHEN package = 4 THEN 'Enterprise'
                                                ELSE 'No active subscription'
                                            END AS subscription
                                            FROM subscriptions
                                            WHERE user_id = ?";

                                if ($stmt_sub = mysqli_prepare($conn, $sub_query)) {
                                    mysqli_stmt_bind_param($stmt_sub, "i", $userId);

                                    if (mysqli_stmt_execute($stmt_sub)) {
                                        mysqli_stmt_store_result($stmt_sub);

                                        if (mysqli_stmt_num_rows($stmt_sub) == 1) {
                                            mysqli_stmt_bind_result($stmt_sub, $sub_expiry, $subscription_status, $package, $subscription_package);

                                            if (mysqli_stmt_fetch($stmt_sub)) {
                                                date_default_timezone_set('Africa/Nairobi');
                                                $todayDate = date('Y-m-d');
                                                $sub_expiry_check = date('Y-m-d', strtotime($sub_expiry_2));

                                                session_start();

                                                $_SESSION["loggedin"] = true;
                                                $_SESSION["id"] = $userId;
                                                $_SESSION["email"] = $email;
                                                $_SESSION["fullname"] = $fullname;
                                                $_SESSION["username"] = $username;
                                                $_SESSION["user_type"] = 2;
                                                $_SESSION["subscription"] = $subscription_package;
                                                $_SESSION["sub_expiry"] = $sub_expiry;
                                                $_SESSION["sub_status"] = $subscription_status;

                                                $response = [
                                                    'success' => true,
                                                    'message' => 'Successfully logged in.'
                                                ];
                                            }
                                        } else if (mysqli_stmt_num_rows($stmt_sub) == 0) {
                                            session_start();

                                            $_SESSION["loggedin"] = true;
                                            $_SESSION["id"] = $userId;
                                            $_SESSION["email"] = $email;
                                            $_SESSION["fullname"] = $fullname;
                                            $_SESSION["username"] = $username;
                                            $_SESSION["user_type"] = 2;
                                            $_SESSION["subscription"] = '';
                                            $_SESSION["sub_expiry"] = '';
                                            $_SESSION["sub_status"] = '';

                                            $response = [
                                                'success' => true,
                                                'message' => 'Successfully logged in.'
                                            ];
                                        }
                                    }
                                    mysqli_stmt_close($stmt_sub);
                                }
                            } else {
                                $password_err = "The password you entered was not valid.";
                                $response = [
                                    'success' => false,
                                    'message' => 'The password you entered was not valid.'
                                ];
                            }
                        }
                    }
                } else {
                    $email_err = "No account found with that email.";
                    $response = [
                        'success' => false,
                        'message' => 'No account found with that email.'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ];
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}

echo json_encode($response);
