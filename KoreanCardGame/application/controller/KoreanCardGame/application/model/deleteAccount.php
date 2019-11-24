<?php
    session_start();
    include './dbConnect.php';
    header("Content-Type: application/json");

    $id = $_SESSION['id'];
    $query = "delete from board where userid = '$id';delete from gamelog where userid = '$id'; delete from user where userid = '$id';";
    if(mysqli_multi_query($connect, $query)){
        session_destroy();
        echo json_encode(array("res"=>"DELETED"));
    }
    else{
        echo json_encode(array("res"=>"FAILED"));
    }
?>