<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


  <form action='<?= $webroot.'user/register' ?>' method="POST">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Name</label>
      <input type="text" class="form-control" name='name' >
    </div>
    <?php session_start();  if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; }else{'';} unset($_SESSION['msg']) ?>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email address</label>
      <input type="text" class="form-control" name='email' placeholder="name@example.com">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Password*</label>
      <input type="text" class="form-control" name='password' >
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Repeat password</label>
      <input type="text" class="form-control" name='passwordRepeat'>
    </div>

    <input type="submit" value="Registreer!"/>
  </form>

    
</body>
</html>