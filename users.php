<?php
    session_start();
    include_once "connection.php";
    $sending_id = $_SESSION['id'];
    // $query = "SELECT * FROM messages WHERE sending_id = {$sending_id}";
    // $sql = mysqli_query($mysqli, $query);
    // $row = mysqli_fetch_assoc($sql);
    // $count = mysqli_num_rows($sql);
    // echo $count;

    // $query1 = "SELECT * FROM users WHERE id = {$row['receiving_id']} ORDER BY id DESC";
    
    $query1 = "SELECT * FROM users WHERE NOT id = {$sending_id} ORDER BY id DESC";
    $sql1 = mysqli_query($mysqli, $query1);
    // $count1 = mysqli_num_rows($query1);
    // echo $count1;
    // echo $row['receiving_id'];
    $output = "";
    if(mysqli_num_rows($sql1) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($sql1) > 0){
        include_once "data.php";
    }
    echo $output;

?>