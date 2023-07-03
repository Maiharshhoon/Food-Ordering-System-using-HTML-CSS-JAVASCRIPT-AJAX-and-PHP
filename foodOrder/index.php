<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 
 $sql = "SELECT * FROM MENU";
 $all_product = pg_query($con,$sql);
 $sql1 = "SELECT * FROM MENU WHERE CATEGORY_NAME='biryani'";
 $biryani = pg_query($con,$sql1);
 $sql2 = "SELECT * FROM MENU WHERE CATEGORY_NAME='chicken'";
 $chicken = pg_query($con,$sql2);
 $sql3 = "SELECT * FROM MENU WHERE CATEGORY_NAME='chinese'";
 $chinese = pg_query($con,$sql3);
 $sql4 = "SELECT * FROM MENU WHERE CATEGORY_NAME='paneer'";
 $paneer = pg_query($con,$sql4);
 $sql5 = "SELECT * FROM MENU WHERE CATEGORY_NAME='south indian'";
 $south_indian = pg_query($con,$sql5);
 $sql6 = "SELECT * FROM MENU WHERE CATEGORY_NAME='vegetable'";
 $vegetable = pg_query($con,$sql6);
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
                 
                  <h1>Welcome, <?php echo $user_data['first_name'];?>!</h1>
                  <div class="add-box">
                     <i class="fa fa-map-marker your-address" id="add-address">&nbsp&nbsp<?php echo $user_data['address'];?></i>
                  </div>     
                  <div id="biryani-section">
                     <p id="category-name">Biryani</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($biryani)){
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
             </main></div>
             <div id="chicken-section">
             <p id="category-name">Chicken Delicious</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($chicken)){
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
             </main></div>
             <div id="chinese-section">
             <p id="category-name">Chinese Corner</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($chinese)){
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
             </main></div>
             <div id="paneer-section">
             <p id="category-name">Paneer Mania</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($paneer)){
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
             </main></div>
             <div id="south-indian-section">
             <p id="category-name">South Indian</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($south_indian)){
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
                 </main></div>
                 <div id="veg-section">
                 <p id="category-name">Pure Veg Dishes</p>
                      
             <main>
             <?php
                 while($row = pg_fetch_assoc($vegetable)){
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
                 </main></div>
               </div>
               <div id="category-list">
                   <p class="item-menu">Go For Hunt</p>
                   <div class="border"></div>
                   <div class="list-card" data-category="chinese">
                      <img src="./images/chinese/chowmin.jpg" alt="list">
                      <a href="#chinese-section" class="list-name">Chinese</a>
                   </div>
                   <div class="list-card" data-category="chicken">
                      <img src="./images/chicken/Chicken-Curry.jpg" alt="list">
                      <a href="#chicken-section" class="list-name">Chicken</a>
                   </div>
                   <div class="list-card" data-category="paneer">
                      <img src="./images/paneer/Matar-Paneer.jpg" alt="list">
                      <a href="#paneer-section" class="list-name">Paneer</a>
                   </div>
                   <div class="list-card" data-category="south-indian">
                      <img src="./images/south indian/mysore-bonda.jpg" alt="list">
                      <a href="#south-indian-section" class="list-name">South Indian</a>
                   </div>
                   <div class="list-card" data-category="biryani">
                      <img src="./images/biryani/Chicken-Biryani-hyd.jpg" alt="list">
                      <a href="#biryani-section" class="list-name">Biryani</a>
                   </div>
                   <div class="list-card" data-category="veg">
                      <img src="./images/vegetable/vegetable-curry.jpeg" alt="list">
                      <a href="#veg-section" class="list-name">Pure Vegetarian</a>
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
