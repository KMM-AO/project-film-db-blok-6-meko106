<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Userregistratie</title>
    
    <style>
        label, input {
            display: block;
        }
        input {
            margin-bottom: 20px; 
        }
        .message {
            color: blue;
        }
        .error {
            color: red;
        }
    </style>
</head>

<body>

<h1>Userregistratie</h1>

<div class="message"><?= $_message ?? '' ?></div>

<form action="<?= $_webroot . $action ?>" method="POST">

    <label for="name">Naam: <span class="error"><?= $errors['name'] ?? '' ?></span></label>
    <input type="text" name="name" id="name" value="<?= $post['name'] ?? '' ?>"/>
    
    <label for="email">E-mailadres: <span class="error"><?= $errors['email'] ?? '' ?></span></label>
    <input type="text" name="email" id="email" value="<?= $post['email'] ?? '' ?>" />
    
    <label for="password">Wachtwoord: <span class="error"><?= $errors['password'] ?? '' ?></span></label>
    <input type="password" name="password" id="password" value=""/>
    
    <label for="password_repeat">Wachtwoord (herhaal): <span class="error"><?= $errors['password_repeat'] ?? '' ?></span></label>
    <input type="password" name="password_repeat" id="password_repeat"/>

    <input type="submit" value="Registreer!"/>
    
</form>


</body>
</html>