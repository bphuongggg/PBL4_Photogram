<?php
    //session_start();
    require "connection.php";

    $id = $_GET['id'];
    $username = $_POST['username'];
    $sql1 = $mysqli->query("DELETE FROM `portdetail` WHERE `portdetail`.`id` = '$id'");
    $sql2 = $mysqli->query("DELETE FROM `post` WHERE `post`.`id` = '$id'");
    if($sql1 && $sql2)
    {
        header("refresh: 0; url =home.php ");
    }
?>