<!DOCTYPE html>
<html lang="de">
<head>
    <title><?=$title?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/design.css'?>">
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/navigation.css'?>">
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/responsive.css'?>">
    <link rel="shortcut icon" type="image/png" href="<?=ROOTPATH.'assets/images/ailogo_groß.png'?>">
</head>
	<body>
        <?include __DIR__ . '/shared/navMenuBar.php'; ?>

			<?=$body?>

		<footer>
            <?include __DIR__ . '/shared/footer.php'; ?>
        </footer>
	</body>
</html>
