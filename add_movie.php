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
$pass_file = fopen('/PASSWORD.txt', "r") or die("Unable to open file!");
echo fread($pass_file, filesize("/PASSWORD.txt"));
fclose($pass_file);
echo "Hello World";


/*
$db_host = 'mysql.cs.nott.ac.uk';
$db_user = 'psysb16-COMP1004';
$db_pass = '';
$db_name = 'psysb16-COMP1004';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error)
{
	die($conn->connect_error);
}

$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ($movieGenre, moviePrice, movieName, 1)"
$result = $conn->query($query)
*/
?>