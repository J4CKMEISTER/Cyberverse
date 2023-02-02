<?php
include_once './connection.php';

if($_GET["product_num"]){
    $productID = $_GET["product_num"];
    $query = "DELETE FROM product WHERE product_num='$productID';";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run){
        echo '<script type="text/javascript"> alert("Product deleted") </script>';
        echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
    }
    else{
        echo '<script type="text/javascript"> alert("Product not deleted!") </script>';
        echo '<script type="text/javascript"> window.location.href = "admin.php"</script>';
    }
    
}
