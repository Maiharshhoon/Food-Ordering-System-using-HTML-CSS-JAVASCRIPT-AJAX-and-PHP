<?php
session_start();
include("connnection.php");

$user_id = $_SESSION['user_id'];
$transaction_id = $_POST['transaction_id'];

// Get product name from menu table
$sql = "UPDATE orders SET status = 'Cancelled' WHERE user_id = '$user_id' AND transaction_id = '$transaction_id';";

if(pg_query($con, $sql))
{
  echo "Order Cancelled Successfully";
}
else
{
  echo "Error: " . pg_last_error($con);
}

?>

