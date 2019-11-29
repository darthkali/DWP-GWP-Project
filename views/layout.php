<!DOCTYPE html>
<html>
	<head>
		<title><?=$title?> | Project 01</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php if(isset($smallHeader)) : ?>
			<?php include __DIR__.'/shared/_headerSmall.php'; ?>
		<?php else : ?>
			<?php include __DIR__.'/shared/_headerBig.php'; ?>
		<?php endif; ?>
		<main>
			<?=$body?>
		</main>
		<footer></footer>
	</body>
</html>