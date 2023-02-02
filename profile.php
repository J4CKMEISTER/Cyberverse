<?php @session_start();error_reporting(E_ERROR | E_PARSE); ?>
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
        <title>User Profile</title>
        <style>
            body{
                color:white;
            }
            .button {
                background-color: #42C0FB;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
            .button:hover{
                background-color: #00A0C6;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                /* display: none; <- Crashes Chrome on hover */
                -webkit-appearance: none;
                margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
            }

            input[type=number] {
                -moz-appearance:textfield; /* Firefox */
            }
        </style>
        <?php
        include 'header.php';
        ?>  
        <?php
        if(isset($_GET["email"])){
            $email = $_GET["email"];
        }
        elseif(isset($_SESSION['session_email'])) {
            $email = $_SESSION['session_email'];
            
        }// else {
           // echo"<script>alert('Unauthroized person cannot access this page ! D:< !')</script>";
            //echo"<script>window.open('home.php','_self')</script>";
      // }
        $error = 0;
        $conn = mysqli_connect("localhost", "root", "", "Cyberverse");
     
        if (isset($_POST['proForm'])) {
            $proName = $_POST['proName'];
            $phoneNum = $_POST['phoneNum'];
            $address = $_POST['address'];

            $sql = "SELECT * FROM users;";
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
            $row = mysqli_fetch_assoc($result); //check if the record already exist



            $query = "UPDATE users SET user_name ='$proName' , user_phone ='$phoneNum' , user_address='$address' WHERE user_email='$email' LIMIT 1;";

            if (mysqli_query($conn, $query)) {
                $query = "UPDATE customer SET cust_name ='$proName' , cust_contact_no ='$phoneNum' , cust_address='$address' , cust_email='$email';";
                mysqli_query($conn, $query);
                echo"<script>alert('Your profile has been updated !!')</script>";
                echo"<script>window.open('profile.php?email=" . $email . "','_self')</script>";
            } else {
                echo"<script>alert('Error updating your profile !!')</script>";
                echo"<script>window.open('profile.php?email=" . $email . "','_self')</script>";
            }
        }
    
           
        
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
        <script>


            $(document).ready(function () {


                jQuery.validator.addMethod("alphanumeric", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
                });

                jQuery.validator.addMethod("addressValidate", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9\/\, ]+$/.test(value);
                });

                $('#profileForm').validate({// initialize the plugin

                    rules: {
                        proName: {
                            required: true,
                            alphanumeric: true,
                            minlength: 4
                        },
                        phoneNum: {
                            minlength: 10

                        },
                        address: {
                            addressValidate: true
                        }


                    },
                    messages: {
                        proName: {
                            minlength: "User name cannot be less than 4 characters D:<",
                            alphanumeric: "User name must contain numbers and letters only D:<",
                            required: "User name cannot be blank D:<"
                        },
                        phoneNum: {
                            required: "Phone number cannot be blank D:< ",
                            minlength: "Phone number must be atleast 10 digits ! D:<"
                        },
                        address: {
                            required: "Address cannot be blank D:< ",
                            addressValidate: "Only  / , digits and characters for address D:<"
                        }
                    }
                });


            });</script>

        <?php

        function showName() {
            global $email;
            global $conn;
            $sql = "SELECT user_name FROM users WHERE user_email='$email' LIMIT 1";
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
            $roww = mysqli_fetch_assoc($result);

            echo $roww["user_name"];
        }

        function showPhoneNum() {
            global $email;
            global $conn;
            $sql = "SELECT user_phone FROM users WHERE user_email='$email' LIMIT 1";
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
            $roww = mysqli_fetch_assoc($result);

            echo $roww["user_phone"];
        }

        function showAddress() {
            global $email;
            global $conn;
            $sql = "SELECT user_address FROM users WHERE user_email='$email' LIMIT 1";
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
            $roww = mysqli_fetch_assoc($result);

            echo $roww["user_address"];
        }
        ?>
    </head>
    <body>
    <center>

        <form method="post" id="profileForm">
            <table>
                <tr>
                    <td>
                        <label for="email"><b>Email : </b></label>
                    </td>

                    <td>
                        <?php echo $email ?>

                    </td>
                </tr>

                <tr>

                    <td>
                        <label for="proName"><b>Username : </b></label>
                    </td>

                    <td>
                        <input id="proName" type="text" value="<?php showName() ?>"name="proName">   

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="newPassword"><b>Password : </b></label>
                    </td>

                    <td>
                        <a style="color:white" href="newPassword.php?email=<?php
                        echo
                        $_SESSION['session_email']
                        ?>">Setup New Password</a>
                    </td>
                </tr>


                <tr>

                    <td>
                        <label for="address"><b>Address : </b></label>
                    </td>

                    <td>
                        <input id="address" type="text" value="<?php showAddress() ?>"name="address">   

                    </td>
                </tr>


                <tr>

                    <td>
                        <label for="phoneNum"><b>Phone Number : </b></label>
                    </td>

                    <td>
                        <input id="phoneNum" type="number" value="<?php showPhoneNum() ?>"name="phoneNum">   

                    </td>

                </tr>
                <tr>
                    <td>
                        <button class="button" type="submit" name="proForm">Submit</button>
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
<?php include 'footer.php'; ?>    
                    </body>
                    </html>
