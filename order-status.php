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
            .message{
                display: flex;
                justify-content: space-between;
            }
            #order{
                cursor: pointer;
            }
            #details{
                display: none;
            }

        </style>

    </head>
    <body>

        <h1 style="font-size: 40px;"><center>Hyper Hasagi</center></h1>
        <img src="Gravity.Falls.full.2109794.gif" class="cart-img">
        <div class="checkout-form">
            <form action="" class="checkout-content" method="post">
                <div>
                    <div class="message">
                        <h1>Order</h1>
                        <h1>Status</h1>
                    </div>
                    <hr>
                    <?php
                    include_once './connection.php';

                    if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                        $user_email = $_SESSION['session_email']; //get user id
                        $sql = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1;"; //get user id and details
                        $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
                        $row = mysqli_fetch_assoc($result); //check if the record already exist

                        $userName = $row['user_name'];
                        $userContact = $row['user_phone'];
                        $userEmail = $row['user_email'];
                        $userAddress = $row['user_address'];

                        $sqlGetDetail = "SELECT cust_id FROM customer WHERE cust_name='$userName' AND cust_contact_no='$userContact' AND cust_email='$userEmail' AND cust_address='$userAddress';";
                        $result = mysqli_query($conn, $sqlGetDetail)or die(mysqli_error($conn) . " Error = " . $sqlGetDetail);
                        //$rowGet = mysqli_fetch_assoc($result); //check if the record already exist

                        while ($rowGetID = mysqli_fetch_assoc($result)) {
                            $get = $rowGetID['cust_id'];


                            $sqlOrder = "SELECT * FROM orders WHERE order_id = '$get';";
                            $sqlOrder_run = mysqli_query($conn, $sqlOrder);
                            $resultCheck = mysqli_num_rows($sqlOrder_run);

                            if ($resultCheck > 0) {

                                while ($rowOrder = mysqli_fetch_assoc($sqlOrder_run)) {
                                    ?>

                                    <div class="message">
                                        <p id="order"><strong>OD<?php echo $rowOrder['order_id']; ?></strong></p>
                                        <p><?php echo $rowOrder['order_status']; ?></p>
                                    </div>




                                    <div id="details">
                                        <h1>Order Information</h1>
                                        <h2>Address</h2>
                                        <p><?php echo $userAddress; ?></p>
                                        <h2>Order Date</h2>
                                        <p><?php echo $rowOrder['order_date']; ?></p>

                                        <div>
                                            <p><strong>Items</strong></p>

                                            <?php
                                            $sqlOrderItems = "SELECT * FROM details WHERE link_orders = '$get';";
                                            $sqlOrderItems_run = mysqli_query($conn, $sqlOrderItems);
                                            $resultCheckItems = mysqli_num_rows($sqlOrderItems_run);

                                            if ($resultCheckItems > 0) {
                                                $total = 0;
                                                while ($rowOrderItems = mysqli_fetch_assoc($sqlOrderItems_run)) {
                                                    ?>

                                                    <p><img src="data:image;base64,<?php echo $rowOrderItems['details_image'] ?>" style="width: 40px; height: 40px;" align="left">&nbsp;&nbsp;<?php echo $rowOrderItems['details_name'] . ' (' . $rowOrderItems['details_size'] . ')'; ?> <span class="cartbottom">RM <?php echo number_format($rowOrderItems['details_price'] * $rowOrderItems['details_quantity'], 2); ?></span></p>


                                                    <?php
                                                    $total += $rowOrderItems['details_price'] * $rowOrderItems['details_quantity'];
                                                }
                                            }
                                            ?>

                                            <hr>
                                            <p>Total <span class="cartbottom"><b>RM <?php echo number_format($total, 2); ?></b></span></p>
                                        </div>
                                    </div>
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
                        }
                        ?>
                        <?php
                    } else {
                        $sqlOrder = "SELECT * FROM orders WHERE check_user = 'customer';";
                        $sqlOrder_run = mysqli_query($conn, $sqlOrder);
                        $resultCheck = mysqli_num_rows($sqlOrder_run);



                        if ($resultCheck > 0) {

                            while ($rowOrder = mysqli_fetch_assoc($sqlOrder_run)) {
                                $get = $rowOrder['order_id'];

                                $sqlCust = "SELECT * FROM customer WHERE cust_id = '$get';";
                                $sqlCust_run = mysqli_query($conn, $sqlCust);
                                while ($row = mysqli_fetch_assoc($sqlCust_run)) {
                                    ?>

                                    <div class="message">
                                        <p id="order"><strong>OD<?php echo $rowOrder['order_id']; ?></strong></p>
                                        <p><?php echo $rowOrder['order_status']; ?></p>
                                    </div>

                                    <div id="details">
                                        <h1>Order Information</h1>
                                        <h2>Address</h2>
                                        <p><?php echo $row['cust_address']; ?></p>
                                        <h2>Order Date</h2>
                                        <p><?php echo $rowOrder['order_date']; ?></p>

                                        <div>
                                            <p><strong>Items</strong></p>

                                            <?php
                                            $sqlOrderItems = "SELECT * FROM details WHERE link_orders = '$get';";
                                            $sqlOrderItems_run = mysqli_query($conn, $sqlOrderItems);
                                            $resultCheckItems = mysqli_num_rows($sqlOrderItems_run);

                                            if ($resultCheckItems > 0) {
                                                $total = 0;
                                                while ($rowOrderItems = mysqli_fetch_assoc($sqlOrderItems_run)) {
                                                    ?>

                                                    <p><img src="data:image;base64,<?php echo $rowOrderItems['details_image'] ?>" style="width: 40px; height: 40px;" align="left">&nbsp;&nbsp;<?php echo $rowOrderItems['details_name'] . ' (' . $rowOrderItems['details_size'] . ')'; ?> <span class="cartbottom">RM <?php echo number_format($rowOrderItems['details_price'] * $rowOrderItems['details_quantity'], 2); ?></span></p>


                                                    <?php
                                                    $total += $rowOrderItems['details_price'] * $rowOrderItems['details_quantity'];
                                                }
                                            }
                                            ?>

                                            <hr>
                                            <p>Total <span class="cartbottom"><b>RM <?php echo number_format($total, 2); ?></b></span></p>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
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








                    <a href="shopAll.php" class="checkout-btn" id="return">Continue Shopping</a></form>
        </div>


    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    //toggle details on/off
    $(document).ready(function () {
        $("div.message").click(function () {
            $(this).next().toggle();
        });
    });
</script>
</html>
