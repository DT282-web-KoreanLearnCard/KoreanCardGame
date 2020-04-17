<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("Location: ../view/mypage.html");
    }
    else{
        echo "<html><head><title>Denied</title></head><body><h3>You cannot Access to this Page</h3><h4>Please Login</h4><p>Back to Home...</p></body></html>";
        flush();
//        sleep(3);
        echo "<meta http-equiv='refresh' content='1;url=../view/card_index.html?'>";
//        header("Location: ../view/home.html");
    }
?>