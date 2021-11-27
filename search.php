<?php
    session_start();
    include_once "connection.php";

    $sending_id = $_SESSION['id'];
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['searchTerm']);

    $query1 = "SELECT * FROM users WHERE NOT id = {$sending_id} AND (name LIKE '%{$searchTerm}%') ORDER BY id DESC";
    $output = "";
    $sql1 = mysqli_query($mysqli, $query1);
    if(mysqli_num_rows($sql1) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>