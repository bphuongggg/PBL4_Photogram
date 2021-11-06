<?php

$mysqli = new mysqli("localhost", "root", "", "photogram");

if($mysqli->connect_errno) {
	echo "Can not connnect database";
}

return $mysqli;

?>
