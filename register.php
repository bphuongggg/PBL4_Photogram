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
    #wrapper center{
      padding: 5px;
      background-color: lightblue;
      width: 50%;
      margin-left: 25%;
    }
    #wrapper p{
      padding: 5px;
      background-color: lightpink;
      width: auto;
    }
  </style>
</head>
 
<body>

<div id="wrapper">

  <?php
  if(isset($_POST['register'])) {

    require("connection.php");

    $email = $mysqli->real_escape_string($_POST['mail']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = md5($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $sql1 = "SELECT username FROM users WHERE username = '$username'";
    $sql2 = "SELECT email FROM users WHERE email = '$email'";

    if($resultname = $mysqli->query($sql1));
    $numname = $resultname->num_rows;

    if($resultemail = $mysqli->query($sql2));
    $numemail = $resultemail->num_rows;

    if($numemail>0) {
      echo "<center>Email này đã được đăng ký, hãy thử một email khác</center> ";
    }

    elseif($numname>0) {
      echo "<center>Tên người dùng này đã tồn tại</center> ";
    }

    else {

      $rand = uniqid();

      $query = "INSERT INTO users (email,name,username,password,signup_date,last_ip,code) VALUES ('$email','$name','$username','$password',now(),'$ip','$rand')";

      if($register = $mysqli->query($query)) {

        Header("Refresh: 2; URL=index.php");

        echo "<p>Xin chúc mừng $username đã được đăng ký thành công, chúng tôi đã gửi cho bạn một email xác nhận. <p>";

        
        $email_to = $email;
        $email_subject = "Confirm to email Photogram";
        $email_from = "nguyenthibichphuong2601@gmail.com";

        $email_message = "Xin chào " . $username . ", để sử dụng trang web của chúng tôi, bạn phải xác nhận email của mình \n\n";
        $email_message .= "Nhập mã sau để xác nhận email của bạn \n\n";
        $email_message .= "Code: " . $rand . "\n";


       
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);


      }

      else {

        echo "Đã xảy ra lỗi đăng kí, vui lòng thử lại";
        header("Refresh: 2; URL=register.php");

      }


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
        <input type="email" placeholder="Email" class="input" name="mail" required />
        <div class="overlap-text">
          <input type="text" placeholder="Name" class="input" name="name" required />
        </div>
        <div class="overlap-text">
          <input type="text" placeholder="Username" class="input" name="username" required />
        </div>
        <div class="overlap-text">
          <input type="password" placeholder="Password" class="input" name="password" required />
        </div>
        <input type="submit" value="Register" class="btn" name="register" />
      </div>
    </form>
  </div>
  <div class="sub-content">
    <div class="s-part">
      Do you have an account? <a href="index.php">Login</a>
    </div>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>