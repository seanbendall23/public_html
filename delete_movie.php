<html>
	<head>
		<title>Database Querying</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<br>
		<h1 class="h1 h1a">ADM - Actor Database Manager</h1>
		<br><br>
		<?php
		if (isset($_POST['MovieName']))
		{
			$movieName = $_POST['MovieName'];
		}
		if (isset($_POST['MovieGenre']))
		{
			$movieGenre = $_POST['MovieGenre'];
		}

		//require_once 'login.php';
		$db_host = 'mysql.cs.nott.ac.uk';
		$db_user = 'psysb16_COMP1004';
		$db_pass = '1234567';
		$db_name = 'psysb16_COMP1004';

		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$movieID = 0;
		$ifExistsQuery = "SELECT mvID FROM Movie WHERE mvName = '$movieName' AND mvGenre = '$movieGenre'";
		$stmt = $conn->prepare($ifExistsQuery);
		$stmt->execute();
		$stmt->bind_result($movieID);
		while ($stmt->fetch())
		{
			$movieID = htmlentities($movieID);
		}
		if ($movieID == 0)
		{
			echo "<p class='p p1'> That movie does not exist</p>";
		}
		else 
		{
			$removeQuery = "DELETE FROM Movie WHERE mvID=$movieID";
			$stmt = $conn->prepare($removeQuery);
			$stmt->execute();
			echo "<p class='p p1'>removed successfully</p>";
		}
		$conn->close();
		?>
		<br><br>
		<div align='center'>
			<button type="button" class="button button1" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
		</div>


	</body>
</html>