<?php

 session_start();
 include("connnection.php");
 include("functions.php");
 $admin_data = check_adminLogin($con); 
?>


<!DOCTYPE html>
<html>

      <head>
            <title>Admin</title>
            <link rel="stylesheet" href="login.css">
            <style>
            .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 800px; /* Add the max-width property */
    margin: 0 auto; /* Center the container horizontally */
}

a {
    display: block;
    width: 500px;
    height: 80px;
    background-color: #f2f2f2;
    border-radius: 10px;
    margin: 10px;
    text-align: center;
    line-height: 80px;
    font-size: 24px;
    color: #333;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    padding: 0 20px; /* Add padding to the left and right of the button text */
}

a:hover {
    background-color: #333;
    color: #f2f2f2;
    transform: scale(1.05);
}


            </style>
      </head>
      
      <body>
        <header>
           <div class="logo">
               <img src="foodash.png" alt="Logo">
           </div>
          
        </header><br><br><br><br>
        <div class="container">
             <a href="PlacedOrders.php">Placed Orders</a>
             <a href="addMenu.php">Add Menu Item</a>
             <a href="UpDelMenu.php">Update and Delete Menu Item</a>
             <a href="readMessages.php">Read Queries and Messages</a>
        </div>
    
  </body>
</html>

