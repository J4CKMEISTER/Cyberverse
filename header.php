<?php @session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="login.css">

    </head>
    <body>
        <div class="navbar">

            <div class="brand-title"><a href="home.php"><img src="latest.png" width="100" height="100" class="nav-icon"></a></div>
        
            <a href="#" class="toggle-button">
                <span><img src="menu.svg" width="50" height="50"></span>
            </a>
            <div class="navbar-links">
                <ul>
                    <li><a href="solution.php" class="poi">Solution</a></li>
                    <li><a href="localhost:4000" class="poi">Challenges</a></li>
                    <li><a href="home.php" class="poi">Home</a></li>
                    <li>
                        <a href="" class="poi">Shop</a>
                        <ul class="dropdown">
                            <li><a href="shopAll.php">Shop All</a></li>
                            <li><a href="search.php">Search</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="" class="poi">Company</a>
                        <ul class="dropdown">
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="helpcenter.php">Help Center</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="" class="poi">Social</a>
                        <ul class="dropdown">
                            <li><a href="https://www.facebook.com/Per-Hy-210395823749057/?ref=search&__tn__=%2Cd%2CP-R&eid=ARCGFT6xm8_-oOMbNW8XbJYpD2_zgvc6uiOVqzttTm7maTQYm_q_7wAIZEbuycG1BDMMNcYFLP-II0Dq"  target="_blank"><img src="fb.svg" width="50" height="50"></a></li>
                            <li><a href="https://twitter.com/HasagiHyper"  target="_blank"><img src="twitter.svg" width="50" height="50"></a></li>
                            <li><a href="https://instagram.com/hyperhasagi?igshid=7o8z997e8hpy"  target="_blank"><img src="rsz_11insta.png" width="68" height="68"></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="" class="poi">Account</a>
                        <ul class="dropdown">
                            
                           
                            <?php if (isset($_SESSION['admin_login']) || isset($_SESSION['login_user'])) { ?>
                                <li><a href="logout.php">Log Out</a></li>
                                <li><a href="profile.php?email=<?php echo $_SESSION['session_email']?>">Profile</a></li>
                            <?php } else{?>
                                
                             <li><a onclick="document.getElementById('id01').style.display = 'block'" style="cursor: pointer">Login</a></li>
                            <li><a onclick="document.getElementById('id02').style.display = 'block'" style="cursor: pointer">Register</a></li>
                                <?php }?>
                        </ul>
                    </li>
                    <li>
                         <?php if (isset($_SESSION['admin_login'])) { ?>
                        <a href="admin.php" class="poi">Admin</a>
                        <?php }?>
                    </li>
                    <li><a href="#" class="poi">GAME</a></li>
                    <li>
                        <a href="shopping-cart.php"><img src="shopping-cart-64.png" class="poi" width="30" height="auto"  style="margin-left: -10px;position: absolute;"></a>
                    </li>
                </ul>
            </div>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <?php
        include 'login.php';
        include 'register.php';
        ?>
    </body>
    <script type="text/javascript" src="header.js"></script>
</html>