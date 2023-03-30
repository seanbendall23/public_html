<html>
	<head>
		<title>Database Querying</title>
	</head>
	<body>
		<h1>ADM - Actor Database Manager</h1>
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
		echo "Connection made successfully <br>";

		$movieID = 0;
		$ifExistsQuery = "SELECT mvID FROM Movie WHERE mvName = '$movieName' AND mvGenre = '$movieGenre'";
		$stmt = $conn->prepare($ifExistsQuery);
		$stmt->execute();
		$stmt->bind_result($movieID);
		while ($stmt->fetch())
		{
			$movieID = htmlentities($movieID);
		}
		echo "Movie ID is $movieID <br>";
		if ($movieID == 0)
		{
			echo "That movie does not exist";
		}
		else 
		{
			$removeQuery = "DELETE FROM Movie WHERE mvID=$movieID";
			$stmt = $conn->prepare($removeQuery);
			$stmt->execute();
			echo "removed successfully";
		}
		$conn->close();
		?>
		<br><br>
		<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>



	</body>
</html>