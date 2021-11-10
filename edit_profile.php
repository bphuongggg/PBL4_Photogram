<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Photogram</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>   
  </head>  
  <body>   

  	<?php

  		require "connection.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
  		$rowA = $sqlA->fetch_array();

  	?>

<?php include "header.php"; ?>

<div class="h-content">

	<div class="e-mid">

		<div class="e-left">
        <a href="edit_profile.php"><button class="button_edit">Edit profile</button></a>
			<a href="edit_pass.php"><button class="button_edit_on">Change Password</button></a> 
			<a href="edit_privacy.php"><button class="button_edit">Privacy & Security</button></a>
		</div>

		<form action="" method="post" enctype="multipart/form-data">

			<?php
			if(isset($_POST['edit'])) {
				require "connection.php";

				$name = $mysqli->real_escape_string($_POST['name']);
				$username = $mysqli->real_escape_string($_POST['username']);
				$story = $mysqli->real_escape_string($_POST['story']);
				$email = $mysqli->real_escape_string($_POST['email']);

				$sqlB = $mysqli->query("SELECT * FROM users WHERE username = '$username' AND id != '".$_SESSION['id']."'");
				$totalname = $sqlB->num_rows;

				$sqlC = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND id != '".$_SESSION['id']."'");
				$totalemail = $sqlC->num_rows;

				if($totalname > 0) {$existe = "Đã có người dùng có tên này";} 

				elseif ($totalemail > 0) {$existe2 = "Email đã được đăng ký ";} else  {

				$sqlE = $mysqli->query("UPDATE users SET name = '$name', username = '$username', story = '$story', email = '$email' WHERE id = '".$_SESSION['id']."'");

				if($sqlE) {header('Location: edit_profile.php');}

			}
			}
			if(isset($_POST['edit']))
			{
				require "connection.php";
				// $image =  $mysqli->real_escape_string($_POST['file-input']);
				// $sqlD = $mysqli->query("UPDATE users SET avatar = '$image' WHERE id = '".$_SESSION['id']."' ");
				//if($sqlD){header("refresh: 2; url = edit_profile.php");}

				$image = $_FILES['file-input']['name'];
				$file_tmp = $_FILES['file-input']['tmp_name'];
				$target = "images/".basename($image);
				move_uploaded_file($_FILES['file-input']['tmp_name'], $target);
				$sqlD = $mysqli->query("UPDATE users SET avatar = '$image' WHERE id = '".$_SESSION['id']."' ");

				
				
			}
			?>

		<div class="e-right">
			<div class="e-contenido">
				<div class="e-title"><img src="images/<?php echo $rowA['avatar']; ?>" width="60"></div>
				<div class="e-input"><?php echo $rowA['username']; ?><br><p>Thay đổi hình ảnh đại diện </p> </div>
				<input type="file" name="file-input">
			</div>
			<div class="e-contenido">
				<div class="e-title">name</div>
				<div class="e-input"><input type="text" name="name" value="<?php echo $rowA['name']; ?>" autocomplete="off">
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Username</div>
				<div class="e-input"><input type="text" name="username" value="<?php echo $rowA['username']; ?>" autocomplete="off">
					<br> <div style="color:red; font-size: 12px;"><?php if(isset($existe)) {echo $existe;} ?></div></div>
			</div>
			<div class="e-contenido">
				<div class="e-title">story</div>
				<div class="e-input"><input type="text" name="story" value="<?php echo $rowA['story']; ?>" autocomplete="off"></div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Email</div>
				<div class="e-input"><input type="text" name="email" value="<?php echo $rowA['email']; ?>" autocomplete="off">
					<br> <div style="color:red; font-size: 12px;"><?php if(isset($existe2)) {echo $existe2;} ?></div></div>
			</div>
			<div class="e-contenido">
				<div class="e-title">Sex</div>
				<div class="e-input">
					<select disabled="">
						<option value="">Unspecified</option>
						<option value="0">Male</option>
						<option value="1">Female</option>
					</select>
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title"></div>
				<div class="e-but">
					<input type="submit" value="edit" name="edit" class="button_blue" style="margin-left: 110px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
				</div>
			</div>

		</form>



		</div>

	</div>

</div>

  </body>  
</html>