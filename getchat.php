<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "connection.php";
        $sending_id = $_SESSION['id'];
        $receiving_id = mysqli_real_escape_string($mysqli, $_POST['receiving_id']);
        $output = "";
        $query = "SELECT * FROM messages LEFT JOIN users ON users.id = messages.sending_id
                WHERE (sending_id = {$sending_id} AND receiving_id = {$receiving_id})
                OR (sending_id = {$receiving_id} AND receiving_id = {$sending_id}) ORDER BY msg_id";
        $sql = mysqli_query($mysqli, $query);
        $query2 = "UPDATE messages SET msg_status = 1 WHERE receiving_id = {$sending_id} AND sending_id = {$receiving_id} AND msg_status = 0";
        $sql2 = mysqli_query($mysqli, $query2);
        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
                $msg_time = date_format(date_create($row['msg_time']), 'd/m/Y H:i');

                if($row['sending_id'] === $sending_id){
                    $output .= '<div class="c-chat c-sending">
                                    <div class="c-detail">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                    <span>'.$msg_time.'</span>
                                </div>';
                }else{
                    $output .= '<div class="c-chat c-receiving">
                                    <div class="c-detail">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                    <span>'.$msg_time.'</span>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="c-text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ./users.php");
    }
?>