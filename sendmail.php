<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';            // Set the SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';   // Your Gmail address
        $mail->Password = 'your-app-password';      // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipient and sender settings
        $mail->setFrom($email, $fullname);          // Sender's email and name
        $mail->addAddress('rsathishec36@gmail.com'); // Your email address to receive the message

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = "<h4>Name:</h4> $fullname<br><h4>Email:</h4> $email<br><h4>Message:</h4><p>$message</p>";
        $mail->AltBody = "Name: $fullname\nEmail: $email\nMessage:\n$message"; // For non-HTML clients

        // Send the email
        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
