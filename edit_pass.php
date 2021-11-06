<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="en">  
  <head>    
    <title>Photogram</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  
  <body> 

<?php include "header.php"; ?>

<div class="h-content">

	<div class="e-mid">

		<div class="e-left">
			<a href="edit_profile.php"><button class="button_edit">Edit profile</button></a>
			<a href="edit_pass.php"><button class="button_edit_on">Change Password</button></a> 
			<a href="edit_privacy.php"><button class="button_edit">Privacy & Security</button></a>
		</div>

		<form action="" method="post">

			<?php 

				if(isset($_POST['edit'])) {
					require "connection.php";

					$passActual = $mysqli->real_escape_string($_POST['passActual']);
					$pass1 = $mysqli->real_escape_string($_POST['pass1']);
					$pass2 = $mysqli->real_escape_string($_POST['pass2']);

					$passActual = md5($passActual);
					$pass1 = md5($pass1);
					$pass2 = md5($pass2);

					$sqlA = $mysqli->query("SELECT password FROM users WHERE id = '".$_SESSION['id']."'");
					$rowA = $sqlA->fetch_array();

					if($rowA['password'] == $passActual) {

						if($pass1 == $pass2) {

							$update = $mysqli->query("UPDATE users SET password = '$pass1' WHERE id = '".$_SESSION['id']."'");
							if($update) {echo "your password has been updated ";}

						}
						else {
							echo "The two passwords do not match ";
						}

					}
					else {
						echo "Your current password does not match ";
					}
				}

			?>

		<div class="e-right">
			<div class="e-contenido">
				<div class="e-title">Mật khẩu hiện tại </div>
				<div class="e-input"><input type="password" name="passActual" autocomplete="off">
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Mật khẩu mới </div>
				<div class="e-input"><input type="password" name="pass1" autocomplete="off">
					<br> <div style="color:red; font-size: 12px;"><?php if(isset($existe)) {echo $existe;} ?></div></div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Nhập lại mật khẩu của bạn </div>
				<div class="e-input"><input type="password" name="pass2" autocomplete="off"></div>
			</div>
			<div class="e-contenido">
				<div class="e-title"></div>
				<div class="e-but">
					<input type="submit" value="Đổi mật khẩu " name="edit" class="button_blue" style="margin-left: 110px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
				</div>
			</div>

		</form>



		</div>

	</div>

</div>

  </body>  
</html>