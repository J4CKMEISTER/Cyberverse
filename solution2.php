<?php

$target = trim($_REQUEST[ 'ip' ]);

// Set blacklist
$substitutions = array(
    '&'  => '',
    ';'  => '',
    '| ' => '',
    '-'  => '',
    '$'  => '',
    '('  => '',
    ')'  => '',
    '`'  => '',
    '||' => '',
);

// Remove any of the charactars in the array (blacklist).
$target = str_replace( array_keys( $substitutions ), $substitutions, $target );


  // Split the IP into 4 octects
$octet = explode( ".", $target );

// Check IF each octet is an integer
if( ( is_numeric( $octet[0] ) ) && ( is_numeric( $octet[1] ) ) && ( is_numeric( $octet[2] ) ) 
&& ( is_numeric( $octet[3] ) ) && ( sizeof( $octet ) == 4 ) ) {
    // If all 4 octets are int's put the IP back together.
    $target = $octet[0] . '.' . $octet[1] . '.' . $octet[2] . '.' . $octet[3];
}

?>

<?php

//Limit one result
$sql = "SELECT product_num,image,product_name,price FROM product WHERE
 product_name LIKE '%$search%' OR prod_description LIKE '%$search%' OR 
 price LIKE '%$search%' OR category LIKE '%$search%' LIMIT 1;";


// Remove any special character
$search = mysqli_real_escape_string($POST["search"], $id); 




// Stop html tag from executing by converting them back to code
$description = htmlspecialchars( $_POST[ 'description' ] ); 

//Replace input that contain <script> with empty space
$description  = str_replace( '<script>', '', $_POST[ 'description' ] ); 



//Check if accesing page user is admin
if (!isset($_SESSION['admin_login'])) {
     echo"<script>alert('Unauthroized person cannot access this page ! D:< !')</script>";
     echo"<script>window.open('home.php','_self')</script>";
}



$link = "http://www.example.com/?id=".urlencode(base64_encode($_SESSION['email']));





?>