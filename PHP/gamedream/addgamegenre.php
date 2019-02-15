<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['name'])){
	$name = $_POST['name'];
	echo addGameGenre($name);
}
?>
