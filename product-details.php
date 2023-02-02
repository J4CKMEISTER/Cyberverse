<?php
session_start();

include_once './connection.php';
$productID = $_GET["product_num"];
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->



<?php
if (isset($_POST["add_to_cart"])) {

    if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
        if (isset($_SESSION["shopping_cart_user"])) {


            if ($_POST["selectedSize"] != "------------------Select One-------------------") {
                $item_array_id_user = array_column($_SESSION["shopping_cart_user"], "item_id_user");
                if (!in_array($_GET["product_num"], $item_array_id_user)) {


                    $count = count($_SESSION["shopping_cart_user"]);
                    $item_array_user = array(
                        'item_id_user' => $_GET["product_num"],
                        'item_img_user' => $_POST["selectImg"],
                        'item_size_user' => $_POST["selectedSize"],
                        'item_name_user' => $_POST["hidden_name"],
                        'item_price_user' => $_POST["hidden_price"],
                        'item_quantity_user' => $_POST["quantity"]
                    );
                    $_SESSION["shopping_cart_user"][$count] = $item_array_user;
                    echo '<script>alert("Your Shopping Cart Has been updated !")</script>';
                } else {
                    foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
                        if ($values["item_id_user"] == $_GET["product_num"]) {
                            if ($_SESSION["shopping_cart_user"][$keys]["item_quantity_user"] < 5) {
                                $_SESSION["shopping_cart_user"][$keys]["item_quantity_user"] += $_POST["quantity"];
                                if ($_SESSION["shopping_cart_user"][$keys]["item_quantity_user"] > 5) {
                                    $_SESSION["shopping_cart_user"][$keys]["item_quantity_user"] = 5;
                                    echo '<script>alert("MAX Only 5 in the Cart")</script>';
                                }
                                echo '<script>alert("Item Already Added and Updated Quantity")</script>';
                            } else {
                                echo '<script>alert("Item Already Reached MAX Quantity 5")</script>';
                            }
                        }
                    }
                }
            } else {
                echo '<script>alert("Please select a size!!")</script>';
            }
        } else {
            if ($_POST["selectedSize"] != "------------------Select One-------------------") {
                $item_array_user = array(
                    'item_id_user' => $_GET["product_num"],
                    'item_img_user' => $_POST["selectImg"],
                    'item_size_user' => $_POST["selectedSize"],
                    'item_name_user' => $_POST["hidden_name"],
                    'item_price_user' => $_POST["hidden_price"],
                    'item_quantity_user' => $_POST["quantity"]
                );
                $_SESSION["shopping_cart_user"][0] = $item_array_user;
                echo '<script>alert("Your Shopping Cart Has been updated !")</script>';
            } else {
                echo '<script>alert("Please select a size!!")</script>';
            }
        }
    } else {
        if (isset($_SESSION["shopping_cart"])) {


            if ($_POST["selectedSize"] != "------------------Select One-------------------") {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                if (!in_array($_GET["product_num"], $item_array_id)) {


                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'item_id' => $_GET["product_num"],
                        'item_img' => $_POST["selectImg"],
                        'item_size' => $_POST["selectedSize"],
                        'item_name' => $_POST["hidden_name"],
                        'item_price' => $_POST["hidden_price"],
                        'item_quantity' => $_POST["quantity"]
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                    echo '<script>alert("Your Shopping Cart Has been updated !")</script>';
                } else {
                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                        if ($values["item_id"] == $_GET["product_num"]) {
                            if ($_SESSION["shopping_cart"][$keys]["item_quantity"] < 5) {
                                $_SESSION["shopping_cart"][$keys]["item_quantity"] += $_POST["quantity"];
                                if ($_SESSION["shopping_cart"][$keys]["item_quantity"] > 5) {
                                    $_SESSION["shopping_cart"][$keys]["item_quantity"] = 5;
                                    echo '<script>alert("MAX Only 5 in the Cart")</script>';
                                }
                                echo '<script>alert("Item Already Added and Updated Quantity")</script>';
                            } else {
                                echo '<script>alert("Item Already Reached MAX Quantity 5")</script>';
                            }
                        }
                    }
                }
            } else {
                echo '<script>alert("Please select a size!!")</script>';
            }
        } else {
            if ($_POST["selectedSize"] != "------------------Select One-------------------") {
                $item_array = array(
                    'item_id' => $_GET["product_num"],
                    'item_img' => $_POST["selectImg"],
                    'item_size' => $_POST["selectedSize"],
                    'item_name' => $_POST["hidden_name"],
                    'item_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][0] = $item_array;
                echo '<script>alert("Your Shopping Cart Has been updated !")</script>';
            } else {
                echo '<script>alert("Please select a size!!")</script>';
            }
        }
    }
}


