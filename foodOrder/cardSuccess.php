<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 $transaction_id=$_SESSION['transaction_id'];
 $user_data = check_login($con);
 $pricetot  = $_SESSION['pricetot'];
  $address = $user_data['address'];
  $user=$user_data['user_id'];
  $sql="SELECT * FROM orders WHERE user_id = '$user' AND transaction_id = '$transaction_id';";
  $cart = pg_query($con,$sql);
?>

<!DOCTYPE html>
<html>
      <head>
            <title>Online Food Ordering System</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="paySuccess.css">
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="index1.css">
            <script type="text/javascript">
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
            <li><a href="cart.php">Cart&nbsp<i class="fas fa-shopping-cart"></i></li>
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
                 <p class="payment-method">Payment Method : Through Card</p>
                 <div class="receipt">
                 <p class="payment-page">RECEIPT</p>
                 <p class="tras-id">Transaction ID : <?php echo $transaction_id; ?></p>
                      <table>
                            <thead>
                                <td>Name</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </thead>
                            <?php
                                 while($row = pg_fetch_assoc($cart)){
                            ?>
                            <tbody id="table-body">
                              <tr>
                                   <td><?php echo $row["product_name"];?></td>
                                   <td>
                                        <?php echo $row["quantity"];?>
                                   </td>
                                   <td>&#x20B9;&nbsp<?php $quantity=$row["quantity"];$price=$row["price"]; $itemtot=$quantity*$price; echo $itemtot;?></td>
                                   
                               </tr>
                               <?php
                                  }
                                ?>
                                
                            </tbody>
                            <table>
                                <?php if ($pricetot>=500){echo '<tr>
                                   <td class="deliv">Free Delivery</td>
                                <tr>';}else{echo '<tr>
                                   <td class="deliv">Delivery Charges : &#x20B9;50</td>
                                <tr>';} ?>
                                <tr>
                                <td>TOTAL AMOUNT PAID : &nbsp&#x20B9;&nbsp<?php echo $pricetot; ?></td>
                                  
                                </tr>
                                
                                <tr>
                                      <td>DELIVERY ADDRESS : <?php echo $address; ?></td>
                                </tr>
                            </table>
                            
                        </table>
                 </div>
                 


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
