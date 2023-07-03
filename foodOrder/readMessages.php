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
            <style>
/* Style for the order title */
.orderTitle {
  font-size: 24px;
  font-weight: bold;
  color: indianred;
  font-family:'poppins',sans-serif;
  margin-left:650px;
}

/* Style for the container */
.container {
  margin-top: 20px;
}

/* Style for the table */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

/* Style for the table cells */
td {
  padding: 10px;
  border: 1px solid #ccc;
}

/* Style for the user ID */
.user_id {
  font-weight: bold;
  color: #2c3e50;
  font-family:'poppins',sans-serif;
}

/* Style for the name */
.name {
  margin-top: 5px;
  color: #7f8c8d;
  font-family:'poppins',sans-serif;
}

/* Style for the username */
.username {
  margin-top: 5px;
  color: #7f8c8d;
  font-family:'poppins',sans-serif;
}

/* Style for the email */
.email {
  margin-top: 5px;
  color: #7f8c8d;
  font-family:'poppins',sans-serif;
}

/* Style for the message */
.message {
  margin-top: 10px;
  color: #2c3e50;
  font-family:'poppins',sans-serif;
  font-size:20px;
}

/* Add some colors */
.container {
  background-color: #ecf0f1;
  padding: 40px; /* Increase the padding */
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 100%; /* Increase the width */
  margin: 0 auto; /* Center the container horizontally */
  max-width: 1500px;
}

            </style>
      </head>
      
      <body>
        <header>
           <div class="logo">
               <img src="foodash.png" alt="Logo">
           </div>
           <a href="admin.php" class="login-link">Menu</a>
        </header><br><br><br><br>
        <div class="container">
        <p class="orderTitle">Messages : </p>
             <?php 
               $sql = "select * from feedback";
               $result = pg_query($con,$sql);
               while($feedback = pg_fetch_assoc($result))
               {
                   echo '<table><tr>';
                   $user_id = $feedback['user_id'];
                   $sql2 = "select * from users where user_id = '$user_id'";
                   $result1 = pg_query($con,$sql2);
                   while ($user_data = pg_fetch_assoc($result1))
                   {
                        echo '<td><p class="user_id">User Id : '.$user_data['user_id'].'</p></td></tr>';
                        echo '<tr><td><p class="name">Name : '.$user_data['first_name']." ".$user_data['last_name'].'</p></td></tr>';
                        echo '<tr><td><p class="username">User Name : '.$user_data['user_name'].'</p></td></tr>';
                        echo '<tr><td><p class="email">Email : '.$user_data['email'].'</p></td></tr>';
                   }
                   echo '<tr><td><p class="message">Message : '.$feedback['message'].'</p></td></tr></table>';
               }
             ?>
    </div>
    
  </body>
</html>

