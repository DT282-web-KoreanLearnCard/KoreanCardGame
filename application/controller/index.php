<?php
//register page
//include('../model/register.php');

//connect to DB
$connect = mysqli_connect("localhost","klearning","webproject","klearning", 3306);
if(!$connect) die('Not connected : ' . mysqli_error());

//get form from index.html
$id = $_POST['id'];
$password = $_POST['password'];

//check login button or register or guest
//login
if(isset($_POST['login'])){
    $sql = "select nickname from user where USERID = "+$id+" and PASSWORD = "+$password;
    $result = mysqli_query($conn,$sql);
    
    if((int)(mysqli_num_rows($result)) > 0){
        //call the game page
        while($row = mysqli_fetch_assoc()){
            echo " " . $row["nickname"]. "Welcome". "<br>";
        }
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

