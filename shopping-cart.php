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
        <link rel="icon" href="logo1.png" type="image/gif">
        <title>HH - Shopping Cart</title>
        <style>
          
            .cart-table{
                width: 100%;
                text-align: center;
                font-size: 20px;
            }
            .cart-table th,
            .cart-table td {
                border: 2px solid #00B2EE;
                padding: .625em;
                color:white;
            }
            .cart-btn{
                padding-top: 70px;
                padding-bottom: 60px;
            }
            .cart-btn a, #checkout{
                text-decoration: none;
                color: white;
                font-size: 20px;
            }
            .cart-btn button, #checkout {
                background-color: #42C0FB; 
                border: 1px solid #00B2EE;
                padding: 10px 24px; /* Some padding */
                cursor: pointer; /* Pointer/hand icon */
                float: left; /* Float the buttons side by side */
            }

            /* Clear floats (clearfix hack) */
            .cart-btn:after, #checkout:after {
                content: "";
                clear: both;
                display: table;
            }

            .cart-btn button:not(:last-child), #checkout:not(:last-child) {
                border-right: none; /* Prevent double borders */
            }

            /* Add a background color on hover */
            .cart-btn button:hover, #checkout:hover {
                background-color: #00A0C6;
            }
            .total{
                float: right;
                font-size: 20px;
            }
            @media (max-width: 600px){
                .cart-table tr td{
                    border: 1.5px solid #00B2EE;
                }
                th{
                    display: none;
                }
                .cart-table tr td{
                    display: block;
                    text-align: center;
                }
            
                .cart-table td::before {
                    /*
                    * aria-label has no advantage, it won't be read inside a table
                    content: attr(aria-label);
                    */
                    content: attr(data-label);
                    float:left;
                    font-weight: bold;
                    text-transform: uppercase;
                }

                .cart-table tr td{
                    border-bottom: 0;
                    padding-bottom: 50px;
                }
                .cart-table td:last-child{
                    border-bottom: 1.5px solid #00B2EE;
                }
            }
        </style>

    </head>
    <body>
        <?php
        include 'header.php';
        ?>



        <h1 style="font-size: 40px;color:white"><center>Shopping Cart</center></h1>

        <form action="checkout-form.php" method="post">
            <table class="cart-table">

                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    if (!empty($_SESSION["shopping_cart_user"])) {
                        $total = 0;
                        ?>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
                            ?>
                            <tr class="border-tr">
                                <td><a href="product-details.php?product_num=<?php echo $values["item_id_user"]; ?>"><?php echo '<img src="data:image;base64,' . $values["item_img_user"] . '" style="width: 80px; height: 80px;" >'; ?></a></td>
                                <td><a href="product-details.php?product_num=<?php echo $values["item_id_user"]; ?>"><?php echo $values["item_name_user"]; ?></a></td>
                                <td><?php echo $values["item_size_user"]; ?></td>
                                <td>RM <?php echo $values["item_price_user"]; ?></td>
                                <td><?php echo $values["item_quantity_user"]; ?></td>
                                
                                <td>RM <?php echo $values["item_quantity_user"] * $values["item_price_user"]; ?></td>
                                <td><a href="shopping-cart.php?action=delete&product_num=<?php echo $values["item_id_user"]; ?>">Remove</a></td>
                            </tr>

                            <?php
                            $total = $total + ($values["item_quantity_user"] * $values["item_price_user"]);
                        }
                        ?>
                        <?php
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
                } else {
                    if (!empty($_SESSION["shopping_cart"])) {
                        $total = 0;
                        ?>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                        <?php
                        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                            ?>
                            <tr class="border-tr">
                                <td><a href="product-details.php?product_num=<?php echo $values["item_id"]; ?>"><?php echo '<img src="data:image;base64,' . $values["item_img"] . '" style="width: 80px; height: 80px;" >'; ?></a></td>
                                <td><a href="product-details.php?product_num=<?php echo $values["item_id"]; ?>"><?php echo $values["item_name"]; ?></a></td>
                                <td><?php echo $values["item_size"]; ?></td>
                                <td>RM <?php echo $values["item_price"]; ?></td>
                                <td><?php echo $values["item_quantity"]; ?></td>
                                <td>RM <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                                <td><a href="shopping-cart.php?action=delete&product_num=<?php echo $values["item_id"]; ?>">Remove</a></td>
                            </tr>

                            <?php
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
                        ?>
                        <?php
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
                }
                ?>


            </table>

            <div class="total">
                <p>Subtotal : RM <?php
                    if (empty($total)) {
                        echo '0';
                    } else {
                        echo $total;
                    }
                    ?></p>
                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    if(!empty($_SESSION["shopping_cart_user"])){
                        echo '<input type="submit" value="Checkout" class="checkout" id="checkout">';
                    }
                } else {
                    if (!empty($_SESSION["shopping_cart"])) {
                        ?>
                        <input type="submit" value="Checkout" class="checkout" id="checkout">
                    <?php
                    }
                }
                ?>
            </div>



        </form>
        <div class="cart-btn">
            <button><a href="shopAll.php">Continue Shopping</a></button>
            <button><a href="shopping-cart.php?action=clear">Empty Cart</a></button>
            <button><a href="wishlist.php">Wishlist</a></button>
            <button><a href="order-status.php">Order Status</a></button>

        </div>
        <?php
        if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
            if (isset($_GET["action"])) {
                if ($_GET["action"] == "delete") {
                    foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
                        if ($values["item_id_user"] == $_GET["product_num"]) {
                            unset($_SESSION["shopping_cart_user"][$keys]);
                            echo '<script>alert("Item Removed")</script>';
                            echo '<script>window.location.href="shopping-cart.php"</script>';
                        }
                    }
                }
                if ($_GET["action"] == "clear") {
                    unset($_SESSION["shopping_cart_user"]);
                    echo '<script>alert("Item Cleared")</script>';
                    echo '<script>window.location.href="shopping-cart.php"</script>';
                }
            }
        } else {
            if (isset($_GET["action"])) {
                if ($_GET["action"] == "delete") {
                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                        if ($values["item_id"] == $_GET["product_num"]) {
                            unset($_SESSION["shopping_cart"][$keys]);
                            echo '<script>alert("Item Removed")</script>';
                            echo '<script>window.location.href="shopping-cart.php"</script>';
                        }
                    }
                }
                if ($_GET["action"] == "clear") {
                    unset($_SESSION["shopping_cart"]);
                    echo '<script>alert("Item Cleared")</script>';
                    echo '<script>window.location.href="shopping-cart.php"</script>';
                }
            }
        }
        ?>

        <?php
        include 'footer.php';
        ?>
    </body>
</html>