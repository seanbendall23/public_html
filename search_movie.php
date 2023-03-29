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
echo "Connection made successfully <br>";

$ID = 0;
$query = "SELECT (mvID, actID, mvGenre, mvPrice) FROM Movie WHERE mvName = '$movieName'";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($ID, $ActorID, $Genre, $Price);

$count = 1;

echo "Results: ";
/*
while ($stmt->fetch())
{
	echo "<br>";
	echo "Movie #" . htmlentities($count) . " :<br>";
	echo "ID: " . htmlentities($ID) . "<br>";
	echo "Genre: " . htmlentities($Genre) . "<br>";
	echo "Price: " . htmlentities($Price) . "<br>";
}
*/
?>
