<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

include("functions.php");

if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	echo getGame($id);
}
?>