<?php session_start();
error_reporting(E_ERROR | E_PARSE);
 foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
    
  $total1 = $total + ($values["item_quantity_user"] * $values["item_price_user"]);
 }

    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        
    $total2 = $total + ($values["item_quantity"] * $values["item_price"]);
}

  if($total1 <= 0 || $total2 <= 0){
    echo"<script>alert('cyberv{no_need_pay_yay}')</script>";
}
   



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
        <title>Cyberverse - Checkout</title>
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
            .checkout-content label{
                font-size: 20px;
            }
            .checkout-content p{
                font-size: 25px;
            }
            /* input box sizing */
            .username-check, .password-check, .password-confirm-check,
            #name-check, #address-check, #city-check, 
            #email-check, #phone-check{
                background: grey;
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }
            /* placeholder text color */
            .username-check::placeholder, .password-check::placeholder, .password-confirm-check::placeholder,
            #name-check::placeholder, #address-check::placeholder, #city-check::placeholder, 
            #email-check::placeholder, #phone-check::placeholder, .cvv::placeholder, .exp-mon::placeholder{
                color: black;
                opacity: 1; /* firefox */
            }
            /* other browser */
            .username-check::-ms-input-placeholder, .password-check::-ms-input-placeholder, .password-confirm-check::-ms-input-placeholder,
            #name-check::-ms-input-placeholder, #address-check::-ms-input-placeholder, #city-check::-ms-input-placeholder, 
            #email-check::-ms-input-placeholder, #phone-check::-ms-input-placeholder, .cvv::placeholder, .exp-mon::placeholder{
                color: black;
            }

            /* arrange the bottom buttons */
            .checkout-btm{
                margin-top: 20px;
                display: flex;
                position: relative;
                justify-content: space-between;
            }
            .cartbottom{
                float: right;
            }


            .hide {
                display: none;
            }
            .checkout-content p {
                font-weight: bold;
            }
            .payment-img{
                width: 40px;
                height: auto;
                margin-bottom: -15px;
                padding-left: 10px;
            }
            #visacard, #mastercard{
                border-radius: 25px;
                background: rgba(52, 152, 219, 0.3);
                padding: 20px; 
                width: 50%;
                height: auto; 
                margin-bottom: 50px;
                margin-top: -20px;
                margin-left: auto;
                margin-right: auto;
            }
            label{
                display: block;
            }


            .exp-mon, .cvv{
                background: grey;
                width: 45%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }
            .error {
                color: #F00;
                background-color: #FFF;
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <?php
        $states = array("JH" => "Johor", "KD" => "Kedah", "KT" => "Kelantan",
            "KL" => "Kuala Lumpur", "LB" => "Labuan", "MK" => "Melaka",
            "NS" => "Negeri Sembilan", "PH" => "Pahang", "PR" => "Perak",
            "PL" => "Perlis", "PJ" => "Putrajaya", "SB" => "Sabah",
            "SW" => "Sarawak", "SG" => "Selangor", "TR" => "Terengganu");
        ?>
        <h1 style="font-size: 40px;"><center>Checkout</center></h1>
        <img src="Gravity.Falls.full.2109794.gif" class="cart-img">
        <div class="checkout-form">
            <?php
            include_once './connection.php';

            if (isset($_POST['placeorder'])) {
                //variables for visa cardtype
                $cardName = $_POST['visa'];
                $cardNo = $_POST['visaNo'];
                $cardExp = $_POST['visaMon'];
                $cardCvv = $_POST['visaCvv'];

                //variables for mastercard cardtype
                $cardNameM = $_POST['master'];
                $cardNoM = $_POST['masterNo'];
                $cardExpM = $_POST['masterMon'];
                $cardCvvM = $_POST['masterCvv'];



                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    $user_email = $_SESSION['session_email']; //get user id
                    $sql = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1;"; //get user id and details
                    $result = mysqli_query($conn, $sql)or die(mysqli_error($conn) . " Error = " . $sql);
                    $row = mysqli_fetch_assoc($result); //check if the record already exist

                    $custName = $row['user_name'];
                    $custContact = $row['user_phone'];
                    $custEmail = $row['user_email'];
                    $custAddress = $row['user_address'];
                    $custCity = 'Malaysia';
                } else {
                    $custName = $_POST['name'];
                    $custContact = $_POST['phoneNumCheck'];
                    $custEmail = $_POST['email'];
                    $custAddress = $_POST['addressCheck'];
                    $custCity = $_POST['city'];
                }


                if ($_POST['payment'] == "payment1") {

                    $query = "INSERT INTO customer (cust_name, cust_contact_no, cust_email, cust_address, country, payment_type) VALUES ('$custName', '$custContact', '$custEmail', '$custAddress', '$custCity', 'Cash on Delivery');";
                } else if ($_POST['payment'] == "payment2") {

                    $query = "INSERT INTO customer (cust_name, cust_contact_no, cust_email, cust_address, country, payment_type) VALUES ('$custName', '$custContact', '$custEmail', '$custAddress', '$custCity', 'Credit Card');";
                }
                global $conn;

                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    if ($_POST['payment'] == "payment1") {
                        $query = "INSERT INTO card (card_name, card_no, card_exp, card_cvv, card_type) VALUES ('null', 'null', 'null', 'null', 'null');";
                        $query_run = mysqli_query($conn, $query);
                    } else if ($_POST['card'] == "visacard") {
                        $query = "INSERT INTO card (card_name, card_no, card_exp, card_cvv, card_type) VALUES ('$cardName', '$cardNo', '$cardExp', '$cardCvv', 'Visa');";
                        $query_run = mysqli_query($conn, $query);
                    } else if ($_POST['card'] == "mastercard") {
                        $query = "INSERT INTO card (card_name, card_no, card_exp, card_cvv, card_type) VALUES ('$cardNameM', '$cardNoM', '$cardExpM', '$cardCvvM', 'Mastercard');";
                        $query_run = mysqli_query($conn, $query);
                    }
                    if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                        $query = "INSERT INTO orders (order_date, order_status, check_user) VALUES (CURDATE(), 'Pending', 'user');";
                        $query_run = mysqli_query($conn, $query);
                    } else {
                        $query = "INSERT INTO orders (order_date, order_status, check_user) VALUES (CURDATE(), 'Pending', 'customer');";
                        $query_run = mysqli_query($conn, $query);
                    }

                    $last_id = mysqli_insert_id($conn); //taking latest order_id

                    $_SESSION['storeID'] = $last_id; //store order_id to session
                    echo '<script type="text/javascript"> alert("Order Success") </script>';
                    echo '<script type="text/javascript"> window.location.href = "order-confirm.php"</script>';
                } else {
                    echo '<script type="text/javascript"> alert("Order Failed") </script>';
                }
            }
            ?>
            <form action="" method="post" class="checkout-content" id="feedbackForm">

                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                    echo '';
                } else {
                    ?>
                    <p><strong>Shipping Details</strong></p>
                    <hr>
                    <label for="name">Name</label>
                    <input name="name" type="text" id="name-check" placeholder="Name*" required />
                    <label for="address">Address</label>    
                    <input name="addressCheck" type="text" id="address-check" placeholder="Address"  />

                    <label for="city">City</label>
                    <select name="city" id="city-check">
                        <option value="" name="city">--Select One--</option>
                        <?php
                        foreach ($states as $key => $value) {
                            echo"<option name='city'>$value&nbsp($key)</option>";
                        }
                        ?>
                    </select>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email-check" placeholder="Email*" required />
                    <label for="phoneNum">Phone Number</label>
                    <input type="text" name="phoneNumCheck" id="phone-check" placeholder="Phone number"   />

                    <?php
                }
                ?>
                <div>
                    <p><strong>Shopping Cart</strong></p>


                    <?php
                    if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) {
                        if (!empty($_SESSION["shopping_cart_user"])) {
                            $total = 0;
                            ?>
                            <?php
                            foreach ($_SESSION["shopping_cart_user"] as $keys => $values) {
                                ?>
                                <p><?php echo '<img src="data:image;base64,' . $values["item_img_user"] . '" style="width: 45px; height: 45px;" align="left">'; ?>
                                    &nbsp;&nbsp;<?php echo $values["item_name_user"]; ?>
                                    <span class="cartbottom">RM <?php echo number_format($values["item_quantity_user"] * $values["item_price_user"], 2); ?></span></p>

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
                            <?php
                            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                                ?>
                                <p><?php echo '<img src="data:image;base64,' . $values["item_img"] . '" style="width: 45px; height: 45px;" align="left">'; ?>
                                    &nbsp;&nbsp;<?php echo $values["item_name"]; ?>
                                    <span class="cartbottom">RM <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></span></p>

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


                    <hr>
                    <p>Total <span class="cartbottom"><b>RM <?php
                                if (empty($total)) {
                                    echo '0';
                                } else {
                                    echo number_format($total, 2);
                                }
                                ?></b></span></p>
                </div>
                <hr>



                <p>Please select a payment method</p>
                <label>
                    Cash on Delivery<img src="cashondelivery.svg" class="payment-img">
                    <input type="radio" name="payment" value="payment1" onclick="payment1();" required/>
                </label>
                <label>
                    Credit Card<img src="creditcard.png" class="payment-img">
                    <input type="radio" name="payment" value="payment2" onclick="payment2();" required/>
                </label>
                <div id="payment1" class="hide">
                    <hr><p>Cash On Delivery</p>
                    <p>Please make the full cash payment when your order is arrived.</p>
                    <p>Thank you for your cooperation.</p>
                </div>
                <div id="payment2" class="hide">
                    <hr><p>Please select a credit card</p>
                    <label>
                        <img src="visa.svg" class="payment-img">
                        <input type="radio" name="card" value="visacard" onclick="visacard();" />
                    </label>
                    <label>
                        <img src="mastercard.svg" class="payment-img">
                        <input type="radio" name="card" value="mastercard" onclick="mastercard();" />
                    </label>
                </div>
                <div id="visacard" class="hide">
                    <center><h1><strong>Hyper Hasagi</strong></h1></center>
                    <label>Name on Card</label>
                    <input type="text" class="username-check" placeholder="Name card holder" name="visa" />
                    <label>Credit Card Number</label>
                    <input type="text" class="username-check" placeholder="0000-0000-0000-0000" name="visaNo" />

                    <label>Expiry Month</label>
                    <input type="text" class="exp-mon" placeholder="MM/YY" name="visaMon" />
                    <label class="form-right">CVV</label>
                    <input type="text" class="cvv" placeholder="352" name="visaCvv" />

                </div>
                <div id="mastercard" class="hide">

                    <center><h1><strong>Hyper Hasagi</strong></h1></center>
                    <label>Name on Card</label>
                    <input type="text" class="username-check" placeholder="Name card holder" name="master" />
                    <label>Credit Card Number</label>
                    <input type="text" class="username-check" placeholder="0000-0000-0000-0000" name="masterNo" />

                    <label>Expiry Month</label>
                    <input type="text" class="exp-mon" placeholder="MM/YY" name="masterMon" />
                    <label>CVV</label>
                    <input type="text" class="cvv" placeholder="352" name="masterCvv" />


                </div>



                <div class="checkout-btm">
                    <a href="shopping-cart.php" class="checkout-btn" id="return">Return to cart</a>
                    <input type="submit" value="Place Order" class="checkout-btn" id="ordernow" name="placeorder" onclick="return confirm('Are you sure you want to place order?');">
                </div>
            </form>
        </div>
        <?php
        include 'login.php';
        ?>
    </body>
    <script type="text/javascript" src="header.js"></script>

    <script>
                        function payment1() {
                            document.getElementById('payment1').style.display = 'block';
                            document.getElementById('payment2').style.display = 'none';
                            document.getElementById('mastercard').style.display = 'none';
                            document.getElementById('visacard').style.display = 'none';
                        }
                        function payment2() {
                            document.getElementById('payment1').style.display = 'none';
                            document.getElementById('payment2').style.display = 'block';
                        }
                        function visacard() {
                            document.getElementById('visacard').style.display = 'block';
                            document.getElementById('mastercard').style.display = 'none';
                        }
                        function mastercard() {
                            document.getElementById('visacard').style.display = 'none';
                            document.getElementById('mastercard').style.display = 'block';
                        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
    <script src="form-validate.js"></script>
</html>