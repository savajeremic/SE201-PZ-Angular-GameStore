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

function tokenToCart($token)
{
  $token = str_replace('"', "", $token);
  $user_id = tokenToId($token);
  global $conn;
  $query = 'SELECT cart.id
    FROM cart
    WHERE cart.user_id = ?';
  $result = $conn->prepare($query);
  $result->bind_param('i', $user_id);
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

function checkIfUserExists($username){
	global $conn;
	$result = $conn->prepare("SELECT * FROM user WHERE username=?");
	$result->bind_param("s",$username);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}

function checkGameInCart($game_id, $cart_id){
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM cart_items WHERE game_id=? AND cart_id =?");
	$stmt->bind_param("ii", $game_id, $cart_id);
	$stmt->execute();
	$stmt->store_result();
	$num_rows = $stmt->num_rows;
	echo $num_rows;
	if($num_rows > 0)
	{
		return false;
	}
	else{
		return true;
	}
}

function checkIfOwned($game_id, $cart_id){
	$isOwned = 2;
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM cart_items WHERE game_id=? AND cart_id =? AND flag_id=?");
	$stmt->bind_param("iii", $game_id, $cart_id, $isOwned);
	$stmt->execute();
	$stmt->store_result();
	$num_rows = $stmt->num_rows;
	echo $num_rows;
	if($num_rows > 0)
	{
		return false;
	}
	else{
		return true;
	}
}

function checkIfCartExists($user_id){
	global $conn;
	$result = $conn->prepare("SELECT * FROM cart WHERE user_id=?");
	$result->bind_param("i",$user_id);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}

function createCart($token){
  $user_id = tokenToId($token);
  global $conn;
  $message = array();
  $query = 'INSERT INTO cart (user_id) VALUES (?)';
  $statement = $conn->prepare($query);
  $statement->bind_param("i", $user_id);
  if ($statement->execute()) {
    $message="Successfully created cart!";
  } else {
    $message="Failed to create cart!";
  }
  return json_encode($message);
}

function addToCart($game_id, $token){
	$cart_id = tokenToCart($token);
	global $conn;
	$rarray = array();
	if(checkGameInCart($game_id, $cart_id)){
		$stmt = $conn->prepare("INSERT INTO cart_items (game_id, cart_id) VALUES (?,?)");
		$stmt->bind_param("ii", $game_id, $cart_id);
		if ($stmt->execute()) {
			$rarray['success'] = 'You have successfully added the game.';
		} else {
			$rarray['error'] = 'Error!';
		}
		return json_encode($rarray);
	} else{
		$rarray['error'] = 'Game in users product already exists';
	}
}

function removeFromCart($game_id, $token){
	$cart_id = tokenToCart($token);
  global $conn;
  $rarray = array();
  $query = 'DELETE
    FROM cart_items
    WHERE cart_items.game_id = ? AND cart_items.cart_id = ? AND cart_items.flag_id=1';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $game_id, $cart_id);
  $stmt->execute();
  if ($stmt->execute()) {
      $rarray['success'] = 'Successfully removed from cart';
  } else {
      $rarray['error'];
  }
  return json_encode($rarray);
}

function removeFromWishlist($game_id, $token){
	$cart_id = tokenToCart($token);
  global $conn;
  $rarray = array();
  $query = 'DELETE
    FROM cart_items
    WHERE cart_items.game_id = ? AND cart_items.cart_id = ? AND cart_items.flag_id=3';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $game_id, $cart_id);
  $stmt->execute();
  if ($stmt->execute()) {
      $rarray['success'] = 'Successfully removed from wishlist';
  } else {
      $rarray['error'];
  }
  return json_encode($rarray);
}

function getCart($token){
	$id = tokenToId($token);
	$inCart = 1;
	global $conn;
	$query = 'SELECT game.id, game.name, game.price, game.cover
	FROM game
	JOIN cart_items ON cart_items.game_id = game.id
	JOIN cart on cart.id = cart_items.cart_id
	WHERE cart_items.cart_id = ? AND cart_items.flag_id = ?';
	$cart = array();
	if($stmt = $conn->prepare($query))
	{
		$stmt->bind_param('ii', $id, $inCart);
		$stmt->execute();
    $result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$one_cart = array();
			$one_cart['id'] = $row['id'];
			$one_cart['name'] = $row['name'];
			$one_cart['price'] = $row['price'];
			$one_cart['cover'] = $row['cover'];
			array_push($cart, $one_cart);
		}
	}
	$message['cart'] = $cart;
	return json_encode($cart);
}

