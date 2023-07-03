<?php
   
    function check_login($con)
    {
             if (isset($_SESSION['user_id']))
             {
                 $id = $_SESSION['user_id'];
                 $query = "select * from users where user_id = '$id' limit 1";
                 $result = pg_query($con,$query);
                 if ($result && pg_num_rows($result)>0)
                 {
                     $user_data = pg_fetch_assoc($result);
                     return $user_data;
                 }
             }
             
             //redirect to login
             
             header("Location : login.php");
             die;
    }
    
    function check_adminLogin($con)
    {
             if (isset($_SESSION['admin_id']))
             {
                 $id = $_SESSION['admin_id'];
                 $query = "select * from admin where admin_id = '$id' limit 1";
                 $result = pg_query($con,$query);
                 if ($result && pg_num_rows($result)>0)
                 {
                     $admin_data = pg_fetch_assoc($result);
                     return $admin_data;
                 }
             }
             
             //redirect to login
             
             header("Location : login.php");
             die;
    }

    function random_num($length)
    {
        $text = "";
        if ($length < 5)
        {
            $length = 5;
        }
        
        $len = rand(4,$length);
        
        for ($i=0;$i<$len;$i++)
        {
            $text .=rand(0,9);
        }
        return $text;
    }
    
    function transaction_id($length1)
    {
        $text1 = "";
        if ($length1<5)
        {
           $length1 = 5;
        }
        $len1 = rand(4,$length1);
        
        for ($i=0;$i<$len1;$i++)
        {
            $text1 .=rand(0,9);
        }
        return $text1;
        
    }
?>
