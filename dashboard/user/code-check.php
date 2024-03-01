<?php
header('Content-Type: application/json');

include_once './includes/config.php';
include_once './includes/mysqli_connection.php';


$response = [
    'success' => false,
    'message' => 'An unexpected error occurred.'
];

$redirect = 'login';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['code']);
    $userEmail = trim($_POST['email']);

    $sql = "SELECT user_id, email, code, code_expiry, verified FROM users WHERE email = ? AND code = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $param_email, $param_code);

        $param_email = $userEmail;
        $param_code = $code;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $user_id, $user_email, $activation_code, $code_expiry, $status);
                mysqli_stmt_fetch($stmt);

                $curDate = date("Y-m-d H:i:s");

                if ($status == 1) {
                    $response = [
                        'success' => false,
                        'message' => 'Email is already verified.',
                        'redirect' => $redirect
                    ];
                } elseif ($code_expiry < $curDate) {
                    $response = [
                        'success' => false,
                        'message' => 'This code has already expired.',
                    ];
                } else {
                    $query = "UPDATE users SET verified = ?, code = NULL, code_expiry = NULL WHERE user_id = ? AND code = ?";

                    if ($statement = mysqli_prepare($conn, $query)) {
                        mysqli_stmt_bind_param($statement, "iii", $param_verified, $user_id, $param_userCode);

                        $param_verified = 1;
                        $param_id = $user_id;
                        $param_userCode = $code;

                        if (mysqli_stmt_execute($statement)) {
                            if (mysqli_affected_rows($conn) > 0) {
                                $response = [
                                    'success' => true,
                                    'message' => 'Email has been verified.'
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Invalid verification details.'
                                ];
                            }
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Verification failed.'
                            ];
                        }
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Cannot complete your request.'
                        ];
                    }
                    mysqli_stmt_close($statement);
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid verification details.'
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
            'message' => 'Cannot complete your request.'
        ];
    }

}
echo json_encode($response);