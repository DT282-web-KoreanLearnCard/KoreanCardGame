
<html>
<head>
 <meta charset="utf-8"/>
    <title>BOARD</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <link rel="stylesheet" href="../../static/css/nav.css">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="../../static/css/signup.css">
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

 <?php

include '../model/dbConnect.php';
    
   $sql = "select * from board where num=".$_GET['num'];
   $res = mysqli_query($connect,$sql);
    $res = mysqli_fetch_assoc($res);

	echo "id:" .$res['USERID'];
	echo '<p/>';

	echo "subject:" .$res['subject'];
	echo '<p/>';

	echo "memo:" .$res['memo'];
	echo '<p/>';

	echo "<td align='left'>
          <a href='../model/download.php?num=".$res['num']."'>".$res['name']."</a></td>";

 ?>
        </div></section></div>

</html>


