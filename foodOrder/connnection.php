<?php
   $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = mydb";
   $credentials = "user = myuser password=123";

   $con = pg_connect("$host $port $dbname $credentials");
   if(!$con) 
   {
      echo "Error : Unable to open database\n";
   }
   
?>
