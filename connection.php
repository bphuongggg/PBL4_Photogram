<?php

$mysqli = new mysqli("localhost", "root", "", "myphotogram");

if($mysqli->connect_errno) {
	echo "Can not connnect database";
}

return $mysqli;

?>
