<?php session_start();?>
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
        <title>Log Out</title>
        <link rel="stylesheet" href="home.css">
        <?php
        include 'header.php';
        ?>
        
        <?php 
         if(!isset($_SESSION['admin_login']) && !isset($_SESSION['login_user'])){
            echo"<script>alert('Unauthroized person cannot access this page ! D:< !')</script>";
            echo"<script>window.open('home.php','_self')</script>";
        }
        else{
            $_SESSION = array();
            session_destroy();
        }
        
        ?>
    </head>
    <body>
        <center>
            <img src='logoutpic.jpg' style="width: 80%;height: auto;">
            <br><br>
            <a href="home.php" class="button">Go Back</a>
            <br><br>
        </center>
         <?php include 'footer.php';
            ?>    
    </body>
</html>
