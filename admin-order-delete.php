<?php

include_once './connection.php';

if ($_GET["order_id"]) {
    $orderID = $_GET["order_id"];

    $query = "DELETE FROM customer WHERE cust_id='$orderID';";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        $query2 = "DELETE FROM orders WHERE order_id='$orderID';";
        $query_run2 = mysqli_query($conn, $query2);

        if ($query_run2) {

            $query3 = "DELETE FROM card WHERE card_id='$orderID';";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run3) {
                echo '<script type="text/javascript"> alert("Order deleted") </script>';
                echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
            } else {
                echo '<script type="text/javascript"> alert("Order detail in card table not deleted!") </script>';
                echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Order in orders table not deleted!") </script>';
            echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
        }
    } else {
        echo '<script type="text/javascript"> alert("Order in customer table not deleted!") </script>';
        echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
    }
}