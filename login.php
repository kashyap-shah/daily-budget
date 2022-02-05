<?php
session_start();
if (session_id() == '' || !isset($_SESSION['username'])) {
  $username = 'Kashyap Shah';
  $password = 'Password@123';

  if (isset($_POST['submit']) && isset($_POST['pswd']))
  {
    if ($_POST['txtUserName'] === $username && $_POST['pswd'] === $password)
    {
      $_SESSION['username'] = $_POST['txtUserName']; 
      header('Location:index.php');
    }
    else
    {
      echo "<script>alert('Wrong User Name or Password');</script>";
      echo "<noscript>Wrong username or password</noscript>";
    }
  }?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <title>Admin Login</title>

      <!-- icon -->
      <link rel="icon" href="images/logo.png" type="image/x-icon">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container mt-2 text-center border rounded border-2 border-dark">
      <h2>Admin Login</h2><hr>
      <div class="d-flex justify-content-center mb-2">
        <form name="frmLogin" onsubmit="return validate('frmLogin')" id="frmLogin" method="post">
            User Name: <input type="text" name="txtUserName" id="txtUserName"></br></br>
            Password: <input type="password" name="pswd" id="pswd"></br></br>
            <input type="submit" name="submit" value="Login" class="btn btn-success">
        </form>
      </div>
    </div>
  </body>
  </html>  
<?php 
}else{
  header('Location:index.php');
}?>