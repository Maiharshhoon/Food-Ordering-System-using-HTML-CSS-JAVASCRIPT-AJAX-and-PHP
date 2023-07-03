<?php

 session_start();
 include("connnection.php");
 include("functions.php");
 
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $category = $_POST['category'];
    if ($category=="south-indian")
    {
       $category = str_replace('-', ' ', $category);
    }
    $product_name = $_POST['product-name'];
    $product_name = ucwords($product_name);
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $veg_type = $_POST['veg-type'];
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];

    // Move uploaded image to desired directory
    $target_dir = "images/".$category."/"; 
    $target_file = $target_dir . basename($image_name);
    if (!move_uploaded_file($image_tmp_name, $target_file)) {
    echo "Error moving file: " . $_FILES["image"]["error"];
    echo $target_dir;
    echo $target_file;
    exit;
    }

    // Store data in database or file
    // ...
    
    $sql = "SELECT * FROM menu WHERE product_name = '$product_name'";
    $result = pg_query($con, $sql);
    if (pg_num_rows($result)<=0)
    {
        $sql = "INSERT INTO menu (category_name,product_name,price,rate,veg_or_not,product_image) VALUES ('$category','$product_name','$price','$rating','$veg_type','$target_file')";
        if (pg_query($con, $sql))
        {
           $msg="Product Added to Menu";
           echo $msg;
        }
        else
        {
            $msg= "Error: " . pg_last_error($con);
            echo $msg;
        }
    }
    else
    {
          $msg="Product Already in the Menu!!!";
           echo $msg;
    }

}
?>

<!DOCTYPE html>
<html>

      <head>
            <title>Login</title>
            <link rel="stylesheet" href="login.css">
            <style>

.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: bold;
  margin-top: 10px;
}

select,
input[type="text"],
input[type="number"] {
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-top: 5px;
  margin-bottom: 10px;
  font-size: 16px;
  box-shadow: 0px 0px 5px #ccc;
}

select {
  width: 100%;
}

input[type="radio"] {
  margin-right: 5px;
}

.veg-type-label {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.veg-type-label > label {
  margin-right: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
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
       <form method="post" enctype="multipart/form-data">
  <label for="category">Category:</label>
  <select id="category" name="category">
    <option value="biryani">Biryani</option>
    <option value="chicken">Chicken</option>
    <option value="chinese">Chinese</option>
    <option value="paneer">Paneer</option>
    <option value="south-indian">South Indian</option>
    <option value="vegetable">Vegetable</option>
  </select>
  <br>
  <label for="product-name">Product Name:</label>
  <input type="text" id="product-name" name="product-name" required>
  <br>
  <label for="price">Price:</label>
  <input type="number" id="price" name="price" required>
  <br>
  <label for="rating">Rating:</label>
  <select id="rating" name="rating">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  <br>
  <label for="veg-type">Veg Type:</label>
<div class="veg-type-label">
  <label for="veg">VEG</label>
  <input type="radio" id="veg" name="veg-type" value="VEG" required>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <label for="non-veg">NON-VEG</label>
  <input type="radio" id="non-veg" name="veg-type" value="NON-VEG" required>
</div>

  <br>
  <label for="image">Upload Image:</label>
  <input type="file" id="image" name="image" accept="image/*">
  <br>
  <input type="submit" value="Submit">
</form>

    </div>
    
  </body>
</html>

