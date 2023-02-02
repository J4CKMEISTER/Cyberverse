<?php session_start(); ?>
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
        <title>Cyberverse - Order Status</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image:url("cartBack.png");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                color: white;
                width: 100%;
            }
            /* styling the buttons*/
            .checkout-btn {
                background-color: #42C0FB; 
                border: 2px solid #00B2EE;
                cursor: pointer; /* Pointer/hand icon */
                font-size: 20px;
                text-decoration: none;
                color: black;
                padding: 10px;
                float: right;
            }
            /* Add a background color on hover */
            .checkout-btn:hover {
                background-color: #00A0C6;
            }
            /*control image*/
            .cart-img{
                border-radius: 300px 320px 260px 260px;
                margin-left: auto;
                margin-right: auto;
                display: block;
                width: 30%;
                height: auto;
            }
            /* styling the form */
            .checkout-form {
                border-radius: 25px;
                background: rgba(52, 152, 219, 0.3);
                padding: 20px; 
                width: 90%;
                height: auto; 
                margin-bottom: 50px;
                margin-top: 50px;
                margin-left: auto;
                margin-right: auto;
            }
            .checkout-content{
                padding: 80px;
                margin-top: -20px;
            }
            .checkout-content p{
                font-size: 20px;
            }
            .cartbottom{
                float: right;
            }
            
            
        </style>
    </head>
    <body>
        <?php
        include_once './connection.php';

        $link_id = $_SESSION['storeID'];
        if (isset($_POST['done'])) {
            if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
                    $name = $values["item_name_user"];
                    $size = $values["item_size_user"];
                    $price = $values["item_price_user"];
                    $quantity = $values["item_quantity_user"];
                    $image = $values["item_img_user"];

                    $storingCart = "INSERT INTO details (details_name, details_size, details_price, details_quantity, details_image, link_orders) VALUES ('$name', '$size', '$price', '$quantity', '$image', '$link_id');";
                    $query_run = mysqli_query($conn, $storingCart);

                    if ($query_run) {
                        echo '<script type="text/javascript"> alert("ARIGATO GOSAIMASU") </script>';
                        unset($_SESSION["shopping_cart_user"]);
                        echo '<script type="text/javascript"> window.location.href = "shopAll.php"</script>';
                    } else {
                        echo '<script type="text/javascript"> alert("Failed") </script>';
                    }
                }
            } else {
                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                    $name = $values["item_name"];
                    $size = $values["item_size"];
                    $price = $values["item_price"];
                    $quantity = $values["item_quantity"];
                    $image = $values["item_img"];

                    $storingCart = "INSERT INTO details (details_name, details_size, details_price, details_quantity, details_image, link_orders) VALUES ('$name', '$size', '$price', '$quantity', '$image', '$link_id');";
                    $query_run = mysqli_query($conn, $storingCart);

                    if ($query_run) {
                        echo '<script type="text/javascript"> alert("ARIGATO GOSAIMASU") </script>';
                        unset($_SESSION["shopping_cart_user"]);
                        echo '<script type="text/javascript"> window.location.href = "shopAll.php"</script>';
                    } else {
                        echo '<script type="text/javascript"> alert("Failed") </script>';
                    }
                }
            }
        }
        ?>
        <h1 style="font-size: 40px;"><center>Hyper Hasagi</center></h1>
        <img src="Gravity.Falls.full.2109794.gif" class="cart-img">
        <div class="checkout-form">
            <form action="" class="checkout-content" method="post">
                <div>
                    <div class="message">
                        <h1>Order has been done and confirmed !!</h1>
                    </div>
                    <hr>
                    <div class="message">
                        <p>Thank you for Purchasing Products from Hyper Hasagi Sdn Bhd</p>
                        <p>We are always here and you are welcome to visit us again !</p>
                    </div>

                </div>
                <input type="submit" name="done" class="checkout-btn" value="Proceed">
                </form>
        </div>


    </div>
</body>
</html>