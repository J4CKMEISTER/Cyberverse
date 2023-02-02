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
        <title>HH - Wishlist</title>
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
                /*.border-tr{

                }*/
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

        <h1 style="font-size: 40px;color:White"><center>Wishlist</center></h1>

        <form>
            <table class="cart-table">


                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    if (!empty($_SESSION["wishlist_user"])) {
                        $total = 0;
                        ?>

                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>

                            <th>Remove</th>
                        </tr>

                        <?php
                        foreach ($_SESSION["wishlist_user"] as $keys => $values) {
                            ?>
                            <tr class="border-tr">
                                <td><a href="product-details.php?product_num=<?php echo $values["wishlist_id_user"]; ?>"><?php echo '<img src="data:image;base64,' . $values["wishlist_img_user"] . '" style="width: 80px; height: 80px;" >'; ?></a></td>
                                <td><a href="product-details.php?product_num=<?php echo $values["wishlist_id_user"]; ?>"><?php echo $values["wishlist_name_user"]; ?></a></td>
                                <td>RM <?php echo $values["wishlist_price_user"]; ?></td>
                                <td><a href="wishlist.php?action=delete&product_num=<?php echo $values["wishlist_id_user"]; ?>">Remove</a></td>
                            </tr>

                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        echo '<p style="color:white"><center>⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
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
█░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></center></p>';
                    }
                } else {
                    if (!empty($_SESSION["wishlist"])) {
                        $total = 0;
                        ?>

                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>

                            <th>Remove</th>
                        </tr>

                        <?php
                        foreach ($_SESSION["wishlist"] as $keys => $values) {
                            ?>
                            <tr class="border-tr">
                                <td><a href="product-details.php?product_num=<?php echo $values["wishlist_id"]; ?>"><?php echo '<img src="data:image;base64,' . $values["wishlist_img"] . '" style="width: 80px; height: 80px;" >'; ?></a></td>
                                <td><a href="product-details.php?product_num=<?php echo $values["wishlist_id"]; ?>"><?php echo $values["wishlist_name"]; ?></a></td>
                                <td>RM <?php echo $values["wishlist_price"]; ?></td>
                                <td><a href="wishlist.php?action=delete&product_num=<?php echo $values["wishlist_id"]; ?>">Remove</a></td>
                            </tr>

                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        echo '<center>⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶<br>
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
█░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></center>';
                    }
                }
                ?>

                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    if (isset($_GET["action"])) {
                        if ($_GET["action"] == "delete") {
                            foreach ($_SESSION["wishlist_user"] as $keys => $values) {
                                if ($values["wishlist_id_user"] == $_GET["product_num"]) {
                                    unset($_SESSION["wishlist_user"][$keys]);
                                    echo '<script>alert("Item Removed")</script>';
                                    echo '<script>window.location.href="wishlist.php"</script>';
                                }
                            }
                        }
                        if ($_GET["action"] == "clear") {
                            if (!empty($_SESSION["wishlist_user"])) {
                                unset($_SESSION["wishlist_user"]);
                                echo '<script>alert("Item Cleared")</script>';
                                echo '<script>window.location.href="wishlist.php"</script>';
                            } else {
                                echo '<script>alert("No items in wishlist!")</script>';
                                echo '<script>window.location.href="wishlist.php"</script>';
                            }
                        }
                    }
                } else {
                    if (isset($_GET["action"])) {
                        if ($_GET["action"] == "delete") {
                            foreach ($_SESSION["wishlist"] as $keys => $values) {
                                if ($values["wishlist_id"] == $_GET["product_num"]) {
                                    unset($_SESSION["wishlist"][$keys]);
                                    echo '<script>alert("Item Removed")</script>';
                                    echo '<script>window.location.href="wishlist.php"</script>';
                                }
                            }
                        }
                        if ($_GET["action"] == "clear") {
                            if (!empty($_SESSION["wishlist"])) {
                                unset($_SESSION["wishlist"]);
                                echo '<script>alert("Item Cleared")</script>';
                                echo '<script>window.location.href="wishlist.php"</script>';
                            } else {
                                echo '<script>alert("No items in wishlist!")</script>';
                                echo '<script>window.location.href="wishlist.php"</script>';
                            }
                        }
                    }
                }
                ?>

            </table>



            <div class="cart-btn">
                <button><a href="shopAll.php">Continue Shopping</a></button>
                <button><a href="wishlist.php?action=clear">Empty Wishlist</a></button>

            </div>
        </form>
        <?php
        include 'footer.php';
        ?>
    </body>
</html>
