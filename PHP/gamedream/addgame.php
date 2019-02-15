<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['name']) && isset($_POST['description'])
 && isset($_POST['votes']) && isset($_POST['cover']) && isset($_POST['version']) && isset($_POST['rating']) && isset($_POST['release_date']) && isset($_POST['size'])
 && isset($_POST['price'])){
	$name = $_POST['name'];
	$description = $_POST['description'];
	$votes = $_POST['votes'];
	$cover = $_POST['cover'];
	$version = $_POST['version'];
	$rating = $_POST['rating'];
	$release_date = $_POST['release_date'];
	$size = $_POST['size'];
  $price = $_POST['price'];

	echo addGame($name, $description, $votes, $cover, $version, $rating, $release_date, $size, $price);
}
?>
