<?php
session_start();

require "connection.php";

$postid = $_POST['id'];
$postid = intval(preg_replace('/[^0-9]+/', '', $postid), 10); 
$user = $_SESSION['id'];


$countLikes = $mysqli->query("SELECT * FROM favorite WHERE nameacc = '$user' AND post = '$postid'");
$cLike = $countLikes->num_rows;

if($cLike == 0) {
	$insertLike = $mysqli->query("INSERT INTO favorite (nameacc,post) VALUES ('$user', '$postid')");
} else {
	$insertLike = $mysqli->query("DELETE FROM favorite WHERE nameacc = '$user' AND post = '$postid'");
}

if($cLike == 0) {
	$megusta = "<img src='images/icons/favorito2.png'>";
} else {
	$megusta = "<img src='images/icons/favorito.png'>";
}

$return = array("img"=>$megusta);

echo json_encode($return);