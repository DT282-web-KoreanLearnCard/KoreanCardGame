<html>
<head>
    <meta charset="utf-8"/>
    <title>File list</title>
</head>
<body>
<?php

$host = 'localhost';
$user = 'klearning';
$pw = 'webproject';
$dbName = 'klearning';
$mysqli = new mysqli($host, $user, $pw, $dbName);

 if(mysqli_connect_errno())
        {
            echo "DB connect error";
        }
		
		$sql = "select * from board";
		$res = $mysqli->query($sql);
		$num_result = $res->num_rows;
    ?>
	
	
	
	<table border='1' align="center">
        <thead>
            <tr>
                <th width="50">NUM</th>
                <th width="250">FILE</th>
                <th width="200">TIME</th>
				<th width="50">id</th>
				<th width="70">subject</th>
				<th width="250">memo</th>
				<th width="70">DOWN</th>
				<th width="50">DEL</th>
				

            </tr>
        </thead>
        <tbody>
            <?php
                for($i=0; $i<$num_result; $i++)
                {
                    $row = $res->fetch_assoc();
                    echo "<tr>";
                    echo "<td align='center'>".$row['num']."</td>";
                    echo "<td align='left'>
                <a href='./download.php?num=".$row['num']."'>".$row['name']."</a></td>";
                    echo "<td align='center'>".$row['time']."</td>";
                    echo "<td align='center'>".$row['USERID']."</td>";
                    echo "<td align='center'>
				<a href='./view.php?num=".$row['num']."'>".$row['subject']."</a></td>";	
                    echo "<td align='center'>".$row['memo']."</td>";
					echo "<td align='center'>".$row['down']."</td>";	
					echo "<td align='center'>
				<a href='./delete.php?num=".$row['num']."'>DEL</a></td>";					
                    echo "</tr>";
                }
              mysqli_close($mysqli);

			  
            ?>
			<input type = "button" name = "table" value ="write" onclick = "location.href='table.php'";>
		</tbody>
    </table>

</body>
</html>
