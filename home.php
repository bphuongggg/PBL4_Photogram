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
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/likes.js"></script>
    <script src="js/favorite.js"></script>
  </head>  
  <body>   

<?php
require("connection.php");

$sql1 = "SELECT confirmed FROM users WHERE username = '".$_SESSION['username']."'";
$result1 = $mysqli->query($sql1);
$row = $result1->fetch_array();

if($row['confirmed'] == 0) {
	echo "<div class='topbarc'><a href='confirmcode.php'>Confirm your email here </a></div>";
}

$mysqli->close();
?> 

<?php include "header.php"; ?>

<div class="h-content">
	<div class="h-left">

		<?php
		require "connection.php";

		$sqlA = $mysqli->query("SELECT * FROM post ORDER BY id DESC");
		while($rowA = $sqlA->fetch_array()) {
			$sqlB = $mysqli->query("SELECT * FROM users WHERE id = '".$rowA['user']."'");
				$rowB = $sqlB->fetch_array();
			$sqlC = $mysqli->query("SELECT * FROM portdetail WHERE post = '".$rowA['id']."'");
				$rowC = $sqlC->fetch_array();

			$countLikes = $mysqli->query("SELECT * FROM likes WHERE nameacc = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes = $countLikes->num_rows;

			$countLikes2 = $mysqli->query("SELECT * FROM favorite WHERE nameacc = '".$_SESSION['id']."' AND post = '".$rowA['id']."'");
			$cLikes2 = $countLikes2->num_rows;
		?>

			<div class="hl-cont">
				<div class="hl-top">
					<div class="hl-profile">
						<div class="hl-pic"><a href="profile.php?username=<?php echo $rowB['username'];?>"><img src="images/<?php echo $rowB['avatar']; ?>" width="50" height="50"></a></div>
					</div>
					<div class="hl-username">
						<div class="hl-name"><a href="profile.php?username=<?php echo $rowB['username'];?>"><?php echo $rowB['username']; ?></a></div>
						<div class="hl-location">location</div>
					</div>
				</div>	
				<div class="hl-middle">
					<img src="postdetail/<?php echo $rowC['img']; ?>" width="100%" class="<?php echo $rowC['filter']; ?>">
				</div>	
				<div class="hl-section-likes">

					<?php if($cLikes == 0) { ?>
						<div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer;"><img src="images/icons/cora.png"></div>
					<?php } else { ?>
						<div id="<?php echo $rowA['id']; ?>" class="like" style="float: left; cursor: pointer;"><img src="images/icons/cora2.png"></div>
					<?php } ?>

					<div style="float: left;"><img src="images/icons/comentario.png"></div>

					<?php if($cLikes == 0) { ?>
						<div id="FAV<?php echo $rowA['id']; ?>" class="fav" style="float: left;"><img src="images/icons/favorito.png"></div>
					<?php } else { ?>
						<div id="FAV<?php echo $rowA['id']; ?>" class="fav" style="float: left;"><img src="images/icons/favorito2.png"></div>
					<?php } ?>

				</div>	
				<div class="hl-bottom">
					<strong style="color: #262626;"><?php echo $rowB['username']; ?></strong> <?php echo $rowA['description']; ?>
				</div>			
			</div>

		<?php } ?>

	</div>


	<div class="h-right">		

		<div class="hl-menu">
			<div class="hl-icon"><img src="images/icons/lupa.png" width="50"></div>
			<div class="hl-icon"><a href="upload.php"><img src="images/icons/mas.png" width="50" title ="Upload a photo and video " ></a></div>
			<div class="hl-icon"><img src="images/icons/corazon.png" width="50"></div>
		</div>
		
		<div class="hr-top">
			<div class="hr-profile">
				<div class="hr-pic"><a href="profile.php?username=<?php echo $_SESSION['username'];?>"><img src="images/<?php GetData($_SESSION['id'],'avatar'); ?>" width="60" height="60"></a></div>
			</div>
				<div class="hr-username">
					<div class="hr-name"><a href="profile.php?username=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['username'];?></a></div>
				<div class="hr-nombre"><?php GetData($_SESSION['id'],'name'); ?></div>
			</div>	
		</div>	
	</div>
</div>



  </body>  
</html>