<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<style>

    .style-h2 { font-weight:normal; }
    .style-a{

        padding-right: 30px;
        padding-left: 30px;
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
        <?php
        $category = $_GET["category"];

        if ($category === "T") {
            echo '<title>HH - T-shirts</title>';
        } else if ($category === "Ho") {
            echo '<title>HH - Hoodies</title>';
        } else if ($category === "Ha") {
            echo '<title>HH - Hats</title>';
        } else if ($category === "P") {
            echo '<title>HH - Popular</title>';
        }
        ?>


    </head>
    <body>
        <?php
        include 'header.php';
        ?>
    <center>
        <?php
        $category = $_GET["category"];

        if ($category === "T") {
            echo '<h1 style="color:white">T-shirts</h1>';
        } else if ($category === "Ho") {
            echo '<h1  style="color:white">Hoodies</h1>';
        } else if ($category === "Ha") {
            echo '<h1  style="color:white">Hats</h1>';
        } else if ($category === "P") {
            echo '<h1  style="color:white">Popular</h1>';
        }
        
        ?>



        <br><br><br>
        
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


                    $category = $_GET["category"];

                    $query = "SELECT * FROM product WHERE category = '$category';";
                    $query_run = mysqli_query($conn, $query);
                    $resultCheck = mysqli_num_rows($query_run);

                    if ($resultCheck > 0) {
                       
                        while ($row = mysqli_fetch_assoc($query_run)) {
                           # if ($row['product_num'] == 0){

                            #}
                            ?>
                           


                            <div class="column">
                                <a style="color:black" href="product-details.php?product_num=<?php echo $row['product_num']; ?>">
                                    <?php echo '<img src="data:image;base64,' . base64_encode($row['image']) . '" style="width: 200px; height: 220px;" >'; ?>

                                    <h2 class="style-h2"  style="word-break: break-word;color:white;"><?php echo $row['product_name']; ?><br></h2>
                                    <h3 style="color:white";>RM <?php echo $row['price']; ?></h3>

                                </a>
                            </div>






                            <?php
                        }
                    } else {
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
                        █░▀█ █▄█   █▀▄ ██▄ ▄█ █▄█ █▄▄ ░█░ ▄█   █▀░ █▄█ █▄█ █░▀█ █▄▀<br></h3>';;
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