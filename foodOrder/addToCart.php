<?php
session_start();
include("connnection.php");

$user_id = $_SESSION['user_id'];
$menu_id = $_POST['menu_id'];
$quantity = $_POST['quantity'];

// Get product name from menu table
$sql = "SELECT product_name, product_image,price FROM menu WHERE menu_id = $menu_id";
$result = pg_query($con, $sql);
$row = pg_fetch_assoc($result);
$product_name = $row['product_name'];
$product_image = $row['product_image'];
$price = $row['price'];

$sql = "INSERT INTO cart (user_id, menu_id, product_name, quantity,price,product_image) VALUES ($user_id, $menu_id, '$product_name', $quantity,'$price','$product_image')";
if(pg_query($con, $sql))
{
  echo "Item added to cart!";
}
else
{
  echo "Error: " . pg_last_error($con);
}

?>

