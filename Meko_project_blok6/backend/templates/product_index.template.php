<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />
	<title>Productenindex</title>
</head>
<body>

<!-- <php require '../templates/includes/nav.template.php'; ?> -->
<h1>Productenindex</h1>
<div class="message"><?= $_message ?? '' ?></div>
<ul>
<?php foreach ($producten as $product){ ?>
<li>
<a href="<?= $_webroot ?>product/show/<?= $product->id ?>">
<?= $product->naam ?>
</a>
</li>
<?php } ?>
</ul>

</body>
</html>