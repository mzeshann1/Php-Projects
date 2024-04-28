<?php
$servername="localhost";
$username="root";
$password="";
$database="project2";

$conn= mysqli_connect($servername,$username,$password,$database);


// chechking if the database is connected or not

if(!$conn)
{
    die("cannot connect to the database due to the " . mysqli_connect_error());
}



?>