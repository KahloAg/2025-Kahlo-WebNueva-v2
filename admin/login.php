<?php
$PAGE = 'admin-login';
include('../_general.php');
$username = '';
$password = '';
$message = '';

if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['password'])) $password = $_POST['password'];

if ($username !== '' && $password !== '') {
    if ($username === $admin_username && $password === $admin_password) {
        session_regenerate_id(true);
        $_SESSION['admin_user'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $message = '<p style="color:red">La información ingresada es incorrecta.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title>Kahlo Web 2.0 - Admin</title>
    <link rel="icon" type="image/jpeg" href="img/favicon.jpg">
    <link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link href="css/login.css" rel="stylesheet">
</head>
<body style="background: white;">
<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first">
      <img style="margin: 15px" src="../assets/img/kahlo.svg" id="icon" alt="Kahlo Web 2.0"/>
    </div>
    <form method="post" action="login.php">
      <input type="text" class="fadeIn second" id="username" name="username" placeholder="Username" required>
      <input type="password" class="fadeIn third" id="password" name="password" placeholder="Password" required>
      <?php echo $message ?>
      <input style="cursor: pointer;" type="submit" class="fadeIn fourth" value="Log In">
    </form>
  </div>
</div>
</body>
</html>
