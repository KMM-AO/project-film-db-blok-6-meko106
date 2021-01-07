<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Userlogin</title>
    
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

<h1>Userlogin</h1>

<div class="message"><?= $_message ?? '' ?></div>

<form action="<?= $_webroot . $action ?>" method="POST">
    
    <label for="email">E-mailadres: <span class="error"><?= $errors['email'] ?? '' ?></span></label>
    <input type="text" name="email" id="email" value="<?= $post['email'] ?? '' ?>" />
    
    <label for="password">Wachtwoord: <span class="error"><?= $errors['password'] ?? '' ?></span></label>
    <input type="password" name="password" id="password"/>
    
    <input type="submit" value="Login!"/>

</form>


</body>
</html>