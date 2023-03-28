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
echo "$actorID";

if ($actorID != 0)
{
	$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ('$movieGenre', '$moviePrice', '$movieName', $actorID)";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	echo "Success";
}




$conn->close();
?>