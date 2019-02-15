<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if (isset($_POST['game_id']) && isset($_SERVER['HTTP_TOKEN'])) {
  $game_id = $_POST['game_id'];
  $token = $_SERVER['HTTP_TOKEN'];
  echo removeFromWishlist($game_id, $token);
}
?>
