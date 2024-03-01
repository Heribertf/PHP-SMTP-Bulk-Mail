<?php

// PayPal configuration 
define('PAYPAL_ID', 'sb-5nbtm29200606@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'https://c2aa-102-2-60-245.ngrok-free.app/stock-platform-v8/paypal-success.php');
define('PAYPAL_CANCEL_URL', 'https://c2aa-102-2-60-245.ngrok-free.app/stock-platform-v8/paypal-cancel.php');
define('PAYPAL_NOTIFY_URL', 'https://c2aa-102-2-60-245.ngrok-free.app/stock-platform-v8/ipn.php');
define('PAYPAL_CURRENCY', 'USD');

// Database configuration  
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bulk_email');

// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");