<!DOCTYPE html>
<style>

    td{
        overflow-x:auto;
    }

    table {

        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }



    table th,
    table td {
        border: 2px solid #00B2EE;
        padding: .625em;
        text-align: center;
    }


    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #00B2EE;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 3px solid #00B2EE;
            display: block;
            font-size: .8em;

        }

        table td::before {
            /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
            content: attr(data-label);
            float:left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }
</style>
<html>

    <head>

        <link rel="stylesheet" href="product.css">
        <link rel="icon" href="logo1.png" type="image/gif">
        <title>HH - Shop All</title>

    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <style>
            /* search */
            #search {
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

            #search:focus {
                width: 100%;
            }



        </style>

    <center>
        <div class="productnav" >
            <table>

                <h1 style="color:white">Categories</h1><br><br><br>

                

                <td> 
                    <a href="products-by-cat.php?category=T">
                        <h2>T shirts</h2>
                        <img src="tshirt1.jpg" alt="tshirt1" width="200"> 

                    </a>
                </td>

                <td>
                    <a href="products-by-cat.php?category=Ho">
                        <h2>Hoodies</h2>
                        <img src="hoodie1.jpg" alt="hoodie1"width="200">
                    </a>
                </td>


                <td>
                    <a href="products-by-cat.php?category=Ha">
                        <h2>Hats</h2>
                        <img src="hats5.jpg" alt="hats5" width="200">
                    </a>
                </td>


                <td>
                    <a href="products-by-cat.php?category=P">
                        <h2>Popular</h2>
                        <img src="popular1.jpg" alt="popular1"width="200">
                    </a>
                </td>





            </table>
        </div>
    </center>


</body>
</html>
<?php
include 'footer.php';
?>