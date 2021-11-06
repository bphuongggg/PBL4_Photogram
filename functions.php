<?php

function GetData($id,$value) {

	require "connection.php";

	$id = $mysqli->real_escape_string($id);
	$value = $mysqli->real_escape_string($value);

	$data = $mysqli->query("SELECT * FROM users WHERE id = $id");
	$row = $data->fetch_array();

	echo $row[$value];

}

?>