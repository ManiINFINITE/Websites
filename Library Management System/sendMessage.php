<?php
    session_start();
    include("connect.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);


    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_POST['email']; // Your Gmail address
        $mail->Password = $_POST['app-password']; // Your app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($_POST['email'], $_SESSION['first_name'] . ' ' . $_SESSION['last_name']);
        $mail->addAddress('manivakili907@gmail.com', 'Mani Vakili');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];

        $mail->send();
        header("Location: contact.php");
        exit();
    } catch (Exception $e) {
        echo "Failed to send message!";
    }
?>