<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['game_id'])) {
  $game_id = $_POST['game_id'];
  $token = $_SERVER['HTTP_TOKEN'];
  echo addToCart($game_id, $token);
}
?>
