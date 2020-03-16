<html>
<head>
    <meta charset="utf-8"/>
    <title>File list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../static/css/nav.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../static/css/myPage.css">
    <link rel="stylesheet" href="../../static/css/signup.css">

<script>
    function search1(){
        if(frm1.search.value){
            frm1.submit();
        }else{
            location.href="index.php";
        }
    }

</script>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" id="header"></header>
<script>
    $(function(){
        $('#header').load('../../static/navbar.html');
    })
</script>
<div class ="main">
    <section class="signup">
        <div class="signup-content">
<form method=GET name=frm1 action='board_index.php'>
SEARCH
            <select name=kind>
            <option value=subject selected>subject
            <option value=USERID>writer
            <option value=memo>memo
            </select>

            <input type=text size=45 name=search>
            <input type=button name=byn1 onclick="search1()" value="search">
            
        </form>
               

<?php
include '../model/dbConnect.php';

$sql = "select * from board";
		
    
    if(isset($_GET['search'])){

        $sel=$_GET['kind'];
        $search=$_GET['search'];
                
        $sql="select * from board where ".$sel." like '%".$search."%'";
}
    $res = mysqli_query($connect,$sql);
    $num_result = $res->num_rows;
?>
	
	
	
	<table border='1' align="center">
        <thead>
            <tr>
                <th width="50">NUM</th>
                <th width="150">FILE</th>
                <th width="100">TIME</th>
				<th width="50">id</th>
				<th width="70">subject</th>
				<th width="250">memo</th>
				<th width="70">DOWN</th>
				

            </tr>
        </thead>
        <tbody>
            <?php
                for($i=0; $i<$num_result; $i++) {
                    $row=mysqli_fetch_assoc($res);

                    echo "<tr>";
                    echo "<td align='center'>" . $row['num'] . "</td>";
                    echo "<td align='left'>
                <a href='../model/download.php?num=" . $row['num'] . "'>" . $row['name'] . "</a></td>";
                    echo "<td align='center'>" . $row['time'] . "</td>";
                    echo "<td align='center'>" . $row['USERID'] . "</td>";
                    echo "<td align='center'>
				<a href='./view.php?num=" . $row['num'] . "'>" . $row['subject'] . "</a></td>";
                    echo "<td align='center'>" . $row['memo'] . "</td>";
                    echo "<td align='center'>" . $row['down'] . "</td>";
                    echo "</tr>";
                }

            ?>

		</tbody>
    </table>
            <input type = "button" name = "table" value ="write" onclick = "location.href='../view/table.html'";>
        </div>
    </section></div>
</body>
</html>
