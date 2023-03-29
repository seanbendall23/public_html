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

		$actIDQuery = "SELECT actID FROM Actor WHERE actName = '$actorName'";
		$stmt = $conn->prepare($actIDQuery);
		$stmt->execute();
		$stmt->bind_result($actorID);
		$actorID = 0;
		while ($stmt->fetch())
		{
			$actorID =  htmlentities($actorID);
		}
		if ($actorID == 0) // not exist
		{
			$query = "INSERT INTO Actor (actName) VALUES ('$actorName')";
			$stmt = $conn->prepare($query);
			$stmt->execute();
		}
		else 
		{
			echo "<script> alert('This actor already exists.');</script>";
		}
		?>
		<br><br>
		<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
	</body>
</html>