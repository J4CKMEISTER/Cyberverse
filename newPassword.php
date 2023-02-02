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
        <title>Reset Password</title>
        <link rel="stylesheet" href="home.css">
        
         <style>
            body{
                color:white;
            }
         .error {
      color: red;
      
      color: #F00;
  background-color: #FFF;
  font-weight: bold;
   
       
      
   }
        </style>
        <?php include'header.php';?>
        
        <?php
        
       if(isset($_GET['email'])){
              $email = $_GET['email'];
        } 
        else {
     echo"<script>alert('NO Email ??! !!')</script>";
     echo"<script>window.open('home.php','_self')</script>";}
        
        $error = 0;
        include_once './connection.php';
         if(isset($_POST['resetPass'])){
             
        $newPass = $_POST['resetPss'];
        $confirmPass = $_POST['resetPsswd'];
        
         
        
     
      if ($newPass != $confirmPass){
            echo"<script>alert('Password Does not Match !')</script>";
             echo"<script>window.open('newPassword.php?email='".$email."',_self')</script>";
             $error++;
        }
     if($error ==0){
         $query = "UPDATE users SET user_pass='$newPass' WHERE user_email='$email'";

        if (mysqli_query($conn, $query)) {
           
            echo"<script>alert('Your password has been reset !!')</script>";
            echo"<script>window.open('home.php','_self')</script>";
        }
     else {
         echo"<script>alert('User Not Found !!')</script>";
         echo"<script>window.open('home.php','_self')</script>";
    }
         
     }
        


           }
           //Check GET Requests
           else{
            $newPass = $_GET['resetPss'];
            $confirmPass = $_GET['resetPsswd'];
            
             
            
         
          if ($newPass != $confirmPass){
                echo"<script>alert('Password Does not Match !')</script>";
                 echo"<script>window.open('newPassword.php?email='".$email."',_self')</script>";
                 $error++;
            }
         if($error ==0){
             $query = "UPDATE users SET user_pass='$newPass' WHERE user_email='$email'";
    
            if (mysqli_query($conn, $query)) {
               
                echo"<script>alert('Your password has been reset !!')</script>";
                echo"<script>window.open('home.php','_self')</script>";
            }
         else {
             echo"<script>alert('User Not Found !!')</script>";
             echo"<script>window.open('home.php','_self')</script>";
        }
             
         }

           }
   
        ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
<script>
      function myFunction() {
  var x = document.getElementById("passw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
      function myFunction2() {
  var x = document.getElementById("passwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
   
     jQuery.validator.addMethod("alphanumericPass", function(value, element) {
        return this.optional(element) || /^\S*(?=\S{15,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/.test(value);
    });
    $(document).ready(function(){

    
        
     $('#resetForm').validate({ // initialize the plugin
    
        rules: {
            resetPss: {
                required: true,
                alphanumericPass:true
            },
             resetPsswd: {
                required: true,
                alphanumericPass:true
            }
        },
        messages:{
            resetPss:{
                required:"password cannot be blank D:< ",
                alphanumericPass:"<br>Password must be: <br>- at least length 15 <br>- containing at least one lowercase letter <br>- at least one uppercase letter<br>- and at least one number "
            },
             resetPsswd: {
                required:"password cannot be blank D:< ",
                alphanumericPass:"<br>Password must be: <br>- at least length 15 <br>- containing at least one lowercase letter <br>- at least one uppercase letter<br>- and at least one number "
            }
            
        }
    });
    
    
});</script>

<?php 

function showName(){
    $email = $_GET['email'];
    global $conn;
    $sql = "SELECT user_name FROM users WHERE user_email='$email' LIMIT 1";
    $result =  mysqli_query($conn,$sql)or die(mysqli_error($conn)." Error = ".$sql);
    $roww = mysqli_fetch_assoc($result);
    
    echo $roww["user_name"];
}
?>
    </head>
    <body>
         <center>
             <img src='resetpasspic.jpg' style="width: 80%;height: auto;">
            <br><br>
            
            <form method="post" id="resetForm">
                <table>
               <tr>
               <td>
               <label for="email"><b>Email : </b></label>
                </td>
                
               <td>
               <?php echo $_GET['email']?>
               
               </td>
               </tr>
               
               <tr>
                   
              <td>
              <label for="uname"><b>Username : </b></label>
              </td>
              
              <td>
              <?php showName()?>
              </td>
               </tr>
               
               <tr>
                       <td>
                        <label for="newPss"><b>New Password</b></label>
                       </td>
                           
                       <td>
                        <input id="passw" type="password" placeholder="Enter Your Password"name="resetPss">
                       </td>
               </tr>
               
               <tr>
                   <td>
                        <label for="newPss2"><b>Confirm Password</b></label>
                   </td>
                   
                   <td>
                        <input id="passwd" type="password" placeholder="Confirm Your Password"name="resetPsswd">
                    </td>
               </tr>    <tr>
                         <td> 
                        <input type="checkbox" onclick="myFunction(),myFunction2()">Show Password
               </td>        
               </tr>
                       <tr>
                        <td>
                        <button class="button" type="submit" name="resetPass">Submit</button>
                        </td>
                        
                         <td>
                <a class="button"href="home.php">Go Back</a>
                </td>
                       </tr>
                     
               
                <table>
            </form>
             <br><br>
             <br><br>
            
         </center>
        <?php include 'footer.php';
            ?>    
    </body>
</html>
