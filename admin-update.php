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
    </head>
    <body>
        <?php

        function validation() {
            $error = array();
            $newPrice = ($_POST['new_price']);
            $patternPrice = '/^(0|[1-9]\d*)(\.\d{2})?$/';
            $newProductName = ($_POST['new_name']);
            $nameLength = strlen($newProductName);
            if ($nameLength < 4) {
                $error['new_name'] = "<b>Product Name</b> must be at least 4 characters";
            }
            if ($nameLength > 45) {
                $error['new_name'] = "<b>Product Name</b> cannot be greater than 45 characters";
            }
            if (!preg_match($patternPrice, $newPrice)) {
                $error['new_price'] = "Please enter valid <b>price (999.99)</b>";
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
                <h1>This is admin panel , proceed with caution !</h1></center>
        </div>

        <div id="sidebar">
            <ul>
                <a href="admin.php" style="text-decoration: none;"><li class="side-content">Go back</li></a>
            </ul>
        </div>
        <?php
        include_once './connection.php';
        $productID = $_GET["product_num"];
        $query = "SELECT * FROM product WHERE product_num='$productID';";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($query_run);

        if (isset($_POST['adminUpdate'])) {
            $image = $_FILES['newProductIMG']['tmp_name'];
            $file = addslashes(file_get_contents($image));

            $editName = ($_POST['new_name']);
            $newProductDescription = ($_POST['updateDesc']);
            $newPrice = ($_POST['new_price']);
            $newQuantity = ($_POST['new_quantity']);
            $newCategory = ($_POST['selectedCategory']);

            $error = validation();

            if (empty($error)) {
                $query = "UPDATE product SET image ='$file', product_name='$editName' , price='$newPrice' , quantity='$newQuantity', category='$newCategory', prod_description = '$newProductDescription' WHERE product_num='$productID';";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    echo '<script type="text/javascript"> alert("Product updated to database")</script>'; 
                    echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
                } else {
                    echo '<script type="text/javascript"> alert("Failed! WHAT AM I GONNA DO?!") </script>';
                }
            } else {
                echo"<div id='addError' style='background-color:#ffcccb;width:100%;'>";
                printf("<ul style='color:red; display: inline-block;'><li>%s</li></ul>", implode("</li><li>", $error));
                echo'</div>';
            }
        }
        ?>
        <div id="data">
            <form method="post" enctype="multipart/form-data">
                <table>
                    <tr><td><h1 class="hl_style">Edit Product</h1></td></tr>
                    <tr>
                        <td class="table_Style">
                            <label>New Product Name : </label>
                            <input name="new_name" type="text" id="namebox" value="<?php echo $row['product_name']; ?>" required />  
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>New Product Price : </label>
                            <input name="new_price" type="text" id="price" value="<?php echo $row['price']; ?>" required />  
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="table_Style">
                            <label>New Product Quantity : </label>
                            <input name="new_quantity" type="number" id="quantity" value="<?php echo $row['quantity']; ?>" required />  
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">

                            <label>New Category : </label>

                            <?php
                            $category = array("T" => "T-shirts",
                                "Ho" => "Hoodies", "Ha" => "Hats", "P" => "Popular");
                            ?>
                            <select name="selectedCategory"> 
                                <?php
                                //echo"<option selected='selected'>------------------Select One-------------------</option>";
                                foreach ($category as $key => $value) {
                                    echo"<option name='selectedCat' value='$key'";
                                    if ($row['category'] == $key) {
                                        echo'selected = "selected" />';
                                    }
                                    echo '<span>' . $value . '&nbsp(' . $key . ')</span>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>



                    <tr>
                        <td class="table_Style"> 
                            <label for="image">New Product Image : </label>
                            <input type="file" name="newProductIMG" id="updateProductIMG" required>


                        </td>    
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>New Product Description : </label>
                            <textarea name="updateDesc"><?php echo $row['prod_description']; ?></textarea>
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
