<?php
//register page
include('../model/register.php');

//connect to DB
$connect = mysqli_connect("localhost","root","bemyprettyboy","klearning", 3306);
if(!$connect) die('Not connected : ' . mysqli_error());

//get form from index.html
$id = $_POST['id'];
$password = $_POST['password'];

//check login button or register or guest
//login
if(isset($_POST['login'])){
    $select_query = "select count(*) from user where USERID = "+$id+" and PASSWORD = "+$password;
    if(mysqli_query($connect, $select_query) > 0){
        //call the game page
        echo "SUCCESS!";
    }
    else{
        //login denied
        echo "DENIED";
    }
}

//register


//guest


?>

