<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	die();
}

function tokenToId($token)
{
    $token = str_replace('"', "", $token);
    global $conn;
    $result = $conn->prepare('SELECT id FROM user WHERE token = ?');
    $result->bind_param('s', $token);
    $id = array();
    if ($result->execute()) {
        $result = $result->get_result();
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
        }
        return $id;
    }
}

function checkIfLoggedIn(){
	global $conn;
	if(isset($_SERVER['HTTP_TOKEN'])){
		$token = $_SERVER['HTTP_TOKEN'];
		$result = $conn->prepare("SELECT * FROM user WHERE token=?");
		$result->bind_param("s", $token);
		$result->execute();
		$result->store_result();
		$num_rows = $result->num_rows;
		if($num_rows > 0)
		{
			return true;
		} else{
			return false;
		}
	}
	else{
		return false;
	}
}

?>
