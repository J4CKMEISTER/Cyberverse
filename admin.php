<?php
session_start();
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
        <link rel="icon" href="latest.png" type="image/x-icon">
        <title>Cyberverse - Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="admin.css">
        <?php
        include 'header.php';
        ?>
        <?php 
   
    
        // if (!isset($_SESSION['admin_login'])) {
        //    echo"<script>alert('Unauthroized person cannot access this page ! D:< !')</script>";
        //    echo"<script>window.open('home.php','_self')</script>";
        //}
        ?>
    </head>
    <body>
        <?php
    
  
        function validation() {
            $error = array();
            $newPrice = ($_POST['newPrice']);
            $selectedCategory = ($_POST['selectedCategory']);
            $patternPrice = '/^(0|[1-9]\d*)(\.\d{1,2})?$/';
            $newProductName = ($_POST['newProductName']);
            $nameLength = strlen($newProductName);
            if ($nameLength < 4) {
                $error['newProductName'] = "<b>Product Name</b> must be at least 4 characters";
            }
            if ($nameLength > 45) {
                $error['newProductName'] = "<b>Product Name</b> cannot be greater than 45 characters";
            }
            if ($selectedCategory == "------------------Select One-------------------") {
                $error['selectedCategory'] = "Please select a <b>category !</b>";
            }
            if (!preg_match($patternPrice, $newPrice)) {
                $error['price'] = "Please enter valid <b>price (999.99)</b>";
            }

            $file = $_FILES['newProductIMG'];
            $fileName = $_FILES['newProductIMG']['name'];
            $fileTmpName = $_FILES['newProductIMG']['tmp_name'];
            $fileSize = $_FILES['newProductIMG']['size'];
            $fileError = $_FILES['newProductIMG']['error'];
            $fileType = $_FILES['newProductIMG']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'gif', 'png', 'jpeg');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize <= 1048576) {
                        
                    } else {
                        $error['newProductIMG'] = "Your file exceeded <b>1 MB</b>";
                    }
                } else {
                    $error['newProductIMG'] = "Error uploading <b>your file</b>";
                }
            } else {
                $error['newProductIMG'] = "Cannot upload this filetype! <b>ONLY 'jpg', 'gif', 'png', 'jpeg'</b>";
            }
            return $error;
        }
        ?>

        <div id="header">
            <center><img src="adm.jpg" alt="adminpic" id="adminlogo">
                <h1>This is admin panel , proceed with caution !</h1><h3>cyberv{oops_i_forgot_to_check_admin}</h3></center>
                <?php
                if( isset( $_POST['Submit' ] ) ) {
                    // Get input
                    $target = $_POST[ 'ip' ];
                    if(preg_match("/[a-z]/i", $target)){
                        echo"<script>alert('cyberv{wait_stop_looking_noo}')</script>";
                    }
                
                    // Determine OS and execute the ping command.
                    if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
                        // Windows
                        $cmd = shell_exec( 'ping  ' . $target );
                    }
                    else {
                        // *nix
                        $cmd = shell_exec( 'ping  -c 4 ' . $target );
                    }
                
                    // Feedback for the end user
                    
                    echo "<br style = 'line-height:7;'><center><pre style='color:black;font:bold'>{$cmd}</pre></center>"; 
                   // echo "<script>alert(".$cmd.")</script>";
                }  
                ?>    
            <p>
            <center>
                <form method="post">
				Enter an IP address:
				<input type="text" name="ip" size="30">
                <button name="Submit" type="submit">Submit</button>
                </form>
            </center>
			</p>
            

        </div>

        <div id="sidebar">
            <ul>
                <li class="side-content" onclick="display()">Add new product</li>
                <li class="side-content" onclick="edit()">Edit products</li>
                <li class="side-content" onclick="update()">Update </li>
                <li class="side-content" onclick="view()">View orders</li>
                <li class="side-content" onclick="fulfill()">Fulfill orders</li>
            </ul>
        </div>

        <div id="data"><br>

            <?php
            include_once './connection.php';
           // if (!isset($_SESSION['admin_login'])  ) { 
              //  echo"cyberv{oops_i_forgot_to_check_admin}";
             // }
            if (isset($_POST['submitNewProduct'])) {
                $image = $_FILES['newProductIMG']['tmp_name'];
                $file = addslashes(file_get_contents($image));
                //$selectedCategory = ($_POST['selectedCategory']);
                $newProductName = ($_POST['newProductName']);
                $newProductDescription = ($_POST['addDesc']);
                $newPrice = ($_POST['newPrice']);
                $newQuantity = ($_POST['newQuantity']);
                $newCategory = ($_POST['selectedCategory']);

                $error = validation();

                if (empty($error)) {
                    $querey = "INSERT INTO product (image, product_name, price, quantity, category, prod_description) VALUES ('$file', '$newProductName', '$newPrice', '$newQuantity', '$newCategory', '$newProductDescription');";
                    $querey_run = mysqli_query($conn, $querey);
                    
                } else {
                    echo "Fail to add ! ";
                    echo"<div id='addError' style='background-color:#ffcccb;width:100%;'>";
                    printf("<ul style='color:red; display: inline-block;'><li>%s</li></ul>", implode("</li><li>", $error));
                    echo'</div>';
                }
            }
            ?>

            <div id="add_div">


                <form action="admin.php" method="POST" enctype="multipart/form-data">
                    <h1 class="hl_style">Add new Products</h1>
                    <table>


                        <tr>
                            <td class="table_Style">

                                <label>Category : </label>

                                <?php
                                $category = array("T" => "T-shirts",
                                    "Ho" => "Hoodies", "Ha" => "Hats", "P" => "Popular");
                                ?>
                                <select name="selectedCategory"> 
                                    <?php
                                    echo"<option selected='selected'>------------------Select One-------------------</option>";
                                    foreach ($category as $key => $value) {
                                        echo"<option name='selectedCategory' value='$key'>$value&nbsp($key)</option>";
                                    }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="table_Style"> 
                                <label>Product Name : </label>
                                <input type="text" id="namebox" name="newProductName" required />


                            </td>


                        </tr>

                        <tr>
                            <td class="table_Style"> 
                                <label>Product Price : </label>
                                <input name="newPrice" type="text" id="price" required />


                            </td>


                        </tr>

                        <tr>
                            <td class="table_Style"> 
                                <label>Product Quantity : </label>
                                <input name="newQuantity" type="number" id="quantity" required />


                            </td>


                        </tr>

                        <tr>
                            <td class="table_Style"> 
                                <label for="image">Product Image : </label>
                                <input type="file" name="newProductIMG" id="newProductIMG" required>


                            </td>    
                        </tr>

                        <tr>
                            <td class="table_Style">
                                <label for="image">Product Description : </label>
                                <textarea name="addDesc"></textarea>
                            </td> 
                        </tr>

                        <tr>
                            <td class="table_Style">
                                <input id="submit" type="submit" value="Add Product" name="submitNewProduct">   
                            </td> 
                        </tr>


                    </table>
                </form>

            </div>

            <div id="edit_div">

                <h1 class="hl_style">Edit Products</h1>
                <table style="width: 80%;max-width: 80%;">

                    <?php
                    include_once './connection.php';

                    $query = "SELECT * FROM product;";
                    $query_run = mysqli_query($conn, $query);
                    $resultCheck = mysqli_num_rows($query_run);

                    if ($resultCheck > 0) {
                        echo '<tr>
                        <th class="table_Style3">Image</th>
                        <th class="table_Style3">Name</th>
                        <th class="table_Style3">Price</th>
                        <th class="table_Style3">Quantity</th>
                        <th class="table_Style3">Category</th>
                        <th class="table_Style3">Description</th>
                        <th class="table_Style3" colspan="2">Operations</th>
                    </tr>';
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>

                            <tr>
                                <td class="table_Style2"><?php echo '<img src="data:image;base64,' . base64_encode($row['image']) . '" style="width: 80px; height: 80px;" >'; ?></td>
                                <td class="table_Style2" style="word-break: break-word;"><?php echo $row['product_name']; ?></td>
                                <td class="table_Style2"><?php echo $row['price']; ?></td>
                                <td class="table_Style2"><?php echo $row['quantity']; ?></td>
                                <td class="table_Style2"><?php echo $category[$row['category']]; ?></td>
                                <td class="table_Style2" style="word-break: break-word;"><?php echo nl2br($row['prod_description']); ?></td>
                                <td class="table_Style2"><a href="admin-update.php?product_num=<?php echo $row['product_num']; ?>" class="btnAdmin">EDIT</a></td>
                                <td class="table_Style2"><a href="admin-delete.php?product_num=<?php echo $row['product_num']; ?>" class="btnAdminRed" onclick="return confirm('Are you sure you want to Remove?');">DELETE</a></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo '<center><h3 style="color:white;">⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿<br>
                        
                        █▄░█ █▀█   █▀█ █▀▀ █▀ █░█ █░░ ▀█▀ █▀   █▀▀ █▀█ █░█ █▄░█ █▀▄<br>
                        █░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3></center>';
                    }
                    ?>

                </table>   
            </div>

            <div id="update_div">

                <form action="" method="post">
                    <table class="orderTable" style="width: 80%;max-width: 80%;">
                        <h1 class="hl_style">Update Orders</h1>
                        <h2 class="hl_style">Customers</h2>
                        <?php
                        include_once './connection.php';

                        $query = "SELECT * FROM customer;";
                        $query_run = mysqli_query($conn, $query);
                        $resultCheck = mysqli_num_rows($query_run);

                        $query2 = "SELECT * FROM orders;";
                        $query_run2 = mysqli_query($conn, $query2);
                        $resultCheck2 = mysqli_num_rows($query_run2);

                        if ($resultCheck > 0 && $resultCheck2 > 0) {
                            echo '<tr>
                        <th class="table_Style3">Customer name</th>
                                    <th class="table_Style3">Phone No</th>
                                    <th class="table_Style3">Order No</th>
                                    <th class="table_Style3">Order date</th>
                                    <th class="table_Style3">Status</th>
                                    <th class="table_Style3" colspan="2">Operation</th>
                    </tr>';
                            while (($row = mysqli_fetch_assoc($query_run)) && ($row2 = mysqli_fetch_assoc($query_run2))) {
                                ?>
                                <tr>
                                    <td class="table_Style2" style="word-break: break-word;"><?php echo $row['cust_name']; ?></td>
                                    <td class="table_Style2"><?php echo $row['cust_contact_no']; ?></td>
                                    <td class="table_Style2">OD<?php echo $row2['order_id']; ?></td>
                                    <td class="table_Style2"><?php echo $row2['order_date']; ?></td>
                                    <td class="table_Style2"><?php echo $row2['order_status']; ?></td>
                                    <td class="table_Style2"><a href="admin-cust-update.php?cust_id=<?php echo $row['cust_id']; ?>" class="btnAdmin">Update</a></td>
                                    <td class="table_Style2"><a href="admin-order-delete.php?order_id=<?php echo $row2['order_id']; ?>" class="btnAdminRed" onclick="return confirm('Are you sure you want to Remove?');">DELETE</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<center><h3 style="color:white;">⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿<br>
                            ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿<br>
                            
                            █▄░█ █▀█   █▀█ █▀▀ █▀ █░█ █░░ ▀█▀ █▀   █▀▀ █▀█ █░█ █▄░█ █▀▄<br>
                            █░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3></center>';
                        }
                        ?>

                    </table>
                </form>

            </div>

            <div id="view_div">
                <form action="" method="post">
                    <table class="orderTable" style="width: 80%;max-width: 80%;">
                        <h1 class="hl_style">View Orders</h1>
                        <h2 class="hl_style">Customers</h2>
                        <?php
                        include_once './connection.php';

                        $query = "SELECT * FROM customer;";
                        $query_run = mysqli_query($conn, $query);
                        $resultCheck = mysqli_num_rows($query_run);

                        $query2 = "SELECT * FROM orders;";
                        $query_run2 = mysqli_query($conn, $query2);
                        $resultCheck2 = mysqli_num_rows($query_run2);

                        if ($resultCheck > 0 && $resultCheck2 > 0) {
                            echo '<tr>
                        <th class="table_Style3">Customer name</th>
                                    <th class="table_Style3">Phone No</th>
                                    <th class="table_Style3">Order No</th>
                                    <th class="table_Style3">Order date</th>
                                    <th class="table_Style3">Status</th>
                                    <th class="table_Style3" colspan="3">Operation</th>
                    </tr>';
                            while (($row = mysqli_fetch_assoc($query_run)) && ($row2 = mysqli_fetch_assoc($query_run2))) {
                                ?>
                                <tr>
                                    <td class="table_Style2" style="word-break: break-word;"><?php echo $row['cust_name']; ?></td>
                                    <td class="table_Style2"><?php echo $row['cust_contact_no']; ?></td>
                                    <td class="table_Style2">OD<?php echo $row2['order_id']; ?></td>
                                    <td class="table_Style2"><?php echo $row2['order_date']; ?></td>
                                    <td class="table_Style2"><?php echo $row2['order_status']; ?></td>
                                    <td class="table_Style2"><a href="admin-order-view.php?order_id=<?php echo $row2['order_id']; ?>" class="btnAdmin">View</a></td>
                                    <td class="table_Style2"><a href="admin-order-delete.php?order_id=<?php echo $row2['order_id']; ?>" class="btnAdminRed" onclick="return confirm('Are you sure you want to Remove?');">DELETE</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<center><h3 style="color:white;">⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿<br>
⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿<br>
⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿<br>
⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿<br>
⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿<br>

█▄░█ █▀█   █▀█ █▀▀ █▀ █░█ █░░ ▀█▀ █▀   █▀▀ █▀█ █░█ █▄░█ █▀▄<br>
█░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3></center>';
                        }
                        ?>

                    </table>
                </form>

            </div>

            <div id="fulfill_div">
                <table style="width: 80%; max-width: 80%;">
                    <h1 class="hl_style">Fulfill Orders</h1>
                    <h2 class="hl_style">Customers</h2>
                    <?php
                    include_once './connection.php';

                    $query = "SELECT * FROM customer;";
                    $query_run = mysqli_query($conn, $query);
                    $resultCheck = mysqli_num_rows($query_run);

                    $query2 = "SELECT * FROM orders;";
                    $query_run2 = mysqli_query($conn, $query2);
                    $resultCheck2 = mysqli_num_rows($query_run2);

                    if ($resultCheck > 0 && $resultCheck2 > 0) {
                        echo '<tr>
                        <th class="table_Style3">Customer name</th>
                                    <th class="table_Style3">Phone No</th>
                                    <th class="table_Style3">Order No</th>
                                    <th class="table_Style3">Order date</th>
                                    <th class="table_Style3">Status</th>
                                    <th class="table_Style3" colspan="2">Operation</th>
                    </tr>';
                        while (($row = mysqli_fetch_assoc($query_run)) && ($row2 = mysqli_fetch_assoc($query_run2))) {
                            ?>
                            <tr>
                                <td class="table_Style2" style="word-break: break-word;"><?php echo $row['cust_name']; ?></td>
                                <td class="table_Style2"><?php echo $row['cust_contact_no']; ?></td>
                                <td class="table_Style2">OD<?php echo $row2['order_id']; ?></td>
                                <td class="table_Style2"><?php echo $row2['order_date']; ?></td>
                                <td class="table_Style2"><?php echo $row2['order_status']; ?></td>
                                <td class="table_Style2"><a href="admin-fulfill.php?order_id=<?php echo $row2['order_id']; ?>" class="btnAdmin">Fulfill</a></td>
                                <td class="table_Style2"><a href="admin-order-delete.php?order_id=<?php echo $row2['order_id']; ?>" class="btnAdminRed" onclick="return confirm('Are you sure you want to Remove?');">DELETE</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<center><h3 style="color:white;">⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿<br>
                        ⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿<br>
                        
                        █▄░█ █▀█   █▀█ █▀▀ █▀ █░█ █░░ ▀█▀ █▀   █▀▀ █▀█ █░█ █▄░█ █▀▄<br>
                        █░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3></center>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <script src="sidebar.js"></script>

        <?php include 'footer.php';
        ?>    

    </body>
</html>
