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
        <title>Verify Account</title>
        <link rel="stylesheet" href="home.css">
        <?php include'header.php';?>
        
        <?php
         $conn   =  mysqli_connect("localhost","root","","Cyberverse");
        if(isset($_GET['token'])){
              $token = $_GET['token'];
       
         $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
        $result = mysqli_query($conn,$sql)or die(mysqli_error($conn)." Error = ".$sql);
         $row = mysqli_fetch_assoc($result);
          
             if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) {
           
            echo"<script>alert('Your Email is verified !!')</script>";
        }
    } else {
         echo"<script>alert('User Not Found !!')</script>";
         echo"<script>window.open('home.php','_self')</script>";
    }
} else {
     echo"<script>alert('NO TOKEN ??! !!')</script>";
     echo"<script>window.open('home.php','_self')</script>";
}

      
   
        ?>
    </head>
    <body>
         <center>
             <img src='verifiedpic.jpg' style="width: 80%;height: auto;">
            <br><br>
             <a class="button"href="shopAll.php">Start Shopping</a>
             <br><br>
             <br><br>
            
         </center>
        <?php include 'footer.php';
            ?>    
    </body>
</html>
