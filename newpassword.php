<!DOCTYPE html>
<html lang="en">
<head>
  <title>Photogram</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

  <?php
  if(isset($_GET['user']) AND isset($_GET['token'])) {

    require "connection.php";

    $user = $mysqli->real_escape_string($_GET['user']);
    $token = $mysqli->real_escape_string($_GET['token']);

    $sql = $mysqli->query("SELECT token FROM users WHERE username = '$user'");
    $row = $sql->fetch_array();

    if($row['token'] ==  $token) {
  ?>

<div id="wrapper">

  <?php
  if(isset($_POST['code'])) {
    require "connection.php";

    $newpass = $mysqli->real_escape_string($_POST['newpass']);
    $newpass = md5($newpass);

    $act = $mysqli->query("UPDATE users SET password = '$newpass', token = '' WHERE username = '$user'");

    if($act) {
      echo "Mật khẩu của bạn đã được thay đổi, bây giờ bạn có thể đăng nhập ";
      Header("Refresh: 0; URL=index.php");
      }
  }
  ?>


  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="text" placeholder="Nhập mật khẩu mới của bạn " class="input" name="newpass" required />
        <input type="submit" value="Đổi mật khẩu" class="btn" name="code" />
      </div>
    </form>
  </div>

</div>

</body>
<?php } } ?>
</html>
