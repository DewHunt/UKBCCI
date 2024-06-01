<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendMail ()
{
    require_once 'vendor/autoload.php';
    $mail_username = trim('demo@elipos.co.uk');
    //  $mail_receiver = 'samira.giantssoft@gmail.com';
    // $sendMailName    = $_POST['name'];
    $sendMailSubject = 'UKBCCI Trade Show and Business Networking Event';

    include('email_body.php');

    $emailBody = getEmailBody();
    $emailBody = preg_replace('/\n/', PHP_EOL, $emailBody);

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host      = 'ssl://' . trim("smtp.stackmail.com");
    $mail->Port      = 465;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth  = true;
    $mail->Username  = $mail_username;
    $mail->Password  = trim("£M'3yKZTk5zl");
    $mail->setFrom($mail_username, 'UKBCCI');
    $mail->addAddress($_POST['email'], $_POST['name']);
    if($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = $sendMailSubject;
        $mail->isHTML(true);
        $mail->Body = $emailBody;

        if(!$mail->send()) {
            $_SESSION['flash_message'] = 'Sorry, something went wrong. Please try again later.';
            return false;
        }
        //  else {
        //     $_SESSION['flash_message'] = 'Message sent, Thanks for contacting us.';
        //     return true;
        // }

        $mail->clearAddresses();

        $mail->addAddress('i.ahmad@ukbccimidlands.org', 'Imam Uddin Ahmad');
        $mail->addCC('shab@elipos.co.uk', 'ShabUddin');
        $mail->Subject = 'UKBCCI Trade Show and Business Networking Event';
        include('email_body_for_business.php');
        $mail->Body = getBusinessEmailBody();

        // echo '<pre>';
        // print_r($mail);
        // echo '</pre>';
        // exit();
        if(!$mail->send()) {
            $_SESSION['flash_message'] = 'Sorry, something went wrong sending the second email.';
        } else {
            $_SESSION['flash_message'] = ' emails sent successfully!';
        }
    } else {
        $_SESSION['flash_message'] = 'Give all the information!';
    }

    // End  Code For Send Mail
    header('Location:index.php');
}

// function sendBusinessMail ()
// {
//     require_once 'vendor/autoload.php';
//     $mail_username = trim('demo@elipos.co.uk');

//     // $mail_receiver = 'i.ahmad@ukbccimidlands.org';
//     // $sendMailName  = 'Imam Uddin Ahmad';
    
//      $mail_receiver = 'samirashammi67@gmail.com';
//     $sendMailName  = 'Imam Uddin Ahmad';


//     $sendMailSubject = 'UKBCCI Trade Show and Business Networking Event';

//     include('email_body_for_business.php');
//     // Code For Send Mail

//     $emailBody = getBusinessEmailBody();
//     $emailBody = preg_replace('/\n/', PHP_EOL, $emailBody);

//     $mail = new PHPMailer;
//     $mail->isSMTP();
//     $mail->Host      = 'ssl://' . trim("smtp.stackmail.com");
//     $mail->Port      = 465;
//     $mail->SMTPDebug = 0;
//     $mail->SMTPAuth  = true;
//     $mail->Username  = $mail_username;
//     $mail->Password  = trim("£M'3yKZTk5zl");
//     $mail->setFrom($mail_username, 'UKBCCI');
//     $mail->addAddress($mail_receiver, $sendMailName);
//   // $mail->addCC('shab@elipos.co.uk', 'ShabUddin');

//     if($mail->addReplyTo($mail_receiver, $sendMailName)) {
//         $mail->Subject = $sendMailSubject;
//         $mail->isHTML(true);
//         $mail->Body = $emailBody;

//         if(!$mail->send()) {
//             $_SESSION['flash_message'] = 'Sorry, something went wrong. Please try again later.';
//         } else {
//             $_SESSION['flash_message'] = 'Message sent.! Thanks for contacting us.';
//         }
//     } else {
//         $_SESSION['flash_message'] = 'Share it with us!';
//     }
//     // End Code For Send Mail
//     header('Location:index.php');
// }

?>