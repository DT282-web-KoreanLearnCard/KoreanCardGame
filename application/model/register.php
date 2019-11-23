<?php
//    echo "register";
    include './dbConnect.php';
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $nickname = mysqli_real_escape_string($connect, $_POST['nickname']);

    //checking results to see if any account has that username and password
    $queryIDcheck = "select * from user where userid = '$id'";
    $queryNICKcheck = "select * from user where nickname = '$nickname'";
    $numID = mysqli_num_rows(mysqli_query($connect, $queryIDcheck));
    if($numID > 0){
        echo "Already Exist ID";
    }
    $numNick = mysqli_num_rows(mysqli_query($connect, $queryNICKcheck));
    if($numNick > 0){
        echo "Already Exist Nickname";
    }

    if($numID==0 && $numNick==0){
        $queryInsert = "insert into USER value('$id', '$nickname', '$password')";
        echo "$queryInsert";
        mysqli_query($connect, $queryInsert);
    }

//    echo "$id, $password, $nickname";
//    header("Location: ../view/index.html");



?>