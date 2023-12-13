<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';
 
//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {
 
  $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtpout.asia.secureserver.net'; 	       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'info@eqtaralawla.com';    //SMTP write your email
    $mail->Password   = 'sa#87654321';        //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( $_POST["email"], $_POST["name"]); // Sender Email and name
    $mail->addAddress('nfo@eqtaralawla.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
     
    //multiple file attachment
  for ($i = 0; $i < count($_FILES['file']['tmp_name']); $i++) {
     $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i] ); 
  }
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Received New Message From: '. $_POST["name"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message
      
    // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'contact-form.php';
    </script>
    ";
}
