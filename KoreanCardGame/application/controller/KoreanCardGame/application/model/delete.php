<?php    
 
    if(!$_GET['num'])
    {
        echo "<script>alert('Failed');";
        echo "history.back();</script>";
    }

include '../model/dbConnect.php';
    
    $sql = "select hash from board where num=".$_GET['num'];
    $res = mysqli_query($connect,$sql);
    if(!$res)
    {
        echo "select query error";
        exit;
    }
    $res = mysqli_fetch_assoc($res);
    
    $dir = "./files/";
    $filehash = $res['hash'];
    
    if(!unlink($dir.$filehash))
    {
            echo "file delete error";
            exit;
    }
    
    $sql = "delete from a where num=".$_GET['num'];
    $res = mysqli_query($connect,$sql);
    if(!$res)
    {
        echo "delete query error";
        exit;
    }
    
    echo "<script>alert('파일이 삭제되었습니다.');";
    echo "history.back();</script>";
    
?>
