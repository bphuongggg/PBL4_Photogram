<!DOCTYPE html>
<html lang="es">
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
		require "connection.php";

		$email = $mysqli->real_escape_string($_POST['email']);

		$sql = $mysqli->query("SELECT username,email FROM users WHERE email = '$email'");
		$row = $sql->fetch_array();
		$count = $sql->num_rows;

		if($count == 1) {

			$token = uniqid();

			$act = $mysqli->query("UPDATE users SET token = '$token' WHERE email = '$email'");

			
	        $email_to = $email;
	        $email_subject = "Thay đổi mật khẩu";
	        $email_from = "nguyenthibichphuong2601@gmail.com";

	        $email_message = "Xin chào " . $row['username'] . ",Bạn đã yêu cầu thay đổi mật khẩu của mình, hãy nhập liên kết sau\n\n";
	        $email_message .= "http://localhost:8080/myphotogram/photogram/newpassword.php?user=".$row['username']."&token=".$token."\n\n";

			
	        $headers = 'From: '.$email_from."\r\n".
	        'Reply-To: '.$email_from."\r\n" .
	        'X-Mailer: PHP/' . phpversion();
	        @mail($email_to, $email_subject, $email_message, $headers);

	        echo "Chúng tôi đã gửi cho bạn một email để thay đổi mật khẩu của bạn  ";

		} else {

			echo "Email này không được đăng ký";

		}
	}
	?>


  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="email" placeholder="Email" class="input" name="email" autocomplete="off" required />
        <input type="submit" value="Reset Password" class="btn" name="code" />
      </div>
    </form>
  </div>

</div>

</body>
</html>
