<?php

$mysqli = new mysqli("localhost:3307", "root", "", "photogram");

if($mysqli->connect_errno) {
	echo "Can not connnect database";
}

return $mysqli;

?>
