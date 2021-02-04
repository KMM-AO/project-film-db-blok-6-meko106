<nav>
    <div>
        <?php if (isset($_authuser)) :  //????? ?> 
            Ingelogd als <?= $_authuser->name ?>
        <?php else : ?>
            Niet ingelogd
        <?php endif; ?>
    </div>
    <ul>
        <li><a href="<?= $_webroot ?>product/index">producten-index</a></li>
        <?php if (isset($_authuser)) : ?>
            <li>
                <form action="<?= $_webroot ?>user/logout" method="POST">
                    <input type="submit" value="uitloggen" />
                </form>
            </li>
        <?php else : ?>
            <li><a href="<?= $_webroot ?>user/login">inloggen</a></li>
            <li><a href="<?= $webroot ?>user/registerForm">registreren</a></li>
        <?php endif; ?>
    </ul>
</nav>