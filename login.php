<?php 
      @session_start();
      
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="login.css">
        <link rel="icon" href="latest.png" type="image/x-icon">
        <title>Cyberverse - Login</title>
     
        <?php 

if(isset($_POST['loginSubmit'])){
    
    
    $userName =  $_POST['uname'];
    
    $password = $_POST['pss'];

    include_once './connection.php';
    $sql= "SELECT * FROM users WHERE user_pass = '$password' OR user_name = '$userName'";
    //$result = mysqli_query($conn,$sql)or die(mysqli_error($conn)." Error = ".$sql);
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);//check if the record already exist
    
 
   //get email for session
   $sql2="SELECT user_email FROM users WHERE user_pass = '$password' AND user_name = '$userName' LIMIT 1";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_assoc($result2);
   
   $_SESSION['session_email']= $row2['user_email'];//store the email of user into the session
   
          if($row["user_name"] == $userName && $row["user_pass"] == $password){
            
            if($row["user_pass"] == "hacked"){
                echo"<script>alert('cyberv{profile_hijacked_hehe}')</script>";
              }    
              
            if($row["user_type"] != null){
                
                if($row["verified"] == 0){
                     echo"<script>alert('Your account is not verified !')</script>";
                    echo"<script>window.open('home.php','_self')</script>";
                }
                else{
                    $_SESSION['admin_login'] = $userName; 
                echo"<script>alert('Welcome BACK !, ".$userName."-sama')</script>";
               echo"<script>window.open('admin.php','_self')</script>";
                }
                
                
            }
            else{
                 if($row["verified"] == 0){
                     echo"<script>alert('Your account is not verified !')</script>";
                    echo"<script>window.open('home.php','_self')</script>";
                }
                else{
                    $_SESSION['login_user'] = $userName;
                 echo"<script>alert('Welcome customer , ".$userName." !!')</script>";
                 echo"<script>window.open('home.php','_self')</script>";
                }
                
            }
          
            
        }
        
        else{
            if($row["user_name"] != $userName){
               echo"<script>alert('Incorrect User Name is entered !')</script>";
              
               
          }
          
        if($row["user_pass"] != $password){
            echo"<script>alert('Incorrrect password is entered !')</script>";
           
            

        }
    
        echo"<script>window.open('home.php','_self')</script>";
        }
           
        
     }
   



?>
        



    </head>
    <body>
        <div id="id01" class="modal">   
            <center> 

                <form id="loginForm" class="modal-content animate" action="" method="post" >
                    <div class="imgcontainer-register">
                        <span style="top: -197px;" onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                        <img src="rikka.gif" alt="Avatar" class="avatar">
                    </div>

                    <div class="container-register">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" class="username-input" placeholder="Enter Your Username" name="uname" required>

                        <label for="pss"><b>Password</b></label>
                        <input type="password" class="password-input" placeholder="Enter Your Password" name="pss" required>

                        <button type="submit" class="loginbtn" name="loginSubmit">Login</button>

                        <span class="spacing"><a class="form_a" href="forgotPass.php">Forgot password?</a></span>
<span class="spacing"> <a  onclick="document.getElementById('id02').style.display = 'block';document.getElementById('id01').style.display = 'none'"type="button"class="form_a" href="#">New here?</a></span>
                        
                    </div>
                </form>

            </center> 
        </div>
        
    </body>
    <script>
        // Get the modal
        var modal = document.getElementById("id01");

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
   
    
</html>