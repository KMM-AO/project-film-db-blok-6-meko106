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
        input {margin-bottom: 20px; }
    </style>
</head>

<body>

<h1>Userregistratie</h1>

<form action="../api/user/register" method="POST">

    <label for="name">Naam:</label>
    <input type="text" name="name" id="name"/>
    
    <label for="email">E-mailadres:</label>
    <input type="text" name="email" id="email" />
    
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password"/>
    
    <label for="password_repeat">Wachtwoord (herhaal):</label>
    <input type="password" name="password_repeat" id="password_repeat"/>
    
    <input type="submit" value="Registreer!"/>

</form>


</body>
</html>