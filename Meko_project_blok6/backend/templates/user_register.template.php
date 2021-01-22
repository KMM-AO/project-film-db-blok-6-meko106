<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Jeroen van den Brink" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
	<title>Userregistratie</title>
    
    <style>
    span{
        color:red;
    }
    </style>
</head>

<body>

<h1>Userregistratie</h1>

<div class="message"><?= $_message ?? '' ?></div>

<form action="<?php use core\Router; echo Router::getInstance()->getWebroot().'user/register' ?>" method="POST">

<div class="col-md-3">
    <label for="name" class="form-label">Name  <span></span></label>
    <input type="text" class="form-control" name="name">
  </div>

  <div class="col-md-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" name="email">
  </div>

  <div class="col-md-2">
    <label for="pass" class="form-label">Password</label>
    <input type="text" class="form-control" name="pass">
  </div>

  <div class="col-md-2">
    <label for="rpass" class="form-label">Password</label>
    <input type="text" class="form-control" name="rpass">
  </div>


  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
  
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>
</html>