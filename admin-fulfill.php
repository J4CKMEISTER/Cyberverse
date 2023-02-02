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

        if (isset($_POST['adminUpdate'])) {
            $newStatus = ($_POST['newStatus']);
            
            $update = "UPDATE orders SET order_status ='$newStatus' WHERE order_id='$orderID';";
            $update_run = mysqli_query($conn, $update);

            if ($update_run) {
                echo '<script type="text/javascript"> alert("Order status updated to database")</script>';
                echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
            } else {
                echo '<script type="text/javascript"> alert("Failed! WHAT AM I GONNA DO?!") </script>';
            }
        }
        ?>
        <div id="data">

            <form method="post" enctype="multipart/form-data" id="feedbackForm">

                <table>
                    <tr><td><h1 class="hl_style">Fulfill Orders</h1></td></tr>


                    <tr>
                        <td class="table_Style">
                            <label>Order ID : </label>OD <?php echo $_GET['order_id']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Order Date : </label><?php echo $row2['order_date']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer Name : </label><?php echo $row['cust_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer Email : </label><?php echo $row['cust_email']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer Phone No : </label><?php echo $row['cust_contact_no']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer Address : </label><?php echo $row['cust_address']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer City : </label><?php echo $row['country']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>Customer Payment Method : </label><?php
                            echo $row['payment_type'] . ' (';
                            echo $row3['card_type'] . ')';
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="table_Style">
                            <label>New Order Status: </label>
                            <?php
                            $status = array("Pa" => "Paid",
                                "Pe" => "Pending");
                            ?>
                            <select name="newStatus">
                                <?php
                                foreach ($status as $key => $value) {
                                    echo"<option name='newStatus' value='$value'";
                                    if ($row2['order_status'] == $value) {
                                        echo'selected = "selected" />';
                                    }
                                    echo '<span>' . $value . '</span>';
                                }
                                ?>
                            </select>  
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
