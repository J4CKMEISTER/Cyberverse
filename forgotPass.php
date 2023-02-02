<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <link rel="icon" href="latest.png" type="image/x-icon">
        <meta charset="UTF-8">
        <title>Forgot Password ?</title>
        <link rel="stylesheet" href="home.css">
          <?php
        include 'header.php';
        ?>
        
        <?php
        if(isset($_POST['submitToEmail'])){
            
            require 'PHPMailerAutoload.php';
            $EMAIL = "hyperhasagi9@gmail.com";
            $PASS  = "letsgooweebbb123321";

$mail = new PHPMailer;//create object of mailer

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $EMAIL;                 // SMTP username
$mail->Password = $PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($EMAIL, 'Hyper Hasagi Online Store');
$mail->addAddress($_POST['emailPass']);     // Add a recipient
 
$mail->addReplyTo($EMAIL);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password Recover !';
$mail->Body    =  'Forgot your <b>password</b> for the Hyper Hasagi online store ?'
        . '<br> Click <a href="http://localhost/fyp/newPassword.php?email='.$_POST['emailPass'].'"><b>HERE</b></a> reset your password !! ';;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo"<script>alert('ERROR OCCUR when trying to send ! Are you sure ".$_POST['emailPass']." is your email ?? ')</script>";
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     echo"<script>alert('An email is being sent to your email account!')</script>";
}

    }
       
        ?>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
<script>
    
    $(document).ready(function(){

    
        
     $('#forgotPassForm').validate({ // initialize the plugin
    
        rules: {
            emailPass: {
                required: true,
                email: true
            }
        },
        messages:{
            emailPass:{
                required:"Email cannot be blank D:<",
                email:"Invalid email format D:< eg: NoragamiS2pls@gmail.com"
            }
            
        }
    });
    
    
});</script>
    </head>
    <body>
       <center>
        
            <br><br>
            <form method="POST" id="forgotPassForm">
                <label style="color:white">Enter Your Email : </label>
                <input type="text" name="emailPass" required><br><br>
                <button class="button" type="submit" name="submitToEmail">Submit</button>
                <a class="button"href="home.php">Go Back</a>
            </form>
            
            <br><br>
        </center>
         <?php include 'footer.php';
            ?>    
    </body>
</html>
