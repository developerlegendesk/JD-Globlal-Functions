<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    $message = $_POST["message"];
    
    try {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                      
        $mail->isSMTP();                           
        $mail->Host       = 'smtp.gmail.com';      
        $mail->SMTPAuth   = true;
        $mail->Username   = 'developer@geeksroot.com'; 
        $mail->Password   = 'GeeksRoot!=2';          
        $mail->SMTPSecure = 'tls';  
        $mail->Port       = 587;                   
        $mail->setfrom('developer@geeksroot.com', 'Geeksroot');
        $mail->addaddress('devjohnwick8@gmail.com', 'Geeksroot');     
        $file_name = "";
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            $file_name = $_FILES["file"]["name"];
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_path = "uploads/" . $file_name; // Path to save the file
    
            move_uploaded_file($file_tmp, $file_path);
        }
    
        $mail->isHTML(true);
        $mail->Subject = 'We have a Career Form!';
        $body  = '<html><body>
            <p><strong>First Name:</strong> '.$first_name.'</p>
            <p><strong>Last Name:</strong> '.$last_name.'</p>
            <p><strong>Email:</strong> '.$email.'</p>
            <p><strong>Phone Number:</strong> '.$phone .'</p>
            <p><strong>Phone Number:</strong> '.$position .'</p>
            <p><strong>Message:</strong> '.$message.'</p>
            </body></html>';
            
         if (!empty($file_path) && file_exists($file_path)) {
            $mail->addAttachment($file_path, $file_name);
            } 
         $mail->Body = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
            echo 'Email has been sent successfully';
        // header("Location: thank-you.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
       
    
}
?>