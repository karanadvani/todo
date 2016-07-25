<?php
require_once 'init.php';

if (isset($_GET['del'])) {
	$del = $_GET['del'];
	$item = $_GET['item'];

	switch ($del) {
		case 'yes':
			$doneQuery= $db->prepare("
				DELETE FROM users
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