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

        $orderID = $_GET["order_id"];
        $query = "SELECT * FROM customer WHERE cust_id='$orderID';";
        $query_run = mysqli_query($conn, $query);

        $query2 = "SELECT * FROM orders WHERE order_id='$orderID';";
        $query_run2 = mysqli_query($conn, $query2);

        $query3 = "SELECT * FROM card WHERE card_id='$orderID';";
        $query_run3 = mysqli_query($conn, $query3);

        $row = mysqli_fetch_assoc($query_run);
        $row2 = mysqli_fetch_assoc($query_run2);
        $row3 = mysqli_fetch_assoc($query_run3);
        ?>
        <div id="data">

            <table>
                <tr><td><h1 class="hl_style">View Orders</h1></td></tr>


                <tr>
                    <td class="table_Style">
                        <label>Order ID : </label>OD <?php echo $_GET['order_id']; ?>
                    </td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Order Date : </label><?php echo $row2['order_date']; ?>
                    </td>
                </tr>

                <tr>
                    <td class="table_Style">
                        <label>Customer Name : </label><?php echo $row['cust_name']; ?>
                    </td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Customer Email : </label><?php echo $row['cust_email']; ?>
                    </td>
                </tr>

                <tr>
                    <td class="table_Style">
                        <label>Customer Phone No : </label><?php echo $row['cust_contact_no']; ?>
                    </td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Customer Address : </label><?php echo $row['cust_address']; ?>
                    </td>
                </tr>

                <tr>
                    <td class="table_Style">
                        <label>Customer City : </label><?php echo $row['country']; ?>
                    </td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Customer Payment Method : </label><?php
                        echo $row['payment_type'];
                        if ($row3['card_type'] == "null") {
                            echo '';
                        } else {
                            echo '(' . $row3['card_type'] . ')';
                        }
                        ?>
                    </td>
                </tr>

                <?php
                if ($row3['card_name'] == "null") {
                    echo '';
                } else {
                    echo '<tr>
                    <td class="table_Style">
                        <label>Customer Card Name : </label>';
                    echo $row3['card_name'];
                }
                ?>
                <?php
                if ($row3['card_no'] == "null") {
                    echo '';
                } else {
                    echo '</td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Customer Card No : </label>';
                    echo $row3['card_no'];
                    echo '</td>
                </tr>';
                }
                ?>


                <?php
                if ($row3['card_exp'] == "null") {
                    echo '';
                } else {
                    echo '<tr>
                    <td class="table_Style">
                        <label>Customer Card Expiry : </label>';
                    echo $row3['card_exp'];
                }
                ?>
                <?php
                if ($row3['card_cvv'] == "0") {
                    echo '';
                } else {
                    echo '</td>
                    <td class="table_Style" style="border-left: 3px solid;">
                        <label>Customer Card Cvv : </label>';
                    echo $row3['card_cvv'];
                    echo '</td>
                </tr>';
                }
                ?>


                <tr>
                    <td class="table_Style">
                        <label> Order Status: </label><?php echo $row2['order_status']; ?>

                    </td>
                    <td class="table_Style" style="border-left: 3px solid;"></td>
                </tr>

                <tr><td><h1 class="hl_style">Products Ordered</h1></td></tr>

                <?php
                $sqlOrder = "SELECT * FROM details WHERE link_orders = '$orderID';";
                $sqlOrder_run = mysqli_query($conn, $sqlOrder);
                $resultCheck = mysqli_num_rows($sqlOrder_run);

                if ($resultCheck > 0) {
                    echo '<tr>
                        <th class="table_Style3">Image</th>
                        <th class="table_Style3">Name</th>
                        <th class="table_Style3">Size</th>
                        <th class="table_Style3">Price</th>
                        <th class="table_Style3">Quantity</th>
                        <th class="table_Style3">Total</th>
                    </tr>';
                    $total = 0;
                    $quantity = 0;
                    while ($rowOrder = mysqli_fetch_assoc($sqlOrder_run)) {
                        ?>
                        <tr>
                            <td class="table_Style2"><?php echo '<img src="data:image;base64,' . $rowOrder['details_image'] . '" style="width: 80px; height: 80px;" >'; ?></td>
                            <td class="table_Style2" style="word-break: break-word;"><?php echo $rowOrder['details_name']; ?></td>
                            <td class="table_Style2"><?php echo $rowOrder['details_size']; ?></td>
                            <td class="table_Style2"><?php echo $rowOrder['details_price']; ?></td>
                            <td class="table_Style2"><?php echo $rowOrder['details_quantity']; ?></td>
                            <td class="table_Style2"><?php echo number_format($rowOrder['details_quantity'] * $rowOrder['details_price'], 2); ?></td>
                        </tr>
                        <?php
                        $quantity += $rowOrder['details_quantity'];
                        $total += $rowOrder['details_quantity'] * $rowOrder['details_price'];
                    }
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>SubTotal :  </td>
                    <td>
                        <?php
                        echo $quantity;
                        ?> qty
                    </td>
                    <td>RM 
                        <?php
                        echo number_format($total, 2);
                        ?>
                    </td>
                </tr>
            </table>

        </div>

    </body>

</html>