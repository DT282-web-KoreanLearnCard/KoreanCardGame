<html>
    <meta charset="utf-8"/>
    <title>BOARD</title>
</html>
<body>
    <form action="write.php" method="POST" enctype="multipart/form-data" />
	<table  align= "center" >
	<col width=100></col><col width=100></col>
		<tr>
			<td>Id:</td>
			<td><input type="text" name="id" /></td>
		</tr>
		<tr>
			<td>Title:</td>
			<td><input type="text" name="subject" /></td>
		</tr>
		<tr>
			<td>Context:</td>
			<td><textarea name="memo" rows="20"></textarea></td>
		</tr>
		<tr>
			<td>File:</td>
			<td><input type="file" id="file" name="file" /></td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="submit" />
			</td>
		</tr>
		</table>
    </form>
</body>
</html>
