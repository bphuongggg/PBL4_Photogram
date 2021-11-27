<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "connection.php";
        $sending_id = $_SESSION['id'];
        $receiving_id = mysqli_real_escape_string($mysqli, $_POST['receiving_id']);
        $message = mysqli_real_escape_string($mysqli, $_POST['message']);
        if(!empty($message)){
            $query = "INSERT INTO messages (receiving_id, sending_id, msg, msg_time, msg_status)
                        VALUES ({$receiving_id}, {$sending_id}, '{$message}', now(), 0)";
            $sql = mysqli_query($mysqli, $query) or die();
        }
    }else{
        header("location: ./users.php");
    }
?>