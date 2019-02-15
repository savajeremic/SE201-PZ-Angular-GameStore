<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("functions.php");

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) /*&& isset($_POST['name'])
	&& isset($_POST['surname']) && isset($_POST['avatar']) && isset($_POST['birth_date']) && isset($_POST['country'])*/)
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	/*$name = $_POST['name'];
	$surname = $_POST['surname'];
	$avatar = $_POST['avatar'];
	$birth_date = $_POST['birth_date'];
	$country = $_POST['country'];*/

echo register($username, $password, $email/*, $name, $surname, $avatar, $birth_date, $country*/);
}
?>
