<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Userlogin</title>
    
    <style>
        label, input {display: block;}
        input {margin-bottom: 20px; }
    </style>
</head>

<body>

<h1>Userlogin</h1>
<form action="../api/user/login" method="POST">
    <label for="email">E-mailadres:</label>
    <input type="text" name="email" id="email" />

    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password"/>
    
    <input type="submit" value="Login!"/>

</form>


</body>
</html>