function getWishlist($token){
	$id = tokenToId($token);
	$inWishlist = 3;
	global $conn;
	$query = 'SELECT game.id, game.name, game.price, game.cover
	FROM game
	JOIN cart_items ON cart_items.game_id = game.id
	JOIN cart on cart.id = cart_items.cart_id
	WHERE cart_items.cart_id = ? AND cart_items.flag_id = ?';
	$cart = array();
	if($stmt = $conn->prepare($query))
	{
		$stmt->bind_param('ii', $id, $inWishlist);
		$stmt->execute();
    $result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$one_cart = array();
			$one_cart['id'] = $row['id'];
			$one_cart['name'] = $row['name'];
			$one_cart['price'] = $row['price'];
			$one_cart['cover'] = $row['cover'];
			array_push($cart, $one_cart);
		}
	}
	$message['cart'] = $cart;
	return json_encode($cart);
}

function addToWishlist($game_id, $token){
	$cart_id = tokenToCart($token);
	$inWishlist = 3;
	global $conn;
	$rarray = array();
	if(checkIfOwned($game_id, $cart_id)){
		$stmt = $conn->prepare("INSERT INTO cart_items (game_id, cart_id, flag_id) VALUES (?,?,?)");
		$stmt->bind_param("iii", $game_id, $cart_id, $inWishlist);
		if ($stmt->execute()) {
			$rarray['success'] = 'You have successfully added the game.';
		} else {
			$rarray['error'] = 'Error!';
		}
		return json_encode($rarray);
	} else{
		$rarray['error'] = 'Game in users product already exists';
	}
}

function checkout($token)
{
  $id = tokenToCart($token);
  global $conn;
  $message = array();
  $query = 'UPDATE cart_items
            SET flag_id = 2
            WHERE cart_items.flag_id = 1 AND cart_items.cart_id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
      $message['success'] = "Successfully bought games!";
  } else {
      $message['error'];
  }
  return json_encode($message);
}

function getUserGames($token)
{
	$id = tokenToCart($token);
	$owned = 2;
	global $conn;
	$query = 'SELECT game.name, game.cover, game.price
		FROM game
		JOIN cart_items ON cart_items.game_id = game.id
		WHERE cart_items.cart_id = ? AND cart_items.flag_id = ?';
	$games = array();
	if($stmt = $conn->prepare($query))
	{
		$stmt->bind_param('ii', $id, $owned);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$game = array();
			$game['name'] = $row['name'];
			$game['cover'] = $row['cover'];
			$game['price'] = $row['price'];
			array_push($games, $game);
		}
	}
	$message['games'] = $games;
	return json_encode($games);
}

function login($username, $password){
	global $conn;
	$rarray = array();
	if(checkLogin($username, $password)){
		$token = sha1(uniqid());
		$result2 = $conn->prepare("UPDATE user SET token=? WHERE username=?");
		$result2->bind_param("ss", $token, $username);
		$result2->execute();
		$rarray['token'] = $token;
		$rarray['user'] = $username;
	} else{
		$rarray = "Invalid username/password";
		header('HTTP/1.1 401 Unauthorized');
	}
	return json_encode($rarray);
}

function checkLogin($username, $password){
	global $conn;
	$errors = "";
	$password = md5($password);
	$result = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");
	$result->bind_param("ss", $username, $password);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}


function register($username, $password, $email){ /*, $name, $surname, $avatar, $birth_date, $country*/
	global $conn;
	$errors = "";
	$rarray = array();
	if(checkIfUserExists($username)){
		$errors .= "Username already exists\r\n";
	}
	if($errors == ""){
		$stmt = $conn->prepare("INSERT INTO user (username, password, email, type_id) VALUES (?,?,?,?)"); /* name, surname, avatar, birth_date, country,*/
		$password = md5($password);
		$type_id = 1;
		$stmt->bind_param("sssi", $username, $password, $email, $type_id); /*$name, $surname, $avatar, $birth_date, $country,*/
		if($stmt->execute()){
			$token = sha1(uniqid());
			$result2 = $conn->prepare("UPDATE user SET token=? WHERE username=?");
			$result2->bind_param("ss", $token, $username);
			$result2->execute();
			$rarray['token'] = $token;
			createCart($token);
		}else{
			header('HTTP/1.1 400 Bad request');
			$rarray['error'] = "Database connection error";
		}
	} else{
		header('HTTP/1.1 400 Bad request');
		$rarray['error'] = json_encode($errors);
	}
	return json_encode($rarray);
}

