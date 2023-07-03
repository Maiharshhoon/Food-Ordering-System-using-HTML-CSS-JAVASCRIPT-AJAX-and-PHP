<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");

if (isset($_GET['search-btn']) && !empty($_GET['search-bar'])) {
   $search_query = $_GET['search-bar'];
   $sql1 = "SELECT * FROM MENU WHERE (product_name ILIKE '%$search_query%')";
   $search_result = pg_query($con,$sql1);
$norows = pg_num_rows($search_result);
} else {
   $norows = 0;
}

  $user_data = check_login($con);
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
  function incrementQuantity(cardId) {
  var inputField = document.querySelector('[data-id="' + cardId + '"]');
  var currentValue = parseInt(inputField.value);
  if (currentValue < 99) {
    inputField.value = currentValue + 1;
  }
}

function decrementQuantity(cardId) {
  var inputField = document.querySelector('[data-id="' + cardId + '"]');
  var currentValue = parseInt(inputField.value);
  if (currentValue > 0) {
    inputField.value = currentValue - 1;
  }
}

function addToCart(menu_id, quantity) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "addToCart.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      alert(this.responseText);
    }
  }
  xhr.send("menu_id=" + menu_id + "&quantity=" + quantity);
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
                 <div id="search-container">
  <form action="#" method="GET">
    <input type="text" id="search-bar" name="search-bar" placeholder="Search..." value="<?php echo isset($_GET['search-bar']) ? $_GET['search-bar'] : ''; ?>">
    <button type="submit" id="search-btn" name="search-btn"><i class="fas fa-search"></i></button>
  </form>
</div>

                  
                  <?php if ($norows>0){?>
             <p id="category-name">Search Results : <?php echo isset($_GET['search-bar']) ? $_GET['search-bar'] : ''; ?></p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($search_result)){
             ?>
                 <div class="card">
                    <div class="image">
                    <img src="<?php echo $row["product_image"];?>" alt="">
                 </div>
                 <div class="caption">
                    <p class="rate">
                        <?php
                            $i;
                            for ($i=1;$i<=$row['rate'];$i++)
                        
		            echo '<i class="fas fa-star"></i>';
		            ?>
		    </p>
		    <p class="product_name"><?php echo $row["product_name"];?></p>
		    <table>
		    <tr>
		    <td>
		    <p class="price"><b>&#x20B9;<?php echo $row["price"];?></b></p></td>
		    <td><div class="quantity">
    <button class="decrement-btn" onclick="decrementQuantity('<?php echo $row["menu_id"]; ?>')">-</button>
    <input type="text" class="quantity-input" value="1" data-id="<?php echo $row["menu_id"]; ?>">
    <button class="increment-btn" onclick="incrementQuantity('<?php echo $row["menu_id"]; ?>')">+</button>
  </div></td></tr></table>
		   
                 </div><br>
                 <button class="add" onclick="addToCart('<?php echo $row["menu_id"]; ?>', document.querySelector('[data-id=\'<?php echo $row["menu_id"]; ?>\']').value)">Add to cart</button>

                 </div>
                 <?php
                        }
                 ?>
                 <?php
                        }else{
                             echo '<span class="EmptyCart">Not Found!</span>';
                        }
                 ?>
             </main>
             
               </div>
               <div id="checkout" class="cart-toggle">
    
    
        <p id="result-found">Results Found : <?php echo $norows; ?></p>
    
    
 
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
