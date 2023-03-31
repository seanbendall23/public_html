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


		$actID = 0;
		$ifExistsQuery = "SELECT actID FROM Actor WHERE actName = '$actorName'";
		$stmt = $conn->prepare($ifExistsQuery);
		$stmt->execute();
		$stmt->bind_result($actID);
		while ($stmt->fetch())
		{
			$actID = htmlentities($actID);
		}
		if ($actID == 0)
		{
			echo "<p class='p p1'> That actor does not exist</p>";
		}
		else 
		{
			$foreign = "SET FOREIGN_KEY_CHECKS=0";
			$conn->query($foreign);

			$updateQuery = "UPDATE Movie SET actID=0 WHERE actID=$actID";
			if ($conn->query($updateQuery) === TRUE)
			{
				echo "<p class='p p1'>Movies with actor successfully changed<br></p>";
			}
			else 
			{
				echo "<p class='p p1'>Error has occurred in updating the movies with that actor in: " . $conn->error . "<br></p>";
			}

			$removeQuery = "DELETE FROM Actor WHERE actID=$actID";
			if ($conn->query($removeQuery) === TRUE)
			{
				echo "<p class='p p1'>Record deleted successfully<br></p>";
			}
			else 
			{
				echo "<p class='p p1'>Error has occurred in removing actor from table Actor: " . $conn->error . "<br></p>";
			}

			$foreign = "SET FOREIGN_KEY_CHECKS=1";
			$conn->query($foreign);
		}
		$conn->close();
		?>
		<br><br>
		<div align='center'>
			<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
		</div>
		

	</body>
</html>