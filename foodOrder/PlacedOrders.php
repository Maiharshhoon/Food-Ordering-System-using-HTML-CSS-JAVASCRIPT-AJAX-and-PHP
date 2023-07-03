<?php

 session_start();
 include("connnection.php");
 include("functions.php");
 $admin_data = check_adminLogin($con); 
 $sql="SELECT * FROM orders";
  $orders = pg_query($con,$sql);
  $transaction_id=0;
?>


<!DOCTYPE html>
<html>

      <head>
            <title>Admin</title>
            <link rel="stylesheet" href="login.css">
            <style>
            .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 1500px; /* Add the max-width property */
    margin: 0 auto; /* Center the container horizontally */
}

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
.confirm {
  background-color: #ff6961; /* red */
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
.confirm:hover {
  background-color: #e74c3c; /* darker red on hover */
}
            </style>
            <script type="text/javascript">
            function confirmOrder(transaction_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "confirmOrder.php", true);
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
          
        </header><br><br><br><br>
        <div class="container">
             <p class="orderTitle">Placed Orders : </p>
                 <div class="yourOrders">
                      <?php
                                 while($row = pg_fetch_assoc($orders)){
                                      $transaction_id1 = $row['transaction_id'];
                                      if($transaction_id1 == $transaction_id)
                                      {
                                        continue;
                                      }
                                      $transaction_id=$transaction_id1;
                                      $sql1 = "SELECT * FROM ORDERS WHERE transaction_id='$transaction_id1'";
                                      $order1 = pg_query($con,$sql1);
                                      $date = $row['date'];
                                      echo '<div class="order">';
                                      echo '<p class="date">Order Date : '.$date.'</p>';
                                      echo '<p class="trans-id">Transaction ID : '.$transaction_id1.'</p>';
                                      $user_id=$row['user_id'];
                                      $sql2 = "SELECT * FROM USERS WHERE user_id='$user_id'";
                                      $userdata = pg_query($con,$sql2);
                                      while ($row3 = pg_fetch_assoc($userdata))
                                      {
                                             echo '<p class="date">Placed By : '.$row3['first_name'].' '.$row3['last_name'].'</p>';
                                             echo '<p class="date">Delivery Address : ' .$row3['address'].'</p>';
                                      }
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
                            <?php if ($row['status'] == 'pending') { echo '<button class="confirm" onclick="confirmOrder(' . $row["transaction_id"] . ')">Confirm Order</button>';} else if ($row['status'] == 'Cancelled'){echo '<p class="date">Order Cancelled</p>';}else if($row['status'] == 'Confirmed'){echo '<p class="date">Confirmed</p>';}?></td>
                            </tr></table>
                            <?php
                            echo '</div>';
                                }
                            ?>
                 </div>
               </div>
        </div>
    
  </body>
</html>

