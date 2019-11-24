<?php
    session_start();
    include './dbConnect.php';
    header("Content-Type: application/json");
    $id = $_SESSION['id'];
    $nickname = mysqli_real_escape_string($connect, $_POST['nickname']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = "select * from user where userid='$id'";
    $count = mysqli_num_rows(mysqli_query($connect, $query));
    if($count==1){
        $query = "update USER set nickname = '$nickname', password = '$password' where userid = '$id'";
        $_SESSION['nickname'] = $nickname;
        if(mysqli_query($connect, $query))
            echo json_encode(array("res"=>"SUCCESS"));
    }
    else{
        echo json_encode(array("res"=>"FAIL"));
    }
?>