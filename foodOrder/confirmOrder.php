<?php
session_start();
include("connnection.php");

$transaction_id = $_POST['transaction_id'];

// Get product name from menu table
$sql = "UPDATE orders SET status = 'Confirmed' WHERE transaction_id = '$transaction_id';";

if(pg_query($con, $sql))
{
  echo "Order Confirmed Successfully";
}
else
{
  echo "Error: " . pg_last_error($con);
}

?>