if (isset($_GET["action"]) == "wishlist") {

    if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
        if (isset($_SESSION["wishlist_user"])) {
            $wishlist_array_id_user = array_column($_SESSION["wishlist_user"], "wishlist_id_user");

            if (!in_array($_GET["product_num"], $wishlist_array_id_user)) {


                $count = count($_SESSION["wishlist_user"]);
                $wishlist_array_user = array(
                    'wishlist_id_user' => $_GET["product_num"],
                    'wishlist_img_user' => $_POST["selectImg"],
                    'wishlist_name_user' => $_POST["hidden_name"],
                    'wishlist_price_user' => $_POST["hidden_price"]
                );
                $_SESSION["wishlist_user"][$count] = $wishlist_array_user;
                echo '<script>alert("Your Wishlist Has been updated !")</script>';
            } else {
                echo '<script>alert("Item Already Added to Wishlist")</script>';
            }
        } else {
            $wishlist_array_user = array(
                'wishlist_id_user' => $_GET["product_num"],
                'wishlist_img_user' => $_POST["selectImg"],
                'wishlist_name_user' => $_POST["hidden_name"],
                'wishlist_price_user' => $_POST["hidden_price"]
            );
            $_SESSION["wishlist_user"][0] = $wishlist_array_user;
            echo '<script>alert("Your Wishlist Has been updated !")</script>';
        }
    } else {
        if (isset($_SESSION["wishlist"])) {
            $wishlist_array_id = array_column($_SESSION["wishlist"], "wishlist_id");

            if (!in_array($_GET["product_num"], $wishlist_array_id)) {


                $count = count($_SESSION["wishlist"]);
                $wishlist_array = array(
                    'wishlist_id' => $_GET["product_num"],
                    'wishlist_img' => $_POST["selectImg"],
                    'wishlist_name' => $_POST["hidden_name"],
                    'wishlist_price' => $_POST["hidden_price"]
                );
                $_SESSION["wishlist"][$count] = $wishlist_array;
                echo '<script>alert("Your Wishlist Has been updated !")</script>';
            } else {
                echo '<script>alert("Item Already Added to Wishlist")</script>';
            }
        } else {
            $wishlist_array = array(
                'wishlist_id' => $_GET["product_num"],
                'wishlist_img' => $_POST["selectImg"],
                'wishlist_name' => $_POST["hidden_name"],
                'wishlist_price' => $_POST["hidden_price"]
            );
            $_SESSION["wishlist"][0] = $wishlist_array;
            echo '<script>alert("Your Wishlist Has been updated !")</script>';
        }
    }
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="icon" href="latest.png" type="image/x-icon">
        <link rel="stylesheet" href="product-style.css">
        <title>Cyberverse - Product Details</title>

    </head>
    <body>
        <?php
        include 'header.php';
        ?>
    <center>
        <table>
            <tr>
            <h2 class="style-h2"> Categories :
                <a class="style-a" href="products-by-cat.php?category=T">T-shirts</a>
                <a class="style-a" href="products-by-cat.php?category=Ho">Hoodies</a>
                <a class="style-a" href="products-by-cat.php?category=Ha">Hats</a>
                <a class="style-a" href="products-by-cat.php?category=P">Popular</a>
            </h2>
            </tr>             </table></center>
    <div class="clear"><center>
            <?php
            include_once './connection.php';

            $productNum = $_GET["product_num"];
            if ($productNum == 0){
                echo "<h2 style='color:white;'>cyberv{we_start_counting_from_zero_right?}</h2>";
             
           }
       
        

            $query = "SELECT * FROM product WHERE product_num = '$productNum';";
            $query_run = mysqli_query($conn, $query)or die(mysqli_error($conn, $query));
            $resultCheck = mysqli_num_rows($query_run)or die(mysqli_error($conn, $query));

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    
                    ?>
                    <table class="left">

                        <tr>
                            <td><?php echo '<img src="data:image;base64,' . base64_encode($row['image']) . '" style="width: 90%; height: auto;" >'; ?></td>

                        </tr>  
                    </table>
                    <table class="right">

                        <tr>
                            <td>
                                <form action="product-details.php?product_num=<?php echo $row["product_num"]; ?>" method="post">
                                    <h2 class="style-h2"><?php echo $row['product_name']; ?><br></h2>
                                    <h3 style="color:white;">RM <?php echo $row['price']; ?></h3><br>
                                    <input type="hidden" name="hidden_name" value="<?php echo $row['product_name']; ?>" />
                                    <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>" />
                                    <input type="hidden" name="selectImg" value="<?php echo base64_encode($row['image']); ?>" />
                                    <hr>

                                    <?php
                                    $size = array("S" => "Small",
                                        "M" => "Medium",
                                        "L" => "Large", "XL" => "Extra Large");
                                    ?>
                                    <label style="color:white">Size:</label>

                                    <select name="selectedSize"> 
                                        <?php
                                        echo"<option selected='selected'>------------------Select One-------------------</option>";
                                        foreach ($size as $key => $value) {
                                            echo"<option name='selectedSize' value='$key'>$value&nbsp($key)</option>";
                                        }
                                        ?>
                                    </select>

                                    <p>
                                        <label for="quantity" style="color:white;">Quantity (between 1 and 5):</label>
                                        <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"></p>
                                    <input type="submit" name="add_to_cart" id="addtocart-btn" onclick="popout()" value="Add to Cart">

                                    <p></form>
                                <form action="product-details.php?action=wishlist&product_num=<?php echo $row["product_num"]; ?>" method="post">
                                    <input type="hidden" name="hidden_name" value="<?php echo $row['product_name']; ?>" />
                                    <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>" />
                                    <input type="hidden" name="selectImg" value="<?php echo base64_encode($row['image']); ?>" />
                                    <button type="submit"><a href=""><img src="wishlist.png" width="35px" height="30px"></a></button>
                                </form>
                                </p>
                                <br>

                                <br><br>
                                <button type="button" class="collapsible">Description</button>
                                <div class="content">
                                    <?php
                                     if(str_contains($row['prod_description'],'<script>')){
                                        echo nl2br($row['prod_description']);
                                        echo "<script>alert('cyberv{remember_to_validate_input}')</script>";
                                     }
                                     
                                    else{echo nl2br($row['prod_description']); }
                                     ?>
                                </div>




                            </td>
                        </tr>

                    </table>
                </center></div>
            <?php
        }
    } else {
        echo '<h3 style="color:white;">⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
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
█░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3>';
    }
    ?>

    <script type="text/javascript" src="product-collapse.js"></script> 

</body>


</html>
<?php
include 'footer.php';
?>