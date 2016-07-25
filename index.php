<?php
require_once 'init.php';

$itemsQuery = $db->prepare("
	SELECT id, name, done, duedate
	FROM users
	WHERE user = :user
	");

$itemsQuery->execute([
	'user' => $_SESSION['user_id']
	]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


?>


<!DOCTYPE html>
<html>
<head>
	<title>To Do</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

	<div class="list">
	<h1 class="header">To Do.</h1>

	<?php if(!empty($items)): ?>
	<ul class="items">
		<?php foreach ($items as $item): ?>
		<li> 
			<span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?> </span>
			<?php if(!$item['done']): ?>			
				<a href="mark.php?as=done&item=<?php echo $item['id'];?>" class="done-button">Mark as Done </a>
			<?php endif; ?>
			<?php if($item['done']): ?>			
				<a href="delete.php?del=yes&item=<?php echo $item['id'];?>" class="done-button">Delete </a>
			<?php endif; ?>
		</li>
		<?php
		$dateFromDB=$item['duedate'];
		$newDate  = DateTime::createFromFormat("Y-m-d", $dateFromDB);
        $newDate  = $newDate ->format('dS M y');
        ?>
		<span class="duedate">Due On-<br><?php echo $newDate ;?></span>
		<?php endforeach; ?>
	</ul>

<?php else: ?>
	<p> You haven't added any items yet </p>
<?php endif; ?>

	<form class="item-add" action="add.php" method="post">
		<input type="text" name="name" class="input" placeholder="Tap to add a new item" autocomplete="off" required>
		<input type="date" name="cal" value="<?php echo $today=date("Y-m-d");?>" class="inputdd"  required>
		<input type="submit" class="submit" value="Add" name="submit">

	</form>
	</div>

</body>
</html>




 