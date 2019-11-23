<html>
   <meta charset="utf-8">


<?php

$host = 'localhost';
$user = 'klearning';
$pw = 'webproject';
$dbName = 'klearning';
$mysqli = new mysqli($host, $user, $pw, $dbName);

	
$id = $_POST['id'];
$subject = $_POST['subject'];
$memo = $_POST['memo'];
$file = $_FILES['file']['name'];

 $date = date("YmdHis", time());
 $dir = "./files/";
 $file_hash = $date.$_FILES['file']['name'];
 $file_hash = md5($file_hash);
 $upfile = $dir.$file_hash;



if(is_uploaded_file($_FILES['file']['tmp_name']))
    {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
            {
                    echo "upload error";
                    exit;
            }
    }


 
	
  $sql = "insert into board (name, userid, subject, memo, hash, time)";
  $sql = $sql. "values('$file','$id','$subject','$memo','$file_hash','$date')"; 
  
    $result = $mysqli->query($sql);
	
	
	
	if(!$result)
    {
        echo "DB upload error";
        exit;
    }
	
	
mysqli_close($mysqli);
	echo("<script>location.href='index.php';</script>");
    echo "<script>alert('Upload Succeed');";


	
	?>
	</html>
