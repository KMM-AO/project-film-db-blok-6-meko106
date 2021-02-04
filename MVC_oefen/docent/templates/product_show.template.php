<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Product</title>
</head>

<body>

<h1>Product</h1>

<p>
<?= $product->getNaam() ?><br />
<?= $product->getStijl()->getNaam() ?><br />
<?= $product->getBrouwer()->getNaam() ?>
</p>


</body>
</html>