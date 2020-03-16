


<html>
 <meta charset="utf-8"/>
    <title>BOARD</title>

<?php

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
    
   $sql = "select * from board where num=".$_GET['num'];
       $res = $mysqli->query($sql);
    $res = $res->fetch_assoc();
	



	echo "id:" .$res['USERID'];
	echo '<p/>';



	echo "subject:" .$res['subject'];
	echo '<p/>';


	echo "memo:" .$res['memo'];
	echo '<p/>';

	echo "<td align='left'>
          <a href='./download.php?num=".$res['num']."'>".$res['name']."</a></td>";
	
	 mysqli_close($mysqli);
 
 ?>
   



</html>


