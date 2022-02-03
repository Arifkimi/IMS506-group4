<?php


$server_name= "localhost";

$user_name= "root";

$password= "123456789";

$database_name= "bookstore";

$dsn        = "mysql:host=$server_name;dbname=$database_name"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

$conn= mysqli_connect($server_name ,  $user_name ,  $password ,  $database_name);

 

if ($conn) { 

echo "connected" ; 

}

 

?>