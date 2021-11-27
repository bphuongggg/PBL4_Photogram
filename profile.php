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
	<link href="css/image.css" rel="stylesheet" type="text/css"/>  
	<script src="js/imagehover.js"></script>
	
  </head>  
  <body>   

  	<?php

  	if(isset($_GET['username'])) {

  		require "connection.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
  		$rowA = $sqlA->fetch_array();

  		$sqlB = $mysqli->query("SELECT * FROM post WHERE user = '".$rowA['id']."' ORDER BY id DESC");
  		$totalp = $sqlB->num_rows;

  		$sqlC = $mysqli->query("SELECT * FROM followers WHERE follow = '".$rowA['id']."' AND approved = 1");
  		$totalS = $sqlC->num_rows;

  		$sqlD = $mysqli->query("SELECT * FROM followers WHERE follower = '".$rowA['id']."' AND approved = 1");
  		$totalSe = $sqlD->num_rows;

  		$yaExiste = $mysqli->query("SELECT * FROM followers WHERE follower = '".$_SESSION['id']."'");
		$rowT1 = $yaExiste->fetch_array();
  		$yaEnviaste = $yaExiste->num_rows;

  		$yaAprobo = $mysqli->query("SELECT * FROM followers WHERE follower = '".$_SESSION['id']."' AND follow  = '".$rowA['id']."' AND approved = 1");
		$rowT2 = $yaAprobo->fetch_array();
  		$tAprobo = $yaAprobo->num_rows;

		
  	?>
	
  	<?php 
  		if(isset($_GET['connect'])) {
  			require "connection.php";

  			if(!$yaEnviaste > 0) {echo "You have already sent a request to this user ";} else {

	  			if($rowA['private_profile'] == 1) {$approve = 0;} else {$approve = 1;}

	  			$sqlG = $mysqli->query("INSERT INTO followers (follower,follow,approved,time) VALUES ('".$_SESSION['id']."','".$rowA['id']."','$approve',now())");

	  			if($sqlG) {header("Location: profile.php?username=".$_GET['username']."");}
			  }
  		}
  	?>
		
	

<?php include "header.php"; ?>

<div class="h-content" style="width: 80%; height:auto;">
	
	<div class="p-top">
		<div class="p-foto"><img src="images/<?php echo $rowA['avatar'];?>" width="180" height="180"></div>
		<div class="p-name">
			<div class="p-user"><?php echo $rowA['username'];?></div>
			<?php if($rowA['verified'] == 1) { ?>
			<div class="p-user"><img src="images/verificado.png"></div>
			<?php } ?>
			<?php if($rowA['id'] == $_SESSION['id']) { ?>
			<div class="p-editar"><a href="edit_profile.php"><button class="button_white">Edit profile</button></a></div>		
			<div class="p-config"><img src="images/icons/opciones.png"></div>
			<?php } else { ?>

					
						<?php if($tAprobo > 0) { ?>
						<form method="POST" action="unfollow.php?delid=<?php echo $rowT2['id']; ?>&user=<?php echo $rowA['username'];?>">
						<div class="p-editar"><button class="button_blue" onclick="deleteme(<?php echo $rowT2['id']; ?>)">UnFollow</button></div>
						<script>
							function deleteme(delid){
								if(confirm("Do you want UnFollow?")){
									window.location.href='unfollow.php?delid='+ delid+'&user=<?php echo $rowA['username'];?>';
									return true;
								}
							}
						</script>
						</form>
				<?php }  else { ?>
					<a href="?connect=connect&username=<?php echo $_GET['username']; ?>"><div class="p-editar"><button class="button_blue">Follow</button></div></a>
					
					<?php } ?>
	

			<?php } ?>
					
		</div>
		<div class="p-info">
			<div class="p-infor"><b><?php echo $totalp; ?></b> post</div>
			<div class="p-infor"><b><?php echo $totalS; ?></b> followers</div>
			<div class="p-infor"><b><?php echo $totalSe; ?></b> following</div>
		</div>
		<div class="p-nombre"><?php echo $rowA['name'];?></div>
		<div class="p-location">Danang, VietNam</div>
		<div class="p-description"><?php echo $rowA['story'];?></div>
	</div>
	<form action="delimage.php" method="POST">
	<div class="p-mid">

		<?php 
			if($rowA['private_profile'] == 1 AND $rowA['id'] != $_SESSION['id'] AND $tAprobo == 0)
				{echo "If you want to see their photos or videos follow this user";}
			else {
		?>

		<?php
		while($rowC = $sqlB->fetch_array()) {
			$sqlD = $mysqli->query("SELECT * FROM portdetail WHERE post = '".$rowC['id']."'");
			$rowD = $sqlD->fetch_array();
			// $sqlL = $mysqli->query("SELECT * FROM portdetail WHERE post = '".$_GET['id']."'");
			
  			
		?>
		<?php
			$showProfile = getProfile($rowA['username']);
			if(!empty($showProfile) ):
				foreach ($showProfile as $pro):
				if(isset($_SESSION['username'])){
					if($_SESSION['username'] == $pro['username']): ?>
					<figure class="snip1573" <?php echo $rowD['filter']; ?>>
						<img src="postdetail/<?php echo $rowD['img']; ?>" width="300px", height="300px" />
							<figcaption>
								<h3>Delete image</h3>
							</figcaption>
							<a href="delimage.php?id=<?php echo $rowD['id']; ?>"></a>
							
					</figure>
				<?php endif; ?>

		<?php } endforeach; endif ?>

		<?php
			$showProfile = getProfile($rowA['username']);
			if(!empty($showProfile) ):
				foreach ($showProfile as $pro):
				if(isset($_SESSION['username'])){
					if($_SESSION['username'] != $pro['username']): ?>
					
						<div class="p-pub"><?php echo $rowD['filter']; ?><img src="postdetail/<?php echo $rowD['img']; ?>" width="300px", height="300px" /></div>
		
					<?php endif; ?>

		<?php } endforeach; endif ?>

		<?php } ?>

		<?php } ?>

	</div>
	</form>	
</div>


<?php } ?>

  </body>  
</html>