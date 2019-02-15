<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['game_id']) && isset($_POST['company_id']) && isset($_POST['genre_id']) && isset($_POST['language_id'])){
	$game_id = $_POST['game_id'];
	$company_id = $_POST['company_id'];
	$genre_id = $_POST['genre_id'];
	$language_id = $_POST['language_id'];

	echo getGames();
	echo addGameCompany($game_id, $company_id);
  echo addGameGenre($game_id, $genre_id);
  echo addGameLanguage($game_id, $language_id);
}
?>
