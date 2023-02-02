<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cyberverse - Home</title>
        <link rel="icon" href="latest.png" type="image/x-icon">
        <link rel="stylesheet" href="home.css">


    </head>
    <body>
        <?php
        include 'header.php';
        
        if(isset($_GET['sname']) && isset($_GET['spass'])){
            echo"<script>alert('Your Shopee credentials have been stolen ! :\\nUsername : ".$_GET['sname']."\\nPassword : ".$_GET['spass']."\\ncyberv{think_before_click}')</script>";
        }
        ?>

        <div class="container-home"><img src="710535.jpg" class="main-img">
            <span class="text1 centered span-control">Cyberverse</span>
            <span class="text2 centered span-control">Into the Space of Vulns</span>
        </div>
        <div class="border">
            <div>
                <h1>Welcome to the space of Cyberverse</h1>
                <p class="styletext">We are not just a fashion store, we are also a brand, responsible for the unique and compelling style that is unique to us. We do not simply sell clothes, we design clothes, and are therefore well placed to bring our product to market. Our business is based on the concept of ‘the way we want to be seen’, and we are well positioned to take advantage of the growing trend of fashion being seen in the digital era.</p>
                <p class="styletext">Love watching Anime? Thinking of becoming a weeb? Want to buy some new outfits? Tired of washing clothes?</p>
                <p class="styletext">We got what you need !</p>
                <center><a href="about-us.php" class="button">About Us</a></center>
            </div>
        </div>

        <div class="timer">
            <img src="timer.jpg">
            <p id="timer"></p>
        </div>
        <br/>
        <br/>
<center>
<div class="container"><a href="https://stopify.co/login.php?id=TEZSWB.login">
  <img src="shopeeblackpink.png" alt="spbp">
  <button class="btn">BUY NOW</button>
</a>
</div>

</center>
    <div class="slideshow-container">

        <div class="mySlides fade">

            <a href="products-by-cat.php?category=T"><img src="tshirtcat.jpg" style="width:100%"></a>
            
        </div>

        <div class="mySlides fade">

            <a href="products-by-cat.php?category=Ho"><img src="hoodiecat.jpg" style="width:100%"></a>
            
        </div>

        <div class="mySlides fade">

            <a href="products-by-cat.php?category=Ha"><img src="hatscat.jpg" style="width:100%"></a>
            
        </div>
        <div class="mySlides fade">

            <a href="products-by-cat.php?category=P"><img src="popularcat.png" style="width:100%"></a>
            
        </div>

        <a class="prev" onclick="plusSlides(-1)"><img src="leftButton.png"></a>
        <a class="next" onclick="plusSlides(1)"><img src="rightButton.png"></a>

    </div>
    <br>

    <div style="text-align:center; padding-bottom: 50px;">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>
<script type="text/javascript" src="home.js"></script>
<div style="opacity: 0.0;">
Dear Jack ,
 Rememember to reauthenticate admin access on /admin page after you finish configuring ! 
 cyberv{remember_to_check_source_code}</div>
</html>