<div class="h-header">
	<div class="h-logo"><a href="home.php"><img src="images/logo.png" width="130"></a></div>
	<div class="h-search"><input type="text" placeholder="Tìm kiếm" class="search"></div>
	<div class="h-account">
		<a href="chat.php?user_id=0">
			<img src="images/icons/telegram.png" class="i-icon" width="24px">
		</a>
		<a href="profile.php?username=<?php echo $_SESSION['username'];?>">
			<img src="images/icons/perfil.png" class="i-icon">
		</a>
		<a href="logout.php">
			<img src="images/icons/close.png" class="i-icon" width="24px">
		</a>
	</div>
</div>