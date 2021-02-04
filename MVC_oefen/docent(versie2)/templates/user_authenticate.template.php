<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />

	<title>Userauthenticatie</title>
    
    <style>
        label, input {
            display: block;
        }
        input {
            margin-bottom: 20px; 
        }
    </style>
</head>

<body>

<h1>Userauthenticatie</h1>

<form action="../api/user/authenticate" method="POST">
    
    <label for="token">Token:</label>
    <input type="text" name="token" id="token" />
    
    <input type="submit" value="Authenticate!"/>

</form>


</body>
</html>