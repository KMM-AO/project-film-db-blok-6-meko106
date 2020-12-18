<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Product</title>
</head>

<body>

<?php require '../templates/includes/nav.template.php'; ?>

<h1>Product</h1>

<div class="message"><?= $_message ?? '' ?></div>

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

<?php if (!isset($_authuser)) : ?>

    <p>Je moet ingelogd zijn om dit product te kunnen raten...</p>

<?php else : ?>

    <form action="<?= $_webroot ?>product/rate/<?= $product->id ?>" method="POST">

        <?php for ($value = 1; $value <= 5; $value++) : ?>
    
            <input type="radio" name="value" value="<?= $value ?>" <?= $value == ($_authuser->getRatingByProduct($product->id)->value ?? 0) ? 'checked' : '' ?> /><?= $value ?>
    
        <?php endfor; ?>
    
        <input type="submit" value="Rate!" />
    
    </form>

<?php endif; ?>


</body>
</html>