<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connnection.php");


$cart_id = $_POST['cart_id'];

// Get product name from menu table
$sql = "DELETE FROM CART WHERE cart_id = '$cart_id'";

if(pg_query($con, $sql))
{
  echo "Item Removed from the cart";
 
}
else
{
  echo "Error: " . pg_last_error($con);
}

?>

