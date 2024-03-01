<?php
header('Content-Type: application/json');

include_once './includes/config.php';
include_once './includes/mysqli_connection.php';

$response = [
    'success' => false,
    'message' => 'Cannot complete request.'
];

$password_err = $confirm_password_err = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $token = trim($_POST["reset-link-token"]);
    // $password = trim($_POST["new-password"]);

    if (empty(trim($_POST["new-password"]))) {
        $password_err = "Please enter a password.";
        $response = [
            'success' => false,
            'message' => 'Please enter a password.'
        ];
    } elseif (strlen(trim($_POST["new-password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
        $response = [
            'success' => false,
            'message' => 'Password must have at least 8 characters.'
        ];
    } else {
        $password = trim($_POST['new-password']);
    }

    if (empty(trim($_POST["confirm-new-password"]))) {
        $confirm_password_err = "Please confirm password.";
        $response = [
            'success' => false,
            'message' => 'Please confirm password.'
        ];
    } else {
        $confirm_password = trim($_POST['confirm-new-password']);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
            $response = [
                'success' => false,
                'message' => 'Password did not match.'
            ];
        }
    }

    if (empty($password_err) && empty($confirm_password_err)) {
        $query = "SELECT user_id, email, token, token_expiry FROM users WHERE email = ? AND token = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_token);

            $param_email = $email;
            $param_token = $token;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $updateQuery = "UPDATE users SET password = ?, token = NULL, token_expiry = NULL WHERE email = ?";

                    if ($update_stmt = mysqli_prepare($conn, $updateQuery)) {
                        mysqli_stmt_bind_param($update_stmt, "ss", $param_new_pass, $param_user_email);

                        $param_new_pass = password_hash($password, PASSWORD_DEFAULT);
                        $param_user_email = $email;

                        if (mysqli_stmt_execute($update_stmt)) {
                            $response = [
                                'success' => true,
                                'message' => 'Password updated successfully.'
                            ];
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Failed to update password.'
                            ];
                        }
                        mysqli_stmt_close($update_stmt);
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'An error occurred.'
                        ];
                    }
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Cannot updated password for this account.'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Something went wrong. Please request a new reset link.'
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
    mysqli_close($conn);
} else {
    $response = [
        'success' => false,
        'message' => 'cannont complete request.'
    ];

}

echo json_encode($response);