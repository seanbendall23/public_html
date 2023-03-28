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
echo "Connection made successfully";

//start by trying to retrieve the actor ID from the database.
function getActorID($actName)
{
	$actIDQuery = "SELECT actID FROM Actor WHERE actName = '$actName'";
	$result = $conn->query($actIDQuery);
	if ($result === TRUE)
	{
		if (empty($result)) 
		{
			return "Actor does not exist in database, adding them now.";
		}
			
		else 
		{
			return $result;	
		}
	}
	else 
	{
		echo "Error: " . $conn->error;
	}
	
}

//then, once you have the actors ID, you can add to the database.
echo getActorID($actName);
/*
$query = "INSERT INTO Movie (mvGenre, mvPrice, mvName, actID) VALUES ('$movieGenre', '$moviePrice', '$movieName', 1)";
if ($conn->query($query) === TRUE) 
{
  echo "Success - new actor added.";
} 
else 
{
  echo "Error: ". $conn->error;
}
*/
$conn->close();
?>