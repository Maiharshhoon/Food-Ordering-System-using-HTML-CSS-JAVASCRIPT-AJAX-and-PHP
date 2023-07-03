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
            .profile {
  display: flex;
  flex-direction: column;
  align-items: left;
  justify-content: center;
  width: 500px;
  height: auto;
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  background-color: #fff;
  margin-left : 450px;
  margin-top : 90px;
}

.profile span {
  display: block;
  font-family: 'poppins', sans-serif;
  margin-bottom: 18px;
  font-weight: bold;
}

.firstname, .lastname, .username, .address, .email{
  display: block;
  margin-bottom: 20px;
  font-size: 18px;
}

.updBtn {
  font-family:'poppins',sans-serif;
  display: block;
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
  transition: all 0.3s ease-in-out;
  margin-left : 620px;
  margin-top : 40px;
  margin-right:650px;
}

.updBtn:hover {
  background-color: #0069d9;
  cursor: pointer;
}
.proftitle{
   font-family:'poppins',sans-serif;
   color:indianred;
   font-size:45px;
   margin-left : 620px;
  margin-top : 40px;
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
                 <p class="proftitle">Profile</p>
                  <div class="profile">
                        
                        <span class="firstname">First Name : <?php echo $user_data['first_name']; ?></span>
                        <span class="lastname">Last Name : <?php echo $user_data['last_name']; ?></span>
                        <span class="username">User Name : <?php echo $user_data['user_name']; ?></span>
                        <span class="email">Email : <?php echo $user_data['email']; ?></span>
                        <span class="address">Delivery Address : <?php echo $user_data['address']; ?></span>
                        
                  </div> 
                   <a class ="updBtn" href="updateProfile.php">Update</a>   
                  
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
