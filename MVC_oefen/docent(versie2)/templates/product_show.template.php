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
    <strong>Naam:</strong>      <?= $product->naam ?><br />
    <strong>Stijl:</strong>     <?= $product->getStijl()->naam ?? '<em>geen</em>' ?><br />
    <strong>Brouwer:</strong>   <?= $product->getBrouwer()->naam ?? '<em>geen</em>' ?><br />
    <strong>Smaken:</strong>
    <?php
        if (count($product->getSmaken()) == 0) :
            echo '<em>geen</em>';
        else :
            $eerste = true;
            foreach($product->getSmaken() as $smaak) :
                if (!$eerste):
                    echo ', ';
                else :
                    $eerste = false;
                endif;
                echo $smaak->naam;
            endforeach;
        endif;
    ?>

</p>

<p>
    <a href="../index">naar de index</a>
</p>

</body>
</html>