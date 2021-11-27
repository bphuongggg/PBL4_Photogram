<?php

function GetData($id,$value) {

	require "connection.php";

	$id = $mysqli->real_escape_string($id);
	$value = $mysqli->real_escape_string($value);

	$data = $mysqli->query("SELECT * FROM users WHERE id = $id");
	$row = $data->fetch_array();

	echo $row[$value];

}

function getComment($id)
{
	require "connection.php";
	$data = null;
	$id = $mysqli->real_escape_string($id);
	$sql1 = $mysqli->query("SELECT * FROM `comments` JOIN `post` ON `comments`.`post` = `post`.`id` JOIN `users` ON `comments`.`nameacc` = `users`.`id` WHERE `post`.`id` = '$id'");
	if($sql1->num_rows > 0)
	{
		while($row = $sql1->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}
}

function getProfile($username)
{
	require "connection.php";
	$data = null;
	$username = $mysqli->real_escape_string($username);
	$sql2 = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
	if($sql2->num_rows > 0)
	{
		while($row = $sql2->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}
}
?>