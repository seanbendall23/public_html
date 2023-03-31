
<html>
	<head>
		<title>Database Querying</title>
	</head>
	<body>
		<br>
		<h1 class="h1 h1a">ADM - Actor Database Manager</h1>
		<?php
			if (isset($_POST['MovieName']))
			{
				$movieName = $_POST['MovieName'];
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
			$query = "SELECT mvID, actID, mvGenre, mvPrice FROM Movie WHERE mvName = '$movieName'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$stmt->bind_result($ID, $ActorID, $Genre, $Price);

			$count = 1;

			echo "<p class="p p1"> Results: </p>";

			while ($stmt->fetch())
			{
				echo "<br>";
				echo "<p class="p p1"> Movie #" . htmlentities($count) . " :<br></p>";
				echo "<p class="p p1">ID: " . htmlentities($ID) . "<br></p>";
				echo "<p class="p p1">Genre: " . htmlentities($Genre) . "<br></p></p>";
				echo "<p class="p p1">Price: " . htmlentities($Price) . "<br></p>";
				$count = $count + 1;
			}
			if ($count == 1)
			{
				echo "<script> alert('This movie does not exist.');</script>";
			}
		?>
		<br><br>
		<div align="center">
			<button type="button" class="button button1"onclick="window.location.href='http://avon.cs.nott.ac.uk/~psysb16/application.html';">Return to menu.</button><br>
		</div>
	</body>
</html>
