<?php
// Include the Composer autoload file
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                              // Set mailer to use SMTP
        $mail->Host       = 'mail.finixia.in';                   // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
        $mail->Username   = 'support@finixia.in';                 // SMTP username
        $mail->Password   = 'Bhaskar1200';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;              // Enable SSL encryption; `PHPMailer::ENCRYPTION_STARTTLS` also accepted
        $mail->Port       = 465;                                      // TCP port to connect to

        // Recipients
        $mail->setFrom('from-email@example.com', 'Mailer');           // Sender's email address and name
        $mail->addAddress('recipient@example.com');                   // Add a recipient

        // Content
        $mail->isHTML(true);                                          // Set email format to HTML
        $mail->Subject = !empty($subject) ? $subject : 'New Contact Form Submission';
        $mail->Body    = "<h3>New message from: $name</h3><p>Email: $email</p><p>Message:</p><p>$message</p>";

        // Send email
        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
