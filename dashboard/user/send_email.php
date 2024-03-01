<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ob_start();
header('Content-Type: application/json');

require_once '../../vendor/autoload.php'; // Path to composer autoload

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Function to send verification email
function sendBulkEmail($sender_email, $password, $recipient, $subject, $message, $sender_name, $attachments = [])
{
    date_default_timezone_set('Africa/Nairobi');
    // require '../../vendor/autoload.php'; // Path to composer autoload

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $sender_email;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        //$mail->Port = 587; // Port for TLS
        $mail->Port = 465; // Port for SMTPS
        $mail->setFrom($sender_email, $sender_name);

        $mail->addAddress(trim($recipient));

        // $mail->addAddress($email, $firstname . ' ' . $lastname);
        $mail->addReplyTo($sender_email, $sender_name);

        // Add attachments
        foreach ($attachments as $attachment) {
            $mail->addAttachment($attachment['tmp_name'], $attachment['name']);
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        // $mail->Body = '
        //     <html>
        //     <head>
        //         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        //         <title>Verify Your Account Email</title>
        //         <style>
        //             body {
        //                 font-family: Arial, sans-serif;
        //                 background-color: #f4f4f4;
        //                 margin: 0;
        //                 padding: 0;
        //             }

        //             .container {
        //                 max-width: 576px;
        //                 margin: 0 auto;
        //                 padding: 20px;
        //                 background-color: #ffffff;
        //                 border-radius: 10px;
        //                 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        //             }

        //             .card {
        //                 border: 1px solid #e1e1e1;
        //                 border-radius: 5px;
        //                 padding: 20px;
        //                 background-color: #ffffff;
        //                 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        //                 max-width: 550px;

        //             }

        //             h3 {
        //                 color: #333333;
        //                 font-size: 1.5rem;
        //                 text-align: center;
        //             }

        //             p {
        //                 color: #555555;
        //                 font-size: 1rem;
        //             }

        //             a.button {
        //                 display: inline-block;
        //                 padding: 1rem 2rem;
        //                 background-color: #674188;
        //                 color: #ffffff;
        //                 text-decoration: none;
        //                 border-radius: 5px;
        //                 font-size: 0.875rem;
        //             }

        //             img {
        //                 max-width: 100%;
        //                 height: auto;
        //             }

        //             footer {
        //                 margin-top: 10px;
        //                 text-align: center;
        //                 color: #ffffff;
        //                 font-size: 0.875rem; /* 14px */
        //                 background: linear-gradient(to right, #8e44ad, #9136ad, #953aad, #9932ad, #9d2fad); /* Adjust shades of purple */
        //                 padding: 10px;
        //                 max-width: 550px;
        //                 border-radius: 0 0 10px 10px; /* Rounded bottom corners */
        //             }
        //         </style>
        //     </head>
        //     <body>
        //         <div class="container">
        //         <h3>Email Verification</h3>
        //         <p><strong>Dear ' . $firstname . ',</strong></p>
        //         <p>Please use the following code to verify your email and activate your account: <strong>' . $otp . '</strong></p>
        //         <p>Thank you.</p>
        //         <footer>PurplePay Agencies</footer>
        //         </div>
        //     </body>
        //     </html>
        // ';

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}

function handleRecipientEmails($recipientEmails)
{
    $emailsFromTextarea = explode(',', $recipientEmails);
    $validEmails = [];
    foreach ($emailsFromTextarea as $email) {
        $trimmedEmail = trim($email);
        if (filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
            $validEmails[] = $trimmedEmail;
        }
    }
    return $validEmails;
}

function handleUploadedFile($file)
{
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    // Check if the uploaded file MIME type is allowed
    if (isset($file['name']) && in_array($file['type'], $fileMimes)) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Initialize PhpSpreadsheet reader based on file extension
        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }

        // Load the spreadsheet
        $spreadsheet = $reader->load($file['tmp_name']);

        // Get data from the active sheet
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Extract email addresses (assuming they are in the first column)
        $validEmails = [];
        foreach ($sheetData as $rowData) {
            // Assuming email addresses are in the first column
            $email = trim($rowData[0]); // Trim to remove any leading/trailing whitespace
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            }
        }
        return $validEmails;
    } else {
        $response = [
            'success' => false,
            'message' => 'Upload only CSV or Excel file.'
        ];
        echo json_encode($response);
        exit;
    }
}


include_once './includes/config.php';
include_once './includes/mysqli_connection.php';

$session_user = $_SESSION["id"];
$numSuccessfulSends = 0;

$response = [
    'success' => false,
    'message' => 'Cannot complete request.'
];

