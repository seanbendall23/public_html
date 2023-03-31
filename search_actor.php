
<html>
	<head>
		<title>Database Querying</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<h1 class="h1 h1a">ADM - Actor Database Manager</h1>
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

			echo "<p class='p p1'> Results: </p>";

			while ($stmt->fetch())
			{
				echo "<br>";
				echo "<p class='p p1'>Actor #" . htmlentities($count) . " :<br></p>";
				echo "<p class='p p1'>ID: " . htmlentities($actorID) . "<br></p>";
				echo "<p class='p p1'>Name: " . htmlentities($actorName) . "<br></p>";
				$count = $count + 1;
			}
			if ($count == 1)
			{
				echo "<script> alert('This actor does not yet exist.');</script>";
				echo "<p class='p p1'>This actor does not yet exist.</p>"
			}
		?>
		<br><br>
		<div align='center'>

			<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
		</div>
	</body>
</html>
