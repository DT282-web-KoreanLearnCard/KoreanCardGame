<?php
    session_start();
    //connect to DB
    include '../model/dbConnect.php';
    header("Content-Type: application/json");
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $count = 0;
    //checking results to see if any account has that username and password
    $query = "select nickname from user where userid = '$id' and password = '$password'";
    $count = mysqli_num_rows(mysqli_query($connect, $query));
    $nickname = mysqli_fetch_assoc(mysqli_query($connect, $query))['nickname'];
    if ($count == 0) {
        //if no results found
        echo json_encode(array('res'=>'FAIL'));
//        echo "no account found";

    } else {
        //set username to session variable
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['nickname'] = $nickname;
//        echo 'OK';
        echo json_encode(array('res'=>'OK'));
//        echo "welcome  " . $id;
        //direct user to home page while being logged in
//        header("Location:../view/card_index.php");
}
?>

