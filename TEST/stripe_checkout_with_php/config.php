<?php

// Product Details  
// Minimum amount is $0.50 US  
$productName = "Codex Demo Product";
$productID = "DP12345";
$productPrice = 55;
$currency = "usd";

/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */
define('STRIPE_API_KEY', 'sk_test_51MhSJUGb8tSefwPi9Bq2mN4ywL4B6KfBkqO1XnJQ2HZ5b6UD9CDyDW068tPGPh74U8uSgvrQVO3NdAbjId8smyxN00wgHcPZBk');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51MhSJUGb8tSefwPiL0z1Lbr1FWKNvl6ZARjz6L2pef4ayObQO8QJk0pw3A2x83SG0blozgwSwIN3cVVB0L70Qkr6002DKqL2sB');
define('STRIPE_SUCCESS_URL', 'http://localhost/stripe_checkout_with_php/payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'http://localhost/stripe_checkout_with_php/payment-cancel.php'); //Payment cancel URL 

// Database configuration    
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test_transaction');
//Note that: Stripe API Secret key and Publishable key will be found in the API Keys Data section of your Stripe account.

//Database Connection (dbConnect.php)
//The dbConnect.php file is used to connect the database using PHP and MySQL.

?>


<?php
// Connect with the database   
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Display error if failed to connect   
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
?>