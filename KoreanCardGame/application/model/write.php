<html>
   <meta charset="utf-8">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="../../static/css/nav.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php
include '../model/dbConnect.php';
session_start();
	
$id = $_POST['id'];
$subject = $_POST['subject'];
$memo = $_POST['memo'];
$file = $_FILES['file']['name'];

 $date = date("YmdHis", time());
 $dir = "../../static/files/";
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
            if(!isset($_SESSION['id'])){
                echo "You should log in to upload something";
                exit;
            }
            if($id!=$_SESSION['id']){
                echo "write in your account";
                exit;
            }
    }


 
	
  $sql = "insert into board (name, userid, subject, memo, hash, time)";
  $sql = $sql. "values('$file','$id','$subject','$memo','$file_hash','$date')"; 
  
    $result = mysqli_query($connect,$sql);;
	
	
	
	if(!$result)
    {
        echo "DB upload error";
        exit;
    }
	

	echo("<script>location.href='../controller/board_index.php';</script>");
    echo "<script>alert('Upload Succeed');";


	
	?>
	</html>
