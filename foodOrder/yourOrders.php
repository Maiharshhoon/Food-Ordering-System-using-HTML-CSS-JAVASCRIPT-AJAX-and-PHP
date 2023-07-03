<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 $user_data = check_login($con);
  $user=$user_data['user_id'];
  $sql="SELECT * FROM orders WHERE user_id = '$user'";
  $orders = pg_query($con,$sql);
  $transaction_id=0;
?>

<!DOCTYPE html>
<html>
      <head>
            <title>Online Food Ordering System</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="index1.css">
            <style>
           
.orderTitle {
  color:indianred;
  font-family:'poppins',sans-serif;
  font-size: 35px;
  font-weight: bold;
  margin-bottom: 10px;
  text-align:center;
}

.yourOrders {
  
  display: flex;
  flex-wrap: wrap;
  align-items:center;
}

.order {
  width: 70%;
  padding: 10px;
  margin: 10px;
  margin-left:220px;
  border: 1px solid #ccc;
}

.date, .trans-id, .total {
  margin: 5px;
  font-family:'poppins',sans-serif;
  font-size:20px;
  
}

table {
  width: 100%;
  margin-bottom: 10px;
  border-collapse: collapse;
}

table td {
  font-family: 'poppins', sans-serif;
  font-size: 15px;
  border: 1px solid #ccc;
  line-height: 1.5; 
}

table td:first-child {
  width: 400px;;
}

table td:nth-child(2) {
  width: 100px;
}

table td:last-child {
  width: 300px;
  text-align: right;
}
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 10px;
}

table th, table td {
  border: 1px solid #ddd;
  padding: 8px;
}

table th {
  background-color: #f2f2f2;
}

table tr:nth-child(even) td {
  background-color: #f2f2f2;
}

table tr:hover td {
  background-color: #ddd;
}

table td.product-name {
  background-color: #e6f2ff;
}

table td.quantity {
  background-color: #f2e6ff;
}

table td.price {
  background-color: #e6ffe6;
}

table td.total {
  background-color: #fff2e6;
}
.cancel {
  background-color: #ff6961; /* red */
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
.cancel:hover {
  background-color: #e74c3c; /* darker red on hover */
}
</style>

            <script type="text/javascript">
            function cancelOrder(transaction_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "cancelOrder.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      alert(this.responseText);
      location.reload();
    }
  }
  xhr.send("transaction_id=" + transaction_id);
}

		</script>
      </head> 
      
      <body>
      <header>
           <div class="logo">
               <img src="foodash.png" alt="Logo">
           </div>
           <nav>
        <ul>
            <li><a href="home.php">Home&nbsp&nbsp</a></li>
            <li><a href="search.php">Search&nbsp<i class="fas fa-search"></i></a></li>
            <li><a href="cart.php">Cart&nbsp<i class="fas fa-shopping-cart"></i></a></li>
            <li><a href="contact.php">ContactUs</a></li>
        </ul>
    </nav>
           <a href="logout.php" class="logout-link">Logout</a>
        </header>
             
             
            
             <div id=container class="container">
                <div id="menu">
                       <div class="menu-item"><br><br><br><br>
                            <a href="profile.php">Profile</a>
                            <a href="yourOrders.php">Your Orders</a>
                       </div>
                </div>
                 <div id="food-container">
                 <p class="orderTitle">Your Orders : </p>
                 <div class="yourOrders">
                      <?php
                                 while($row = pg_fetch_assoc($orders)){
                                      $transaction_id1 = $row['transaction_id'];
                                      if($transaction_id1 == $transaction_id)
                                      {
                                        continue;
                                      }
                                      $transaction_id=$transaction_id1;
                                      $sql1 = "SELECT * FROM ORDERS WHERE user_id='$user' AND transaction_id='$transaction_id1'";
                                      $order1 = pg_query($con,$sql1);
                                      $date = $row['date'];
                                      echo '<div class="order">';
                                      echo '<p class="date">Order Date : '.$date.'</p>';
                                      echo '<p class="trans-id">Transaction ID : '.$transaction_id1.'</p>';
                                      $pricetot = 0;
                                      while ($row1 = pg_fetch_assoc($order1)){
                            ?>
                                      <table>
                                           <tr>
                                              <td class="product-name"><?php echo $row1['product_name']; ?></td>
                                              <td class="quantity"><?php echo $row1['quantity']; ?></td>
                                               <td class="price"><?php echo $row1["quantity"];?>&nbspx&nbsp<?php echo $row1["price"];?>&nbsp=&nbsp&#x20B9;&nbsp<?php $quantity=$row1["quantity"];$price=$row1["price"]; $itemtot=$quantity*$price; echo $itemtot; $pricetot+=$itemtot;?></td>
                                           </tr>
                                      </table>          
                            
                            <?php
                               }
                            ?>
                            <table>
                            <tr><td>
                            <p class = "total">Total Amount : &#x20B9;<?php if($pricetot>=500){echo $pricetot;}else{echo $pricetot+50;} ?></p></td>
                            <td>
                            <?php if ($row['status'] == 'pending') { echo '<button class="cancel" onclick="cancelOrder(' . $row["transaction_id"] . ')">Cancel Order</button>';} else if ($row['status'] == 'Cancelled'){echo '<p class="date">Order Cancelled</p>';}else if($row['status'] == 'confirmed'){echo '<p class="date">Confirmed</p>';}?></td>
                            </tr></table>
                            <?php
                            echo '</div>';
                                }
                            ?>
                 </div>
               </div>
               
             </div>
             <footer>
                  <div class="footerContainer">
                     <img src="foodash.png" alt="Logo">
                 <div class="socialIcons">
                     <a href=""><i class="fab fa-facebook"></i></a>
                     <a href=""><i class="fab fa-instagram"></i></a>
                     <a href=""><i class="fab fa-twitter"></i></a>
                     <a href=""><i class="fab fa-google-plus"></i></a>
                     <a href=""><i class="fab fa-youtube"></i></a>
                 </div>
                 <div class="footerNav">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                       <li><a href="">Hello</a></li>
                       <li><a href="">About</a></li>
                       <li><a href="">ContactUs</a></li>
                       <li><a href="">Our Team</a></li>
                    </ul>
                  </div>
                  
             </div>
             <div class="footerBottom">
                       <p>Copyright &copy;2023; Designed by <span class="designer">Group10</span></p>
                  </div>
             </footer>
      </body>
</html>
