<?php
require_once 'init.php';

if (isset($_GET['as'])) {
	$as = $_GET['as'];
	$item = $_GET['item'];

	switch ($as) {
		case 'done':
			$doneQuery= $db->prepare("
				UPDATE users
				SET done=1
				WHERE id= :item
				AND user= :user
				");

			$doneQuery->execute([
				'item' =>$item,
				'user' => $_SESSION['user_id']
				]);
			break;

		case 'notdone':
			$doneQuery= $db->prepare("
				UPDATE users
				SET done=0
				WHERE id= :item
				AND user= :user
				");

			$doneQuery->execute([
				'item' =>$item,
				'user' => $_SESSION['user_id']
				]);
			break;
	}

}

header ('Location:index.php');

?>