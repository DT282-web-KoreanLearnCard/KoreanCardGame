<?php

    header("Content-type: text/html; charset=utf-8");

    if(!$_GET['num'])
    {
        echo "<script>alert('Failed');";
        echo "history.back();</script>";
    }

    $host = 'localhost';
	$user = 'klearning';
	$pw = 'webproject';
	$dbName = 'klearning';
	$mysqli = new mysqli($host, $user, $pw, $dbName);


    if(mysqli_connect_errno())
        {
            echo "DB connect error";

            exit;
		}

    $sql = "select name, hash from board where num=".$_GET['num'];
    $res = $mysqli->query($sql);
    if(!$res)
    {
        echo "query error";
        exit;
    }
    $res = $res->fetch_assoc();

    $dir = "./files/";
    $filename = $res['name'];
    $filehash = $res['hash'];

    if(file_exists($dir.$filehash))
    {
            header("Content-Type: Application/octet-stream");
            header("Content-Disposition: attachment; filename=".$filename);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($dir.$filehash));

            $fp = fopen($dir.$filehash, "rb");
            while(!feof($fp))
            {
                echo fread($fp, 1024);
            }
            fclose($fp);

            $sql = "update board set down=(down+1) where num=".$_GET['num'];
            $res = $mysqli->query($sql);
            if(!$res)
            {
                echo "down counter update error";
                exit;
            }
    }
    else
    {
            echo "<script>alert('No Such File');";
            echo "history.back();</script>";
            exit;
    }
 mysqli_close($mysqli);

?>
