<?php
    session_start();
    include_once "connection.php";
    $sending_id = $_SESSION['id'];
    
    // $query1 = "SELECT * FROM users WHERE id IN (SELECT receiving_id FROM messages WHERE sending_id = {$sending_id} ORDER BY msg_id DESC)";
    $query1 = "SELECT * FROM users WHERE id IN (SELECT receiving_id FROM messages WHERE sending_id = {$sending_id} ORDER BY msg_id DESC) OR id IN (SELECT sending_id FROM messages WHERE receiving_id = {$sending_id} ORDER BY msg_id DESC) AND NOT id = {$sending_id}";
    $sql1 = mysqli_query($mysqli, $query1);
    $output = "";
    if(mysqli_num_rows($sql1) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($sql1) > 0){
        include_once "data.php";
    }
    echo $output;

?>