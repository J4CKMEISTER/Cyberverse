<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="latest.png" type="image/x-icon">
        <title>Cyberverse - Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="admin.css">
        <?php
        include 'header.php';
        ?>
        <style>
            .error {
                color: #F00;
                background-color: #FFF;
                font-weight: bold;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
    <script src="form-validate.js"></script>
    </head>
    <body>

        <div id="header">
            <center><img src="adm.jpg" alt="adminpic" id="adminlogo">
                <h1>This is admin panel , proceed with caution !</h1></center>
        </div>

        <div id="sidebar">
            <ul>
                <a href="admin.php" style="text-decoration: none;"><li class="side-content">Go back</li></a>
            </ul>
        </div>
        <?php
        include_once './connection.php';
        $custID = $_GET["cust_id"];
        $query = "SELECT * FROM customer WHERE cust_id='$custID';";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($query_run);

        if (isset($_POST['adminUpdate'])) {

            $editName = ($_POST['name']);
            $newAddress = ($_POST['addressCheck']);
            $newContact = ($_POST['phoneNumCheck']);
            $newEmail = ($_POST['email']);


            $query = "UPDATE customer SET cust_name='$editName' , cust_contact_no='$newContact' , cust_email='$newEmail', cust_address = '$newAddress' WHERE cust_id='$custID';";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                echo '<script type="text/javascript"> alert("Customer updated to database")</script>';
                echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
            } else {
                echo '<script type="text/javascript"> alert("Failed! WHAT AM I GONNA DO?!") </script>';
            }
        }
        ?>
        <div id="data">
            <form method="post" enctype="multipart/form-data" id="feedbackForm">
                <table>
                    <tr><td><h1 class="hl_style">Update Customer Info</h1></td></tr>
                    <tr>
                        <td class="table_Style">
                            <label>New Customer Name : </label>
                            <input name="name" type="text" id="namebox" value="<?php echo $row['cust_name']; ?>" required />  
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>New Customer Contact No : </label>
                            <input name="phoneNumCheck" type="text" id="contact" value="<?php echo $row['cust_contact_no']; ?>" required />  
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>New Customer Email : </label>
                            <input name="email" type="text" id="email" value="<?php echo $row['cust_email']; ?>" required />  
                        </td>
                    </tr>




                    <tr>
                        <td class="table_Style">
                            <label>New Customer Address : </label>
                            <textarea name="addressCheck" required><?php echo $row['cust_address']; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <input id="submit" type="submit" value="Update" name="adminUpdate">

                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </body>
    
</html>