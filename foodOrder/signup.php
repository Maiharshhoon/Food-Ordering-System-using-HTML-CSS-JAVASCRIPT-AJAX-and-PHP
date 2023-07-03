<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connnection.php");
include("functions.php");

$error_message = "";

if ($_SERVER['REQUEST_METHOD']=="POST")
{
   $user_name = $_POST['user_name'];
   $password = $_POST['password'];
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $gender = $_POST['gender'];
   $address = $_POST['address'];
   
   if (!empty($user_name) && !empty($password) && !empty($first_name) && !is_numeric($first_name) && !empty($last_name) && !empty($email) && !is_numeric($user_name) && !empty($gender) && !empty($address))
   {
       // check if user_name or email already exists in the database
       $user_id = random_num(9);
       $query = "SELECT * FROM users WHERE user_name='$user_name' OR email='$email' OR user_id='$user_id'";
       $result = pg_query($con, $query);
       if (pg_num_rows($result) == 0) {
           // validate email format
           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               // save to database
               
               $query = "INSERT INTO users (user_id,first_name,last_name,gender,email,user_name,password,address) VALUES ('$user_id','$first_name','$last_name','$gender','$email','$user_name','$password','$address')";
               $result1=pg_query($con, $query);
               header("Location: login.php");
           } else {
               $error_message = "Invalid email format.";
           }
       } else {
           $error_message = "User Name or Email already exists.";
       }
   }
   else
   {
       $error_message = "Please fill all the details.";
   }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="foodash.png" alt="Logo">
      </div>
      <a href="#" class="login-link">Login as Admin</a>
    </header>
    <div class="container">
      <form method="post">
        <h1>Signup</h1>
        <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <div class="input-group">
          <input type="text" name="first_name" placeholder="Enter your First Name">
        </div>
        <div class="input-group">
          <input type="text" name="last_name" placeholder="Enter your Last Name">
        </div>
        <div class="gender">
  <span class="gender-label">Gender:</span>
  <div class="gender-options">
    <div class="gender-option"><br>
      <input type="radio" id="male" name="gender" value="male" checked>
      <label for="male">Male</label>
    </div>
    <div class="gender-option">
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label>
    </div>
    <div class="gender-option">
      <input type="radio" id="other" name="gender" value="other">
      <label for="other">Other</label>
    </div>
  </div>
</div>
<br>
        <div class="input-group">
          <input type="text" name="address" placeholder="Enter your Address">
        </div>
        <div class="input-group">
          <input type="email" name="email" placeholder="Enter your Email">
        </div>
        <div class="input-group">
          <input type="text" name="user_name" placeholder="Create Your User Name">
        </div>
        <div class="input-group">
          <input type="password" name="password" placeholder="Create Your Password">
        </div>
        
        
        <button class="btn" type="submit">Signup</button>
        <div class="signup-link"><a href="login.php">Login</a></div>
      </form>
    </div>
    
  </body>
</html>