function addGame($name, $description, $votes, $cover, $version, $rating, $release_date, $size, $price){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO game (name, description, votes, cover, version, rating, release_date, size, price)
	VALUES (?,?,?,?,?,?,?,?,?);");
	$stmt->bind_param("ssssssssi", $name, $description, $votes, $cover, $version, $rating, $release_date, $size, $price);
	if($stmt->execute()){
		$rarray['success'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
	return json_encode($rarray);
}

function getAddGames(){
	global $conn;
	$rarray = array();
	$result = $conn->query("SELECT id, name FROM game");
	$num_rows = $result->num_rows;
	$games = array();
	if($num_rows > 0)
	{
		$result2 = $conn->query("SELECT id, name FROM game");
		while($row = $result2->fetch_assoc()) {
			$game = array();
			$game['id'] = $row['id'];
			$game['name'] = $row['name'];
			array_push($games, $game);
		}
	}
	$rarray['games'] = $games;
	return json_encode($rarray);
}

function addGameCompany($game_id, $company_id){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO game_company (game_id, company_id) VALUES(?, ?);");
	$stmt->bind_param("ii", $game_id, $company_id);
	if($stmt->execute()){
		$rarray['success'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
}

function addGameGenre($game_id, $genre_id){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO game_genre (game_id, genre_id) VALUES(?, ?);");
	$stmt->bind_param("ii", $game_id, $genre_id);
	if($stmt->execute()){
		$rarray['success'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
}

function addGameLanguage($game_id, $language_id){
	global $conn;
	$rarray = array();
	$pieces = explode(', ', $language_id);
	foreach($pieces as $piece){
		$stmt = $conn->prepare("INSERT INTO game_language (game_id, language_id) VALUES(?, ?);");
		$stmt->bind_param("ii", $game_id, $piece);
	}
	if($stmt->execute()){
		$rarray['success'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
}

function getFlags($token){
	$id = tokenToId($token);
	global $conn;
	$query = "SELECT cart.flag_id, cart.game_id
	FROM cart
	WHERE cart.user_id = ?";
	$flags = array();
	if($stmt = $conn->prepare($query))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$flag = array();
			$flag['flag_id'] = $row['flag_id'];
			$flag['game_id'] = $row['game_id'];
			array_push($games, $flags);
		}
	}
	$message['flags'] = $flags;
	return json_encode($flags);
}

function getGames(){
	global $conn;
	$rarray = array();
	$query = "SELECT game.id, game.name, GROUP_CONCAT(DISTINCT company.name ORDER BY company.name ASC SEPARATOR ', ') as company_name,
	GROUP_CONCAT(DISTINCT genre.name ORDER BY genre.name ASC SEPARATOR ', ') AS game_genre,
	GROUP_CONCAT(DISTINCT language.name ORDER BY language.name ASC SEPARATOR ', ') AS language_name,
	description, votes, cover, version, rating, release_date, size, price, cart_items.flag_id
	FROM game

	JOIN game_company ON game_company.game_id = game.id
	JOIN company ON company.id = game_company.company_id
	JOIN game_genre ON game_genre.game_id = game.id
	JOIN genre ON genre.id = game_genre.genre_id
	JOIN game_language ON game_language.game_id = game.id
	JOIN language ON language.id = game_language.language_id
  LEFT JOIN cart_items on cart_items.game_id = game.id
	LEFT JOIN user on user.id = cart_items.cart_id

	GROUP BY game.id";
	$games = array();
	$stmt = $conn->prepare($query);
	if($stmt->execute())
	{
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
			$game = array();
			$game['id'] = $row['id'];
			$game['name'] = $row['name'];
			$game['company_name'] = $row['company_name'];
			$game['game_genre'] = $row['game_genre'];
			$game['language_name'] = $row['language_name'];
			$game['description'] = $row['description'];
			$game['votes'] = $row['votes'];
			$game['cover'] = $row['cover'];
			$game['version'] = $row['version'];
			$game['rating'] = $row['rating'];
			$game['release_date'] = $row['release_date'];
			$game['size'] = $row['size'];
			$game['price'] = $row['price'];
			$game['flag_id'] = $row['flag_id'];
			array_push($games, $game);
		}
	}
	$rarray['games'] = $games;
	return json_encode($rarray);
}

function getGame($id){
	global $conn;
	$rarray = array();
	$query = "SELECT game.id, game.name, GROUP_CONCAT(DISTINCT company.name ORDER BY company.name ASC SEPARATOR ', ') as company_name,
	GROUP_CONCAT(DISTINCT genre.name ORDER BY genre.name ASC SEPARATOR ', ') AS game_genre,
	GROUP_CONCAT(DISTINCT language.name ORDER BY language.name ASC SEPARATOR ', ') AS language_name,
	description, votes, cover, version, rating, release_date	, size, price, cart_items.flag_id
	FROM game

	JOIN game_company ON game_company.game_id = game.id
	JOIN company ON company.id = game_company.company_id
	JOIN game_genre ON game_genre.game_id = game.id
	JOIN genre ON genre.id = game_genre.genre_id
	JOIN game_language ON game_language.game_id = game.id
	JOIN language ON language.id = game_language.language_id
	LEFT JOIN cart_items on cart_items.game_id = game.id
	LEFT JOIN user on user.id = cart_items.cart_id

	WHERE game.id =".$id;

	$games = array();
	$stmt = $conn->prepare($query);
	if($stmt->execute())
	{
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
			$game = array();
			$game['id'] = $row['id'];
			$game['name'] = $row['name'];
			$game['company_name'] = $row['company_name'];
			$game['game_genre'] = $row['game_genre'];
			$game['language_name'] = $row['language_name'];
			$game['description'] = $row['description'];
			$game['votes'] = $row['votes'];
			$game['cover'] = $row['cover'];
			$game['version'] = $row['version'];
			$game['rating'] = $row['rating'];
			$game['release_date'] = $row['release_date'];
			$game['size'] = $row['size'];
			$game['price'] = $row['price'];
			$game['flag_id'] = $row['flag_id'];
			$games = $game;
		}
	}
	$rarray['game'] = $games;
	return json_encode($rarray);
}

function getGenreGames($id){
	global $conn;
	$rarray = array();
	$query =
		"SELECT game.id, game.name, GROUP_CONCAT(DISTINCT company.name ORDER BY company.name ASC SEPARATOR ', ') as company_name,
		GROUP_CONCAT(DISTINCT genre.name ORDER BY genre.name ASC SEPARATOR ', ') AS game_genre,
		GROUP_CONCAT(DISTINCT language.name ORDER BY language.name ASC SEPARATOR ', ') AS language_name,
		description, votes, cover, version, rating, release_date, size, price, cart_items.flag_id
		FROM game

		JOIN game_company ON game_company.game_id = game.id
		JOIN company ON company.id = game_company.company_id
		JOIN game_genre ON game_genre.game_id = game.id
		JOIN genre ON genre.id = game_genre.genre_id
		JOIN game_language ON game_language.game_id = game.id
		JOIN language ON language.id = game_language.language_id
		LEFT JOIN cart_items on cart_items.game_id = game.id
		LEFT JOIN user on user.id = cart_items.cart_id

		WHERE game_genre.genre_id =".$id."
		GROUP BY game.id";
	$games = array();
	$stmt = $conn->prepare($query);
	if($stmt->execute())
	{
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
			$game = array();
			$game['id'] = $row['id'];
			$game['name'] = $row['name'];
			$game['company_name'] = $row['company_name'];
			$game['game_genre'] = $row['game_genre'];
			$game['language_name'] = $row['language_name'];
			$game['description'] = $row['description'];
			$game['votes'] = $row['votes'];
			$game['cover'] = $row['cover'];
			$game['version'] = $row['version'];
			$game['rating'] = $row['rating'];
			$game['release_date'] = $row['release_date'];
			$game['size'] = $row['size'];
			$game['price'] = $row['price'];
			$game['flag_id'] = $row['flag_id'];
			array_push($games, $game);
		}
	}
	$rarray['games'] = $games;
	return json_encode($rarray);
}

function updateProfile($token, $name, $surname, $avatar, $birth_date, $country){
	$token = str_replace('"', "", $token);
  $user_id = tokenToId($token);
  global $conn;
  $message = array();
  $query = "UPDATE user
    SET user.name = ?, user.surname = ?, user.avatar = ?, user.birth_date =? , user.country = ?
    WHERE user.id = ?";
  $statement = $conn->prepare($query);
  $statement->bind_param("sssssi", $name, $surname, $avatar, $birth_date, $country ,$user_id);
  if ($statement->execute()) {
      $message="Successfully changed profile!";
  } else {
      $message="Error!";
  }
  return json_encode($message);
}

function getProfile($token){
	global $conn;
	$id = tokenToId($token);
	$rarray = array();
	$query = "SELECT username, email, name, surname, avatar, birth_date, country, type_id,
		(SELECT name FROM type WHERE type.id = user.type_id) as type_name
		FROM user
		WHERE user.id=".$id;
	$profile = array();
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
			$one_profile = array();
			$one_profile['username'] = $row['username'];
			$one_profile['email'] = $row['email'];
			$one_profile['name'] = $row['name'];
			$one_profile['surname'] = $row['surname'];
			$one_profile['avatar'] = $row['avatar'];
			$one_profile['birth_date'] = $row['birth_date'];
			$one_profile['country'] = $row['country'];
			$one_profile['type_id'] = $row['type_id'];
			$one_profile['type_name'] = $row['type_name'];
			$profile = $one_profile;
		}
	}
	$rarray['profile'] = $profile;
	return json_encode($profile);
}

function editGame($gameName, $gamePegi, $id){
    global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
		$stmt = $conn->prepare("UPDATE game SET gameName=?, gamePegi=? WHERE id=?");
		$stmt->bind_param("ssi", $gameName, $gamePegi, $id);
        if($stmt->execute()){
            $rarray['success'] = "ok";
        }else{
            $rarray['error'] = "Database connection error";
        }
    } else{
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}

function getGenres(){
	global $conn;
	$rarray = array();
	$result = $conn->query("SELECT * FROM genre");
	$num_rows = $result->num_rows;
	$genres = array();
	if($num_rows > 0)
	{
		$result2 = $conn->query("SELECT * FROM genre");
		while($row = $result2->fetch_assoc()) {
			$one_genre = array();
			$one_genre['id'] = $row['id'];
			$one_genre['name'] = $row['name'];
			array_push($genres,$one_genre);
		}
	}
	$rarray['genres'] = $genres;
	return json_encode($rarray);
}

function getCompanies(){
	global $conn;
	$rarray = array();
	$result = $conn->query("SELECT * FROM company");
	$num_rows = $result->num_rows;
	$companies = array();
	if($num_rows > 0)
	{
		$result2 = $conn->query("SELECT * FROM company");
		while($row = $result2->fetch_assoc()) {
			$one_company = array();
			$one_company['id'] = $row['id'];
			$one_company['name'] = $row['name'];
			array_push($companies,$one_company);
		}
	}
	$rarray['companies'] = $companies;
	return json_encode($rarray);
}

function getLanguages(){
	global $conn;
	$rarray = array();
	$result = $conn->query("SELECT * FROM language");
	$num_rows = $result->num_rows;
	$languages = array();
	if($num_rows > 0)
	{
		$result2 = $conn->query("SELECT * FROM language");
		while($row = $result2->fetch_assoc()) {
			$one_language = array();
			$one_language['id'] = $row['id'];
			$one_language['name'] = $row['name'];
			array_push($languages,$one_language);
		}
	}
	$rarray['languages'] = $languages;
	return json_encode($rarray);
}

function deleteGameGenre($id){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->prepare("DELETE FROM gamegenre WHERE id=?");
		$result->bind_param("i",$id);
		$result->execute();
		$rarray['success'] = "Deleted successfully";
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
	}
	return json_encode($rarray);
}

?>
