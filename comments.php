<?php
session_start();

require "connection.php";




// $countCmt = $mysqli->query("SELECT * FROM comments WHERE nameacc = '$user' AND post = '$postid'");
// $com = $countCmt->num_rows;

// if($com == 0) {
// 	$insertCmt = $mysqli->query("INSERT INTO comments (nameacc,post,time) VALUES ('$user', '$postid', now())");
// 	$updatePost = $mysqli->query("UPDATE post SET comments = comments+ '$cmt' WHERE id = '$postid'");
// }
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch($action):
	case 'comment':
		if(isset($_POST['submit'])){
			$postid = $_GET['id'];
			$user = $_SESSION['id'];
			$cmt = $_POST['commentss'];
			$sql = $mysqli->query("INSERT INTO comments (nameacc,post, content,timeCmt) VALUES ('$user', '$postid','$cmt', now())");
			header('location: home.php?id='.$postid.'');
		}
		break;

	case 'deleteCmt':
		$id =  isset($_GET['idDel']) ? $_GET['idDel'] : '';
		$sql2 = $mysqli->query("DELETE FROM comments WHERE commentid = '$id'");
		header('location: home.php?id='.$_GET['idpost'].'');
endswitch;
?>