$password = $sender_email = $sender_name = $recipients = $subject = $message = null;
$password_err = $sender_email_err = $sender_name_err = $recipients_err = $subject_err = $message_err = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $attachments = [];

    $recipients = [];

    // Check if either textarea or file input is filled
    if (!empty($_POST['recipient_emails']) && empty($_FILES['email_list']['name'])) {
        // Handle recipient emails from textarea
        $recipients = handleRecipientEmails($_POST['recipient_emails']);
    } elseif (empty($_POST['recipient_emails']) && !empty($_FILES['email_list']['name'])) {
        // Handle recipient emails from uploaded CSV file
        $recipients = handleUploadedFile($_FILES['email_list']);
    } else {
        // Both textarea and file input are filled, display error
        $response = [
            'success' => false,
            'message' => 'Please either upload a CSV/Excel file or enter recipient emails manually, but not both.'
        ];
        echo json_encode($response);
        exit;
    }

    // Output the array of recipient emails for testing
    // echo "<pre>";
    // print_r($recipients);
    // echo "</pre>";


    // if (!empty($_FILES['email_list']['name']) && empty(trim($_POST['recipient_emails']))) {
    //     echo "hello";
    //     $fileName = $_FILES['email_list']['name'];
    //     $fileTmpName = $_FILES['email_list']['tmp_name'];
    //     $fileType = $_FILES['email_list']['type'];

    //     // Check if uploaded file is a CSV
    //     if ($fileType == 'text/csv' || $fileType == 'application/vnd.ms-excel') {
    //         // Read the CSV file
    //         $file = fopen($fileTmpName, 'r');
    //         $recipients = [];
    //         while (($data = fgetcsv($file)) !== FALSE) {
    //             echo "hello loop";
    //             // Assuming email addresses are in the first column
    //             $recipients[] = $data[0];
    //         }
    //         fclose($file);
    //         foreach ($recipients as $recipient) {
    //             echo $recipient;
    //         }
    //     } else {
    //         // Invalid file type
    //         $response = [
    //             'success' => false,
    //             'message' => 'Please upload a valid CSV file.'
    //         ];
    //         echo json_encode($response);
    //         exit;
    //     }
    // } elseif (!empty(trim($_POST['recipient_emails'])) && empty($_FILES['email_list']['name'])) {
    //     // Manually entered recipient emails
    //     $recipients = explode(',', trim($_POST['recipient_emails']));
    // } else {
    //     // Both options provided
    //     $response = [
    //         'success' => false,
    //         'message' => 'Please either upload a CSV file or enter recipient emails manually, not both.'
    //     ];
    //     echo json_encode($response);
    //     exit;
    // }

    if (empty(trim($_POST["sender_email"]))) {
        $sender_email_err = "Please enter your emmail.";
        $response = [
            'success' => false,
            'message' => 'Please enter your email.'
        ];
    } else {
        $sender_email = trim($_POST["sender_email"]);
    }

    if (empty(trim($_POST["sender_name"]))) {
        $sender_name_err = "Please enter your name.";
        $response = [
            'success' => false,
            'message' => 'Please enter your name.'
        ];
    } else {
        $sender_name = trim($_POST["sender_name"]);
    }

    if (empty(trim($_POST["app_password"]))) {
        $password_err = "Please enter an app password.";
        $response = [
            'success' => false,
            'message' => 'Please enter an app password.'
        ];
    } else {
        $password = trim($_POST['app_password']);
    }

    if (empty($recipients)) {
        $recipients_err = "Please provide at least one recipient email";
        $response = [
            'success' => false,
            'message' => 'Please provide at least one recipient email.'
        ];
    }

    // if (empty(trim($_POST["recipient_emails"]))) {
    //     $recipients_err = "Please provide at least one recipient email";
    //     $response = [
    //         'success' => false,
    //         'message' => 'Please provide at least one recipient email.'
    //     ];
    // } else {
    //     $recipients = trim($_POST['recipient_emails']);
    // }

    if (empty(trim($_POST["email_subject"]))) {
        $subject_err = "Please enter the subject of the email";
        $response = [
            'success' => false,
            'message' => 'Please provide the subject of the email.'
        ];
    } else {
        $subject = trim($_POST['email_subject']);
    }

    if (empty(trim($_POST["email_body"]))) {
        $message_err = "Please provide a message";
        $response = [
            'success' => false,
            'message' => 'Please provide a message.'
        ];
    } else {
        $message = trim($_POST['email_body']);
    }


    if (!empty($_FILES['attachments']['name'][0])) {
        $totalFiles = count($_FILES['attachments']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = $_FILES['attachments']['name'][$i];
            $fileTmpName = $_FILES['attachments']['tmp_name'][$i];
            $attachments[] = ['name' => $fileName, 'tmp_name' => $fileTmpName];
        }
    }



    // if (empty($password_err) && empty($sender_email_err) && empty($recipients_err) && empty($subject_err) && empty($message_err) && empty($sender_name_err)) {

    //     $recipientsArray = explode(',', $recipients);
    //     foreach ($recipientsArray as $recipient) {
    //         $sendEmail = sendBulkEmail($sender_email, $password, $recipient, $subject, $message, $sender_name);
    //         if ($sendEmail) {
    //             $response = [
    //                 'success' => true,
    //                 'message' => 'Emails send successfully.'
    //             ];
    //         }
    //     }
    //}
    if (empty($password_err) && empty($sender_email_err) && empty($recipients_err) && empty($subject_err) && empty($message_err) && empty($sender_name_err)) {
        $token = md5(uniqid());

        $query = "INSERT INTO campaigns (user_id, subject, message, sent_from, token, date_sent) VALUES(?, ?, ?, ?, ?, NOW())";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, 'issss', $param_user_id, $param_subject, $param_message, $param_sender_email, $token);

            $param_user_id = $session_user;
            $param_subject = $subject;
            $param_message = $message;
            $param_sender_email = $sender_email;

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        } else {
            $response = [
                'success' => false,
                'message' => 'An error occurred.'
            ];
        }

        // $recipientsArray = explode(',', $recipients);
        foreach ($recipients as $recipient) {
            $sendEmail = sendBulkEmail($sender_email, $password, $recipient, $subject, $message, $sender_name, $attachments);
            if ($sendEmail) {
                $numSuccessfulSends++;
                $response = [
                    'success' => true,
                    'message' => 'Emails sent successfully.',
                    'count' => $numSuccessfulSends
                ];
            }
        }

        $update = "UPDATE campaigns SET recipients = ?, token = NULL WHERE token = ?";

        if ($stmt2 = mysqli_prepare($conn, $update)) {
            mysqli_stmt_bind_param($stmt2, 'is', $param_count, $param_token);

            $param_count = $numSuccessfulSends;
            $param_token = $token;

            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

        }

    }
}
ob_end_clean();

echo json_encode($response);