<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();
 include("connnection.php");
 include("functions.php");
 
 $sql1 = "SELECT * FROM MENU WHERE CATEGORY_NAME='biryani'";
 $biryani = pg_query($con,$sql1);
 $user_data = check_login($con);
 
 if ($_SERVER['REQUEST_METHOD']=="POST")
{
   $user_name = $_POST['user_name'];
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $address = $_POST['address'];
   $user_id = $_SESSION['user_id'];
   if (!empty($first_name) && !empty($last_name) && !empty($address) && !is_numeric($user_name)) {
       // Check for existing username only if the user has changed the username
       if (empty($user_name) || (isset($user_name) && $user_name === $user_data['user_name'])) {
           $query1 = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', address = '$address' WHERE user_id = '$user_id'";
           pg_query($con,$query1);
           header("Location: profile.php");
       } else {
           $query = "SELECT * FROM users WHERE user_name='$user_name'";
           $result = pg_query($con, $query);
           if (pg_num_rows($result) == 0) {
               $query1 = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', address = '$address' WHERE user_id = '$user_id'";
               pg_query($con,$query1);
               header("Location: profile.php");
           } else {
               $error_message = "User Name already exists.";
           }
       }
   } else {
       $error_message = "Please fill all the details.";
   }
}

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
            .UpdProfile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 500px;
  height: auto;
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  background-color: #fff;
  font-family: 'poppins', sans-serif;
  margin-left : 450px;
  margin-top : 60px;
  font-size:14px;
}

.UpdProfile h1 {
  color:indianred;
  font-family: 'poppins', sans-serif;
  margin-bottom: 20px;
  font-weight: bold;
  font-size: 24px;
}

.error-message {
  margin-bottom: 20px;
  color: #ff0000;
  font-size: 14px;
}

.input-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

.input-group input[type="text"] {
  padding: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
}

input[type="submit"] {
  display: block;
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  transition: all 0.3s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #0069d9;
  cursor: pointer;
}


            </style>
            <script>

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
                 
                  <div class="UpdProfile">
                        <form method="post">
        <h1>Update Profile</h1>
        <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <div class="input-group">
          First Name : <input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
        </div>
        <div class="input-group">
          Last Name : <input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
        </div>
        <div class="input-group">
          User Name : <input type="text" name="user_name" value="<?php echo $user_data['user_name']; ?>">
        </div>
        <div class="input-group">
          Delivery Address : <input type="text" name="address" value="<?php echo $user_data['address']; ?>">
        </div>
       <input type="submit" value="Save Changes">
      </form>
                  </div> 
                    
                  
               </div>
               <div id="category-list">
                   
                   
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
