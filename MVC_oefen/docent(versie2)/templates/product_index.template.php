<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Productenindex</title>
</head>

<body>

<h1>Productenindex</h1>

<ul>
<?php
    foreach ($producten as $product)
    {
?>
        <li>
            <a href="show/<?= $product->id ?>">
                <?= $product->naam ?>
            </a>
        </li>
<?php
    }
?>
</ul>

</body>
</html>