<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Photogram</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <style>
    body{
      background-image: url('images/photoss.jpg');
    }
    .w-right{
      float: left;
      margin-left: 255px;
    }
  </style>
</head>

<body>

  <div id="wrapper">

    <!-- <div class="w-left"><img src="images/celulares.png"></div> -->

    <div class="w-right">

      <?php
      if(isset($_GET['error'])) {
        echo "<center>Username or password is incorrect </center>";
      }
      ?>

      <?php
      if(isset($_POST['enter'])) {

        require("connection.php");

        $username = $mysqli->real_escape_string($_POST['username']);
        $password = md5($_POST['password']);

        $sql = "SELECT username,password,id FROM users WHERE username = '$username' AND password = '$password'";

        if($result = $mysqli->query($sql)) {
          while($row = $result->fetch_array()) {

            $name = $row['username'];
            $passw = $row['password'];
            $id = $row['id'];
          }
          $result->close();
        }
        $mysqli->close();


        if(isset($username) && isset($password)) {

          if($username == $name && $password == $passw) {

            session_start();
            $_SESSION['login'] = TRUE;
            $_SESSION['username'] = $name;
            $_SESSION['id'] = $id;
            header("Location: home.php");

          }

          else {

            Header("Location: index.php?error=login");

          }

        }


      }
      ?>

      <div class="main-content">
        <div class="header">
          <img src="images/logo.png">
        </div>
        <div class="l-part">
          <form action="" method="post">
            <input type="text" placeholder="username" class="input" name="username" autocomplete="off" />
            <div class="overlap-text">
              <input type="password" placeholder="password" class="input" name="password" />
              <a href="forgetpassword.php">Forget?</a>
            </div>
            <input type="submit" value="Enter" class="btn" name="enter" />
          </form>
        </div>
      </div>

      <div class="sub-content">
        <div class="s-part">
          Don't have an account? <a href="register.php">Register</a>
        </div>
      </div>

      <!-- <center><img src="images/appstores.png"></center> -->

    </div>

  </div>

</body>
</html>
<?php
ob_end_flush();
?>
