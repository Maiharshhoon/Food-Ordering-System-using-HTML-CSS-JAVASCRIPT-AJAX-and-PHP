<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 $pricetot  = $_SESSION['pricetot'];

 $user_data = check_login($con);
  $address = $user_data['address'];
  $user=$user_data['user_id'];
?>

<!DOCTYPE html>
<html>
      <head>
            <title>Online Food Ordering System</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="index1.css">
            <link rel="stylesheet" href="checkout.css">
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
                 
                  <p id="payment-page">PAYMENT</p>   
                  <div>
                      
	<form method="post">
  <div>
     <label for="payment-amount">Payment Amount : <?php echo $pricetot; ?></label>
    <br>
    <br>
  </div>
  
  <div>
    <label for="payment-method">Payment Method : </label>
    <br>
    <select id="payment-method" class="payment-method" name="payment_method" required>
      <option value="">Select Payment Method</option>
      <option value="credit_card">Credit Card</option>
      <option value="debit_card">Debit Card</option>
      <option value="cash_on_delivery">Cash on Delivery</option>
    </select>
  </div>
  <br>
  <br>
  <div id="card-details" class="card-details">
    <div>
      <label for="card-number">Card Number:</label>
      <br>
      <input type="text" id="card-number" class="card-number" name="card_number" placeholder="Enter card number">
    </div>
    <br>
  <br>
    <div>
      <label for="card-expiry">Expiration Date:</label>
      <br>
      <input type="text" id="card-expiry" class="card-expiry" name="card_expiry" placeholder="MM/YY">
    </div>
    <br>
  <br>
    <div>
      <label for="card-cvv">CVV:</label>
      <br>
      <input type="text" id="card-cvv" class="card-cvv" name="card_cvv" placeholder="Enter CVV">
    </div>
  </div>
  <div id="error-message">
  <?php
// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
   // get the payment method from the form
   $payment_method = $_POST['payment_method'];
  
   // validate the card details if the payment method is credit_card or debit_card
   if ($payment_method === 'credit_card' || $payment_method === 'debit_card') {
    
      // get the card details from the form
      $card_number = $_POST['card_number'];
      $card_expiry = $_POST['card_expiry'];
      $card_cvv = $_POST['card_cvv'];
    
      // validate the card number
      if (!preg_match('/^[0-9]{16}$/', $card_number)) {
         $errors[] = "Invalid card number";
      }
    
      // validate the card expiry
      if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $card_expiry)) {
         $errors[] = "Invalid expiry date";
      }
    
      // validate the card cvv
      if (!preg_match('/^[0-9]{3}$/', $card_cvv)) {
         $errors[] = "Invalid CVV";
      }
    
      // display any errors
      if (!empty($errors)) {
         echo '<ul>';
         foreach ($errors as $error) {
                 echo '<li class="error1">' . $error . '</li>';
         }
         echo '</ul>';


      } 
      else {
              // card details are valid, process the payment
              $transaction_id = transaction_id(5); 
              $_SESSION['transaction_id']=$transaction_id;
              $sql = "select * from cart";
              $cart = pg_query($con,$sql);
              while ($row = pg_fetch_assoc($cart)){
         	   $user_id = $row['user_id'];
         	   $product_name = $row['product_name'];
          	  $quantity = $row['quantity'];
           	 $price = $row['price'];
           
               $query = "INSERT INTO orders (user_id, transaction_id, product_name, quantity, price, address,status)
          VALUES ('$user_id', '$transaction_id', '$product_name', '$quantity', '$price', '$address','pending');";
            $result1=pg_query($con, $query);
      }
      $delete = "DELETE FROM cart WHERE user_id = '$user'";
      pg_query($con,$delete);
      header("Location: cardSuccess.php");
    }
    
  } elseif($payment_method === 'cash_on_delivery'){
    // card details are valid, process the payment
      $transaction_id = transaction_id(5); 
      $_SESSION['transaction_id']=$transaction_id;
      $sql = "select * from cart";
      $cart = pg_query($con,$sql);
      while ($row = pg_fetch_assoc($cart)){
            $user_id = $row['user_id'];
            $product_name = $row['product_name'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            
               $query = "INSERT INTO orders (user_id, transaction_id, product_name, quantity, price, address,status)VALUES ('$user_id', '$transaction_id', '$product_name', '$quantity', '$price', '$address','pending');";
            $result1=pg_query($con, $query);
      }
      $delete = "DELETE FROM cart WHERE user_id = '$user'";
      pg_query($con,$delete);
      
      header("Location: paySuccess.php");
  }
  
}
?>
</div>
  <div>
    <input type="submit" name="submit" value="Place Order">
  </div>
</form>


<script>
  // Get the card details div
  var cardDetails = document.getElementById("card-details");
  
  // Add an event listener to the payment method select menu
  document.getElementById("payment-method").addEventListener("change", function() {
    // Check if cash on delivery is selected
    if (this.value === "cash_on_delivery") {
      // Hide the card details div
      cardDetails.style.display = "none";
    } else {
      // Show the card details div
      cardDetails.style.display = "block";
    }
  });
</script>


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
