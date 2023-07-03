<?php

 session_start();
 include("connnection.php");
 include("functions.php");
   
?>

<!DOCTYPE html>
<html>

      <head>
            <title>Admin Login</title>
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
                <h1>Admin Login</h1>
                <div class="input-group">
                    <input type="text" name="admin_name" placeholder="Enter Your User Name">
                </div>
        <div class="input-group">
           <input type="password" name="password" placeholder="Enter Your Password">
        </div>
        <?php
        
            if ($_SERVER['REQUEST_METHOD']=="POST")
            {
               $admin_name = $_POST['admin_name'];
               $password = $_POST['password'];
     
               if (!empty($admin_name) && !empty($password) && !is_numeric($admin_name))
               {
               
                  //read to database 
                  $query = "select * from admin where admin_name = '$admin_name' limit 1";
                  $result = pg_query($con,$query);
                  if ($result)
                  {
                     if ($result && pg_num_rows($result)>0)
                     {
                         $admin_data = pg_fetch_assoc($result);
                         if ($admin_data['password']==$password)
                         {
                             $_SESSION['admin_id'] = $admin_data['admin_id'];
                             header("Location: admin.php");
                    
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
        <div class="signup-link"><a href="login.php">Customer Login</a></div>
        
      </form>
    </div>
    
  </body>
</html>

