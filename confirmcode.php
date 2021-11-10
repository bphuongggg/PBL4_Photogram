<?php
ob_start();
?>
<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] == FALSE) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Photogram</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

<?php include "header.php"; ?>

<div id="wrapper">

  <?php
  if(isset($_POST['code'])) {

    require("connection.php");

    $code = $mysqli->real_escape_string($_POST['code']);

    $sqlname = "SELECT code FROM users WHERE username = '".$_SESSION['username']."'";
    $resultname = $mysqli->query($sqlname);
    $row = $resultname->fetch_array();

    if($row['code'] == $code) {

      Header("Refresh: 2; URL=home.php");
      echo "Xin chúc mừng, bạn đã xác nhận email của mình";

      $sql = $mysqli->query("UPDATE users SET confirmed = '1' WHERE username = '".$_SESSION['username']."'");
    }

    else {

      echo "Mã nhập vào không chính xác";

      }

    $mysqli->close();

  }
  ?>

  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="text" placeholder="Enter the code" class="input" name="code" required />
        <input type="submit" value="Confirm Email" class="btn" name="submit" />
      </div>
    </form>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>
