<!DOCTYPE html>
<style>

    input[type=text],input[type=email],textarea{
        -webkit-text-stroke: 0.1px black;
        color:white;
        font-size:100%;
    }
    /* styling paper */
    #paper {
        width: 60%;
        height: auto;
        position: relative;
        margin: 20px auto;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: white;
        box-shadow: 0px 0px 5px 0px #888;
    }

    /* styling blue vertical line */
    #paper::before {
        content: '';
        width: 2px;
        height: 100%;
        position: absolute;
        top: 0;
        left: 40px;
        background-color: rgba(0, 128, 128, 0.6);
    }
    /* styling blue horizontal lines */
    #pattern {
        height: 100%;
        background-image: repeating-linear-gradient(white 0px, white 24px, teal 25px);
    }

    /* styling text content */
    #content {
        padding-top: 6px;
        padding-left: 56px;
        padding-right: 16px;
        line-height: 25px;
        font-family: 'Dancing Script', cursive;
        font-size: 19px;
        letter-spacing: 1px;
        word-spacing: 5px;
    }
    #formcontent
    {
        background-image:url("wed.PNG");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        overflow:hidden;



    }
    #namebox, #addressbox, #emailbox, #phonebox, #subject , #message
    {   
        width: 700px;
        height:50px;
        border-style: solid;
        background: transparent;
        border-color:white;



    }
    ::placeholder{
        color:white;
    }
    #formh1{

        font-weight:normal;
        color:white;
        text-shadow:
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;


    }
    input[type="submit"]{   
        padding: 12px 20px;
        border: none;
    }


    /* Floating column for inputs: 75% width */
    .col-75  {
        color:white;
        background-color: #66FF0000;
        width: 100%;
        margin-top: 6px;

    }



    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
        .col-75 , button[type=submit]{
            width: 100%;
            margin-top: 0;

        }
        button[type=submit]{
            text-align:justify;
        }


    }
    #submitbox{
        cursor: pointer;
    }

    .error {


        color: #F00;
        background-color: #FFF;
        font-weight: bold;



    }

    .button {
        background-color: #42C0FB;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .button:hover{
        background-color: #00A0C6;
    }


</style>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="icon" href="latest.png" type="image/x-icon">

        <title>Cyberverse - Help Center</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
        <script src="form-validate.js"></script>

        <?php
        if (isset($_POST['submitFeedback'])) {

            require 'PHPMailerAutoload.php';
            $EMAIL = "hyperhasagi@gmail.com";
            $PASS = "hyperhasagi2001";
            $receiver = "hyperhasagi9@gmail.com";


            $mail = new PHPMailer; //create object of mailer

            $mail->SMTPDebug = 0;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $EMAIL;                 // SMTP username
            $mail->Password = $PASS;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom($EMAIL, 'Hyper Hasagi Online Store');
            $mail->addAddress($receiver); // Add a recipient

            $mail->addReplyTo($EMAIL);

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Customer Feedback';
            $mail->Body = "Customer Name : " . $_POST['name'] . "<br><br>Customer Address : " . $_POST['address'] .
                    "<br><br>Customer phone number : " . $_POST['phoneNum'] . "<br><br>Customer Email : " . $_POST['email']
                    . "<br><br>Subject : " . $_POST['subject'] . "<br><br>Message : " . $_POST['message'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo"<script>alert('ERROR OCCUR when trying to send ! Are you sure " . $_POST['emailPass'] . " is your email ?? ')</script>";
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo"<script>alert('The feedback is successfully sent to us ! we will read it  soon !')</script>";
            }
        }
        ?>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
    <center>
        
        <div id="paper">
            <div id="pattern">
                <div id="content">
                    <b>Frequently Asked Questions</b> <br><br>
                    <u>How much is shipping?</u><br><br>
                    Once you’ve clicked through to Secure Checkout, you can enter your delivery address and choose a shipping method. Shipping costs are then calculated and tacked on to your subtotal at the bottom of the page. 
                    <br><br><u>Can I track my order?</u><br><br>
                    We rely on a global network of shipping services (UPS, FedEx, DHL) as well as local postal services (USPS) to get your order to your doorstep as soon as possible. For this reason, tracking is not always available. If your order is being sent by a trackable service, these details will be included on your orders page as well as on the shipping email we send you. 
                    <br><br><u>Do you deliver to APO, FPO and DPO addresses?</u><br><br>
                    Yes; however, due to the nature of these services, it may take more than 45 business days to receive your order. If possible, we recommend using a civilian address. 

                    <br><br><u>Where does my order ship from?</u><br><br>
                    Each of the 3rd party printers in our global network manufactures specific products and services particular parts of the world. We ensure your goodies will be printed in the most convenient location for your delivery address, ensuring fast and affordable shipping services! 
                </div>
            </div>
        </div>
    </center>

    <div id="formcontent">
        <center>
            <br>
            <h1 id="formh1">GIVE US YOUR FEEDBACK</h1>

            <form method="POST" id="feedbackForm">
                <table>
                    <tr>
                    <tr>
                        <td>
                            <div class="col-75">
                                <input name="name" type="text" id="namebox" placeholder="Name*" required />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>    <div class="col-75">
                                <input name="address" type="text" id="addressbox" placeholder="Address"  />
                            </div>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <div class="col-75">
                                <input type="email" name="email"id="emailbox" placeholder="Email*" required />
                            </div>
                            <div class="col-75">
                                <input type="text" name="phoneNum" id="phonebox" placeholder="Phone number"   />
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <div class="col-75">
                                <input type="text" name="subject" id="subject" placeholder="Subject"/>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="col-75">
                                <input type="text" name="message"id="message"placeholder="Enter message here*" required  />
                            </div>
                        </td>
                    </tr>
                    <tr><td>
                    <center><input type="submit" name="submitFeedback" class="button" id="submitbox" value="Submit" ></center>
                </td>                  
                    </tr>

                    </tr>
                </table>


            </form>
        </center>
        <br>
    </div>

</body>

</html>
<?php include 'footer.php'; ?>
