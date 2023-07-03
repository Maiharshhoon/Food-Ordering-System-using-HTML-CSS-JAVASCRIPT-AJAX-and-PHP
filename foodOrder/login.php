<?php

 session_start();
 include("connnection.php");
 include("functions.php");
   
?>

<!DOCTYPE html>
<html>

      <head>
            <title>Login</title>
            <link rel="stylesheet" href="login.css">
      </head>
      
      <body>
        <header>
           <div class="logo">
               <img src="foodash.png" alt="Logo">
           </div>
           <a href="adminLogin.php" class="login-link">Login as Admin</a>
        </header><br><br><br><br>
        <div class="container">
             <form method="post">
                <h1>Login</h1>
                <div class="input-group">
                    <input type="text" name="user_name" placeholder="Enter Your User Name">
                </div>
        <div class="input-group">
           <input type="password" name="password" placeholder="Enter Your Password">
        </div>
        <?php
        
            if ($_SERVER['REQUEST_METHOD']=="POST")
            {
               $user_name = $_POST['user_name'];
               $password = $_POST['password'];
     
               if (!empty($user_name) && !empty($password) && !is_numeric($user_name))
               {
               
                  //read to database 
                  $query = "select * from users where user_name = '$user_name' limit 1";
                  $result = pg_query($con,$query);
                  if ($result)
                  {
                     if ($result && pg_num_rows($result)>0)
                     {
                         $user_data = pg_fetch_assoc($result);
                         if ($user_data['password']==$password)
                         {
                             $_SESSION['user_id'] = $user_data['user_id'];
                             header("Location: index.php");
                    
                         }
                     }
                  }
                  echo "<div class='error-message'>Wrong Username or Password!!</div>";
               }
               else
               {
                    echo "Please enter some valid informations!!";
               }
            }
        ?>
        <button class="btn" type="submit">Login</button>
        <div class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></div>
        
      </form>
    </div>
    
  </body>
</html>

