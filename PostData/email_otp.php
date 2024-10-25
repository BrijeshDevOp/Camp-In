<?php
    session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Access the form data using the $_POST superglobal
    $dbPath = __DIR__.'/../Assets/db/database.php';
    require $dbPath;

    $email=$_POST['email'];
    $username = $_POST['username'];
    echo $username;
    $res=mysqli_query($conn,"select * from user where email='$email' and username = '$username'");
    $count=mysqli_num_rows($res);
    if($count>0){
	        $otp=rand(11111,99999);
	        mysqli_query($conn,"update user set otp='$otp' where email='$email'");
	        $html="Your otp verification code is ".$otp;
	        $_SESSION['EMAIL']=$email;
            $_SESSION['username']=$username;
        	smtp_mailer($email,'OTP Verification',$html);
	        echo "success";
       }
       else
       {
	    echo "fail";
      }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function smtp_mailer($email,$msg,$otp)
{
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function    
    require 'phpmailer/src/Exception.php'; 
    require 'phpmailer/src/PHPMailer.php'; 
    require 'phpmailer/src/SMTP.php'; 
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'brijeshpoojary9663@gmail.com';      //Your Gmail Id
        $mail->Password   = 'pxpjzfpoycwajlbv';      //Your App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('brijeshpoojary9663@gmail.com', 'brijesh');
        $mail->addAddress($email, 'blast');     //Add a recipient
      
        $mail->addReplyTo('brijeshpoojary9663@gmail.com', 'your-gmail-id-name');
        
    
        //Attachments
       // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $uname = $_SESSION['username'];
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Hello '.$uname.'  <b>'.$otp.'</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>