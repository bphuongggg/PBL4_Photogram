<?php
    while($row1 = mysqli_fetch_assoc($sql1)){
        $query2 = "SELECT * FROM messages WHERE (receiving_id = {$row1['id']} OR sending_id = {$row1['id']}) 
                AND (sending_id = {$sending_id} OR receiving_id = {$sending_id}) ORDER BY msg_id DESC LIMIT 1";
        $sql2 = mysqli_query($mysqli, $query2);
        $row2 = mysqli_fetch_assoc($sql2);
        (mysqli_num_rows($sql2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['sending_id'])){
            ($sending_id == $row2['sending_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        
        ($row2['msg_status'] == '0' && $row2['receiving_id'] == $sending_id) ? $unseen = "c-unseen" : $unseen = "";

        $output .= '<a href="chat.php?user_id='. $row1['id'] .'" class="'. $unseen .'">
                    <div class="c-content">
                    <img src="./images/'. $row1['avatar'] .'" alt="">
                    <div class="c-detail">
                        <span>'. $row1['name'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="c-status-dot"><i class="fa fa-circle" aria-hidden="true"></i></div>
                </a>';
    }
?>