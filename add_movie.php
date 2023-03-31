
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
		if (isset($_POST['MoviePrice']))
		{
			$moviePrice = $_POST['MoviePrice'];
		}
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
			if ($actorName == "Unknown")
			{
				$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ('$movieGenre', '$moviePrice', '$movieName', 0)";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				echo "<p class='p p1'> Added a movie with unknown actor successfully.</p>";
			}
			else if ($actorID != 0)
			{
				$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ('$movieGenre', '$moviePrice', '$movieName', $actorID)";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				echo "<p class='p p1'>Added a movie successfully.</p>";
			}
			else //add actor to database and add movie.
			{
				$query = "INSERT INTO Actor (actName) VALUES ('$actorName')";
				$stmt = $conn->prepare($query);
				$stmt->execute();

				$actIDQuery = "SELECT actID FROM Actor WHERE actName = '$actorName'";
				$stmt = $conn->prepare($actIDQuery);
				$stmt->execute();
				$stmt->bind_result($actorID);
				while ($stmt->fetch())
				{
					$actorID =  htmlentities($actorID);
				}

				$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ('$movieGenre', '$moviePrice', '$movieName', $actorID)";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				echo "<p class='p p1'>Added a new lead actor and their respective movie successfully.</p>";
			}
		}
		else 
		{
			echo "<p class='p p1'>That movie already exists</p>";
		}
		$conn->close();
		?>
		<br><br>
		<div align="center">
			<button type="button" onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
		</div>


	</body>
</html>
