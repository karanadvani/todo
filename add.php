<?php
require_once 'init.php';

if(isset($_POST['name'])){
	if(isset($_POST['cal'])){

	$name = trim($_POST['name']);
	$cal = trim($_POST['cal']);

	if (!empty($name)) {
		$addedQuery = $db->prepare("
			INSERT INTO users (name, user, done, duedate) 
			VALUES (:name, :user, 0, '$cal')
			");

		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id'] 
			]);
		}
	}
}

header('Location: index.php');

?>