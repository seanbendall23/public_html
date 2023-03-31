<html>
	<head>
		<title>Database Querying</title>
	</head>
	<body>
		<h1 class = "h1 h1a">ADM - Actor Database Manager</h1>
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
			echo "<p class='p p1'> Actor Added Successfully.";
		}
		else 
		{
			echo "<script> alert('This actor already exists.');</script>";
		}
		?>
		<br><br>
		<button class = "button button1" type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
	</body>
</html>
