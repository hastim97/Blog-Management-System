<?php

define("SERVER","localhost"); //defines constants
define("USERNAME","Hasti");
define("PASSWORD", "hasti");
define("DB","cms");

//create a connection
$connection = mysqli_connect(SERVER,USERNAME,PASSWORD,DB);

//check the connection
if(!$connection){
    die("Connection failed ".mysqli_connect_error());
}
//echo "Connection successfull";
?>