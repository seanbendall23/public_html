<html>
	<head>
		<title>Database Querying</title>
	</head>
	<body>
		<h1>ADM - Actor Database Manager</h1>
		<br><br>
		<?php
		if (isset($_POST['ActorName']))
		{
			$actorName = $_POST['ActorName'];
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

		$actID = 0;
		$ifExistsQuery = "SELECT actID FROM Actor WHERE actName = '$actorName'";
		$stmt = $conn->prepare($ifExistsQuery);
		$stmt->execute();
		$stmt->bind_result($actID);
		while ($stmt->fetch())
		{
			$actID = htmlentities($actID);
		}
		echo "Actor ID is $actID <br>";
		if ($actID == 0)
		{
			echo "That actor does not exist";
		}
		else 
		{
			$updateQuery = "UPDATE Movie SET actID=0 WHERE actID=$actID";
			if ($conn->query($removeQuery) === TRUE)
			{
				echo "movies with actor successfully changed";
			}
			else 
			{
				echo "error has occurred" . $conn->error;
			}

			$removeQuery = "DELETE FROM Actor WHERE actID=$actID";
			if ($conn->query($removeQuery) === TRUE)
			{
				echo "record deleted successfully";
			}
			else 
			{
				echo "error has occurred" . $conn->error;
			}
		}
		$conn->close();
		?>
		<br><br>
		<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>

	</body>
</html>