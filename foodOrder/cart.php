<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 $user_id=$_SESSION['user_id'];
 $sql = "SELECT * FROM CART WHERE USER_ID='$user_id'";
 $cart = pg_query($con,$sql);

 $user_data = check_login($con);
 $quantot=0;
 $pricetot=0;
 

?>

<!DOCTYPE html>
<html>
      <head>
            <title>Online Food Ordering System</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="index1.css">
            <script>
            function cartRemove(cart_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "cartRemove.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      alert(this.responseText);
      // remove the row from the table
      var row = document.getElementById("row_" + cart_id);
      row.parentNode.removeChild(row);
      // update total item and total price
      updateCartData();
      // reload the page to update the cart contents
      location.reload();
    }
  };
  xhr.send("cart_id=" + cart_id);
}


function updateCartData() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "cartData.php", true);
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      var data = JSON.parse(this.responseText);
      document.getElementById("total-item").innerHTML = "Total Item: " + data.total_item;
      document.getElementById("total-price").innerHTML = "Total Price: &#x20B9;&nbsp;" + data.total_price;
      // update delivery charges
      var deliveryElement = document.getElementById("delivery");
      if (data.total_price >= 500) {
        deliveryElement.innerHTML = "Free Delivery above &#x20B9;500";
      } else if(data.total_price==0){
        deliveryElement.innerHTML = "Cart is Empty!";
      }else{
        deliveryElement.innerHTML = "Delivery Charges &#x20B9;50";
      }
    }
  };
  xhr.send();
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
                  <div class="add-box">
                     <i class="fa fa-map-marker your-address" id="add-address">&nbsp&nbsp<?php echo $user_data['address'];?></i>
                  </div>     
                  
                   <div id="cart-page" class="cart-toggle">
                   <?php if ($cart && pg_num_rows($cart)>0){?>
                        <p id="cart-title">Cart Items</p>
                        
                        <table>
                            <thead>
                                <td>Item</td>
                                <td>Name</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Remove</td>
                            </thead>
                            <?php
                                 while($row = pg_fetch_assoc($cart)){
                            ?>
                            <tbody id="table-body">
                              <tr id="row_<?php echo $row["cart_id"]; ?>">
                                   <td>
                                       <img src="<?php echo $row["product_image"];?>" alt="img">
                                   </td>
                                   <td><?php echo $row["product_name"];?></td>
                                   <td>
                                        <?php echo $row["quantity"];?>
                                   </td>
                                   <td><?php echo $row["quantity"];?>&nbspx&nbsp<?php echo $row["price"];?>&nbsp=&nbsp&#x20B9;&nbsp<?php $quantity=$row["quantity"]; $quantot+=$quantity;$price=$row["price"]; $itemtot=$quantity*$price; echo $itemtot; $pricetot+=$itemtot;?></td>
                                   <td><button class="remove-item" onclick="cartRemove('<?php echo $row["cart_id"]; ?>')">Remove</button></td>
                               </tr>
                               <?php
                                  }
                                ?>
                            </tbody>
                            
                        </table>
                        <?php }else{
                             echo '<span class="EmptyCart">The Cart is Empty!</span>';
                        } ?>
                   </div>
                   
               </div>
               
               <div id="checkout" class="cart-toggle">
    <p id="total-item">Total Item: <?php echo $quantot; ?></p>
    <?php
    if ($pricetot >= 500) {
        echo '<p id="total-price">Total Price: &#x20B9;&nbsp' . $pricetot . '</p>';
    } else if($pricetot==0){
        echo '<p id="total-price">Total Price: &#x20B9;&nbsp' . $pricetot . '</p>';
    }else{
        echo '<p id="total-price">Total Price: &#x20B9;&nbsp' . ($pricetot+=50) . '</p>';
    }
    ?>
    <?php
    if ($pricetot >= 500) {
        echo '<p id="delivery">Free Delivery above &#x20B9;500</p>';
    } else if($pricetot==0){
        echo '<p id="delivery">Cart is Empty!</p>';
    } else{
        echo '<p id="delivery">Delivery Charges &#x20B9;50</p>';
    }
    ?>
    <?php
    if($pricetot > 0)
    {
    $_SESSION['pricetot'] = $pricetot;
    echo '<a href="checkout.php" class="cart-btn">Checkout</a>';
     }
     ?>
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
                       <li><a href="contact.php">ContactUs</a></li>
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
