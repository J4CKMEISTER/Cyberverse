<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<style>

    .style-h2 { font-weight:normal; color:white;}
    .style-a{

        padding-right: 30px;
        padding-left: 30px;
    }
    /* search */
    .search {
        width: 130px;
        box-sizing: border-box;
        border: 2px solid #3498DB;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('searchicon.png');
        background-position: 10px 10px; 
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    .search:focus {
        width: 100%;
    }



    @media screen and (max-width: 600px) {
        .row{
            overflow: hidden;
        }
        .column, .row{
            float: none;
        }
    }


    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        border: 2px solid #00B2EE;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<html>
    <head>
        <link rel="stylesheet" href="product.css">
        <meta charset="UTF-8">
        <link rel="icon" href="latest.png" type="image/x-icon">
        <title>Cyberverse - Search</title>


    </head>
    <body>
<?php
include 'header.php';
?>
    <center>

        <br><br><br><br><br><br>
        <form method="post">
            <input type="text" id="search" name="search" class="search" placeholder="Search.."><br>
        </form><br>
        <div class="productnav">
            <table>
                <tr>
                <h2 class="style-h2">          Categories :
                    <a class="style-a" href="products-by-cat.php?category=T">T-shirts</a>
                    <a class="style-a" href="products-by-cat.php?category=Ho">Hoodies</a>
                    <a class="style-a" href="products-by-cat.php?category=Ha">Hats</a>
                    <a class="style-a" href="products-by-cat.php?category=P">Popular</a>
                </h2>
                </tr>
                <div class="row">
<?php
include_once './connection.php';

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    //$search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT product_num,image,product_name,price FROM product WHERE product_name LIKE '%$search%' OR prod_description LIKE '%$search%' OR price LIKE '%$search%' OR category LIKE '%$search%';";

    //$sql = "SELECT * FROM product WHERE product_name LIKE '%$search%' OR prod_description LIKE '%$search%' OR price LIKE '%$search%' OR category LIKE '%$search%';";
    $result = mysqli_query($conn, $sql);
    $searchResult = mysqli_num_rows($result);
    
    if($searchResult > 0){
        while ($row = mysqli_fetch_assoc($result)){
            ?>
                    
                    <div class="column">
                                <a style="color:white" href="product-details.php?product_num=<?php echo $row['product_num']; ?>">
                            <?php echo '<img src="data:image;base64,' . base64_encode($row['image']) . '" style="width: 200px; height: 220px;" >'; ?>

                                    <h2 class="style-h2"  style="word-break: break-word;"><?php echo $row['product_name']; ?><br></h2>
                                    <h3>RM <?php echo $row['price']; ?></h3>

                                </a>
                            </div>
                    
                    <?php
        }
    }else{
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
}
    
 else {
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
                </div>

            </table>

    </center>
</div>

</body>
</html>
<?php
include 'footer.php';
?>