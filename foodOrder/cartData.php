<?php
session_start();
include("connnection.php");
include("functions.php");
$user_id=$_SESSION['user_id'];
$sql = "SELECT * FROM CART WHERE USER_ID='$user_id'";
$cart = pg_query($con,$sql);

$quantot = 0;
$pricetot = 0;

while ($row = pg_fetch_assoc($cart)) {
    $quantity = $row["quantity"];
    $price = $row["price"];
    $itemtot = $quantity * $price;
    $quantot += $quantity;
    $pricetot += $itemtot;
}

$data = array(
    'total_item' => $quantot,
    'total_price' => $pricetot
);

header('Content-Type: application/json');
echo json_encode($data);
?>

