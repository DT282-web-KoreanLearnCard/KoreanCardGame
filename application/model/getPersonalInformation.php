<?php
    session_start();
    include './dbConnect.php';
    header("Content-Type: application/json");
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $nickname = $_SESSION['nickname'];
        //(id, nickname, animal, fruit, verb, total)
        $result = array('id'=>$id, 'nickname'=>$nickname);
        $query = "select sum(score) from GAMELOG where categoryid = 1 and userid = '$id'";
        $query_result = mysqli_fetch_assoc(mysqli_query($connect, $query))['sum(score)'];
        $tmp = array('animalScore' => $query_result);
        $result = $result + $tmp;
        $query = "select sum(score) from GAMELOG where categoryid = 2 and userid = '$id'";
        $query_result = mysqli_fetch_assoc(mysqli_query($connect, $query))['sum(score)'];
        $tmp = array('fruitScore' => $query_result);
        $result = $result + $tmp;
        $query = "select sum(score) from GAMELOG where categoryid = 3 and userid = '$id'";
        $query_result = mysqli_fetch_assoc(mysqli_query($connect, $query))['sum(score)'];
        $tmp = array('verbScore' => $query_result);
        $result = $result + $tmp;
        $query = "select sum(score) from GAMELOG where userid = '$id'";
        $query_result = mysqli_fetch_assoc(mysqli_query($connect, $query))['sum(score)'];
        $tmp = array('totalScore' => $query_result);
        $result = $result + $tmp;
        echo json_encode($result);
    }
    else{
        echo "FAIL";
    }
?>