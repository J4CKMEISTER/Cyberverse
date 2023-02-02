<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="logo1.png" type="image/gif">
        <link rel="stylesheet" href="login.css">
        <title>Cyberverse - Register</title>
        
          <style>
         .error {
     
      
      color: #F00;
  background-color: #FFF;
  font-weight: bold;
   
       
      
   }
        </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
<script>
    
    function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    $(document).ready(function(){
     //$("input").css({"color": "black", "font-size": "100%"});
    
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
    });
    
     jQuery.validator.addMethod("alphanumericPass", function(value, element) {
        return this.optional(element) || /^\S*(?=\S{15,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/.test(value);
    });
     $('#registerForm').validate({ // initialize the plugin
    
        rules: {
            uname:{
              required:true,  
              alphanumeric:true
            },
            emailRegister: {
                required: true,
                email: true
            },
            pss: {
                required: true,
                alphanumericPass:true
    
              
            }
        },
        messages:{
            uname:{
                required:"User name cannot be blank D:< ",
                minlength:"User name cannot be less than 4 characters D:<",
                alphanumeric:"User name must contain numbers and letters only D:<"
            },
            emailRegister:{
                required:"Email cannot be blank D:<",
                email:"Invalid email format D:< eg: NoragamiS2pls@gmail.com"
            },
            pss:{
                required:"password cannot be blank D:< ",
                alphanumericPass:"Password must be: at least length 15 , containing at least one lowercase letter , at least one uppercase letter and at least one number "
                
            }
            
        }
    });
    
    
});</script>

 

<?php 

if(isset($_POST['goRegister'])){
 
    $userName =  $_POST['uname'];
    
    $password = $_POST['pss'];
  
    $email = $_POST['emailRegister'];
   
$token = bin2hex(random_bytes(10)); // generate unique random token for the user
    
    $errorCount = 0;
    
    if(!preg_match('/^\w{4,}$/', $userName)) {// check for english words + numbers only 
          echo"<script>alert('ONLY characters or number for username !')</script>";
          $errorCount++;
}
    
    $conn =  mysqli_connect("localhost","root","","Cyberverse");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql= "SELECT * FROM users;";
    $result = mysqli_query($conn,$sql)or die(mysqli_error($conn)." Error = ".$sql);
     $row = mysqli_fetch_assoc($result);//check if the record already exist
     
     while ($row = mysqli_fetch_assoc($result)){

           if($row["user_name"] == $userName && $row["user_email"] == $email){
             echo"<script>alert('User Name already taken by someone >:D !\\nUser Email already taken by someone >:D !')</script>";
             $errorCount++;
          }
          else{
              if(str_contains($userName,$row["user_name"])){
                  echo"<script>alert('User Name already taken by someone >:D !')</script>";
                  $errorCount++;
              }
              
              if(str_contains($row["user_email"],$email)){
                  echo"<script>alert('User Email already taken by someone >:D !')</script>";
                  $errorCount++;
              }
          }
        }
          
  
 echo"<script>document.getElementById('id02').style.display = 'block'</script>";
        
     
     
    
    if($errorCount == 0){
     //session_start();
        //$_SESSION['login_admin'] = $userName; //pass username to session
           $querey= "INSERT INTO users (user_name , user_email , user_pass, token) VALUES ('$userName','$email','$password','$token');";
           $querey_run = mysqli_query($conn, $querey);
           if ($querey_run == true ) {
            echo '<script type="text/javascript"> alert("Register Successful") </script>';
        } else {
            echo '<script type="text/javascript"> alert("Failed to register") </script>';
        } 
          // echo"<script>alert('Please go to your email to verify your account !, ".$email."')</script>";
           //echo"<script>window.open('admin.php','_self')</script>";
            require 'PHPMailerAutoload.php';
            $EMAIL = "hyperhasagi9@gmail.com";
            $PASS  = "cbkisworlbozgujw";

$mail = new PHPMailer;//create object of mailer

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $EMAIL;                 // SMTP username
$mail->Password = $PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($EMAIL, 'Cyberverse');
$mail->addAddress($email);     // Add a recipient
 
$mail->addReplyTo($EMAIL);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Account Verification !';
$mail->Body    = 'Thanks for registering an account at the Cyberverse ,Mr/Mrs <b> '.$userName.' </b>'
        . '<br> Click <a href="http://localhost/fyp/verifyAccount.php?token='.$token.'"><b>HERE</b></a> to complete the registration ';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo"<script>alert('ERROR OCCUR when trying to send ! Are you sure ".$email." is your email ?? ')</script>";
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     echo"<script>alert('An email is being sent to your email account for verification!')</script>";
}

    }else{
        echo "Fail to add ! ";
        echo"<div id='addError' style='background-color:#ffcccb;width:100%;'>";
        printf("<ul style='color:red; display: inline-block;'><li>%s</li></ul>", implode("</li><li>", $error));
        echo'</div>';
    }

       }



?>
    </head>
    <body>
        <div id="id02" class="modal">   
            <center> 

                <form id="registerForm" class="modal-content-register animate" action="" method="post" >
                    <div class="imgcontainer-register">
                        <span onclick="document.getElementById('id02').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                        <img src="rikka.gif" alt="Avatar" class="avatar">
                    </div>

                    <div class="container-register">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" class="username-input" placeholder="Enter Your Username" minlength="4" maxlength="15"name="uname" />
                        
                        <br>
                        <label for="pss"><b>Password</b></label>
                        <input id="pass"type="password" class="password-input" placeholder="Enter Your Password"name="pss">
                        <input type="checkbox" onclick="myFunction()">Show Password
                        <br>
                        <label for="email"><b>Email</b></label>
                        <input type="email" name="emailRegister"id="email-input" placeholder="Email"/>
                         
                        <br>
                        <button type="submit" name="goRegister"class="registerbtn">Register</button>
                        
                        <br>
                        <p><button  onclick="document.getElementById('id02').style.display = 'none'"type="button" class="cancelbtn">Cancel</button><p>
                    </div>
                </form>

            </center> 
        </div>
        
    </body>
    <script>
        // Get the modal
        var modal = document.getElementById("id02");

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
</html>