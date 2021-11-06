<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<?php
	require "connection.php";

	$sqlA = $mysqli->query("SELECT private_profile FROM users WHERE id = '".$_SESSION['id']."'");
	$rowA = $sqlA->fetch_array();
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

					$privacy = $mysqli->real_escape_string($_POST['privacy']);

					if($privacy == "on") {$pri = 1;} else {$pri = 0;}

					$update = $mysqli->query("UPDATE users SET private_profile = '$pri' WHERE id = '".$_SESSION['id']."'");
					if($update) {header("Location: edit_privacy.php");}
				}
			?>

		<div class="e-right">
			<div class="e-contenido">
				<div class="e-title">Profile privacy?</div>
				<?php
					if($rowA['private_profile'] == 1) {$act = "checked";} else {$act = "";}
				?>
				<div class="e-input"><input type="checkbox" name="privacy" <?php echo $act; ?>>
				</div>
			</div>
			<div class="e-contenido">
				<div class="e-title"></div>
				<div class="e-but">
					<input type="submit" value="edit" name="edit" class="button_blue" style="margin-left: 230px; margin-bottom: 30px; color: white; font-size: 16px; padding:6px 9px;font-weight: 600;">
				</div>
			</div>

		</form>



		</div>

	</div>

</div>

  </body>  
</html>