<?php
    session_start();
    require "connection.php";

    $idF = $_GET['delid'];
   // $username = $_GET['user'];
   // echo $username;

    $deleteFL = $mysqli->query("DELETE FROM `followers` WHERE `followers`.`id` = '$idF'");
    if($deleteFL) {header('Location:  profile.php?username='.$_GET['user'].'');}
?>