<?php
if (isset($_POST['MovieName']))
{
	$movieName = $_POST['MovieName'];
	echo $movieName;
}
if (isset($_POST['MovieGenre']))
{
	$movieGenre = $_POST['MovieGenre'];
	echo $movieGenre;
}
if (isset($_POST['MoviePrice']))
{
	$moviePrice = $_POST['MoviePrice'];
	echo $moviePrice;
}
if (isset($_POST['ActorName']))
{
	$actorName = $_POST['ActorName'];
	echo $actorName;
}
?>