<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connnection.php");
include("functions.php");

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $user_id = $user_data['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message) && !empty($user_name) && !empty($email)) {
        // validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // save to database

            $query = "INSERT INTO feedback (user_id,user_name,name,email,message) VALUES ('$user_id','$user_name','$name','$email','$message')";
            $result1 = pg_query($con, $query);
            header("Location: contact.php");
        } else {
            $error_message = "Invalid email format.";
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
            <link rel="stylesheet" href="contact.css">
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="index1.css">
            
            
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
                      <div id="container1">
                      <div id ="content1">
                      <div class="right-side">
        <div class="topic-text">SEND US A MESSAGE</div>
        <p>If you have any type of query related to the website, you can send us a message from here. It will be our pleasure to help you.</p>
      <form method="POST">
        <div class="input-box">
          <input type="text" name="name" placeholder="Enter Your Name">
        </div>
        <div class="input-box">
          <input type="text" name="email" placeholder="Enter Your Email">
        </div>
        <div class="input-box message-box">
          <textarea name = "message" placeholder="Enter Your Message"></textarea>
        </div>
          <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <div class="button">
          <input type="submit" value="Send Now" >
        </div>
      </form>
    </div></div></div>
                  </div>
                  
               <div id="category-list1">
                  <div id="content">
                    <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">HPT & RYK</div>
          <div class="text-two">College Road</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+91 74472 78195</div>
          <div class="text-two">+91 90965 53549</div>
          <div class="text-two">+91 76207 44756</div>
          <div class="text-two">+91 81492 09374</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">Harshsingh@gmail.com</div>
          <div class="text-two">Shivampandey@gmail.com</div>
          <div class="text-two">Aloksingh@gmail.com</div>
          <div class="text-two">Devvratpujari@gmail.com</div>
        </div>
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
