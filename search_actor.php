
<html>
	<head>
		<title>Database Querying</title>
	</head>
	<body>
		<h1>ADM - Actor Database Manager</h1>
		<?php
			if (isset($_POST['ActorName']))
			{
				$actorName = $_POST['ActorName'];
			}

			$db_host = 'mysql.cs.nott.ac.uk';
			$db_user = 'psysb16_COMP1004';
			$db_pass = '1234567';
			$db_name = 'psysb16_COMP1004';

			$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}

			$ID = 0;
			$query = "SELECT actID FROM Actor WHERE actName = '$actorName'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$stmt->bind_result($actorID);

			$count = 1;

			echo "Results: ";

			while ($stmt->fetch())
			{
				echo "<br>";
				echo "Actor #" . htmlentities($count) . " :<br>";
				echo "ID: " . htmlentities($actorID) . "<br>";
				echo "Name: " . htmlentities($actorName) . "<br>";
				$count = $count + 1;
			}
			if ($count == 1)
			{
				echo "<script> alert('This actor does not yet exist.');</script>";
			}
		?>
		<br><br>
		<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
	</body>
</html>
