<?php
    //session_start();
    require "connection.php";

    $id = $_GET['id'];
    $username = $_POST['username'];
    $sql1 = $mysqli->query("DELETE FROM `portdetail` WHERE `portdetail`.`id` = '$id'");
    $sql2 = $mysqli->query("DELETE FROM `post` WHERE `post`.`id` = '$id'");
    $sql3 = $mysqli->query("DELETE FROM `comments` WHERE `comments`.`post` = '$id'");
    if($sql1 && $sql2 && $sql3)
    {
        header("refresh: 0; url =home.php ");
    }
?>