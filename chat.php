<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="en">  
  <head>
    <title>Photogram</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>  
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/> 
    <link rel="stylesheet" href="./fonts/font-awesome-icons/css/font-awesome.min.css">
    <style>
        .c-left{
            width: 30%;
            height: 550px;
            float: left;
            border-radius: 10px;
            border-top: 1px solid #DBDBDB; 
            border-right: 1px solid #DBDBDB; 
            border-bottom: 1px solid #DBDBDB;
            border-left: 1px solid #DBDBDB; 
        }
            .c-new{
                border-bottom: 1px solid #DBDBDB;
                height: 60px;
            }
            .c-new input{
                float: left;
                margin-left: 30px;
                margin-top: 18px;
                font-size: 15px;
                width: 190px;
                border-radius: 20px;
                float: left;
                border: 1px solid #ccc;
                outline: none;
                padding: 2px 8px;
            }
            .c-new button{
                width: 20px;
                border: none;
                outline: none;
                background: none;
                color: #000;
                font-size: 19px;
                cursor: pointer;
            }
            .c-userlist{
                max-height: 489px;
                overflow-y: auto;
                border-radius: 10px;
            }
            .c-userlist::-webkit-scrollbar{
                width: 10px;
            }
            .c-userlist::-webkit-scrollbar-track {
                box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
                border-radius: 10px;
            }
            .c-userlist::-webkit-scrollbar-thumb {
                border-radius: 10px;
                box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
            }
            .c-userlist a{
                display: flex;
                align-items: center;
                padding-bottom: 10px;
                padding-top: 10px;
                justify-content: space-between;
                border-bottom: 1px solid #e6e6e6;
                padding-right: 15px;
                border-bottom-color: #f1f1f1;
                padding-left: 10px;
                text-decoration: none;
                font-weight: inherit;
            }
            .c-userlist a:last-child{
                border: none;
                margin-bottom: 0px;
            }
            .c-userlist a.c-unseen .c-content p{
                font-weight: 700;
                color: #000;
            }
            .c-userlist a .c-content{
                display: flex;
                align-items: center;
            }
            .c-right header img,
            .c-userlist a .c-content img{
                height: 40px;
                width: 40px;
            }
            .c-userlist a .c-content p{
                color: #676767;
            }
            .c-userlist .c-detail{
                color: #000;
                margin-left: 15px;
            }
            .c-right header span,
            .c-userlist .c-detail span{
                font-size: 18px;
                font-weight: 500;
            }
        .c-right{
            width: 68%;
            height: 550px;
            float: right;
            border-radius: 10px;
            border-top: 1px solid #DBDBDB; 
            border-right: 1px solid #DBDBDB; 
            border-bottom: 1px solid #DBDBDB;
            border-left: 1px solid #DBDBDB; 
        }
            .c-right header{
                display: flex;
                align-items: center;
                padding: 10px 20px;
                /* border-bottom-color: #f1f1f1; */
            }
            .c-right header img{
                margin-right: 15px;
            }
            .c-chatbox{
                height: 420px;
                background: #f7f7f7;
                padding: 0 30px 0;
                overflow-y: auto;
                border-radius: 0 0 10px 10px;
            }
            .c-chatbox::-webkit-scrollbar{
                width: 15px;
            }
            .c-chatbox::-webkit-scrollbar-track {
                box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
                border-radius: 10px;
            }
            .c-chatbox::-webkit-scrollbar-thumb {
                border-radius: 10px;
                box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
            }
            .c-chatbox .c-chat {
                margin: 15px 0;
            }
            .c-chatbox .c-chat p{
                padding: 8px 16px;
                word-wrap: break-word;
            }
            .c-chatbox .c-sending{
                display: flex;
                flex-direction: column;
            }
            .c-sending .c-detail{
                margin-left: auto;
                max-width: calc(100% - 130px);
            }
            .c-sending .c-detail p{
                background: #333;
                color: #fff;
                border-radius: 18px 18px 0 18px;
            }
            .c-sending span{
                margin-left: auto;
                max-width: calc(100% - 130px);
                font-style: oblique;
                font-size: 13px;
            }
            .c-chatbox .c-receiving{
                display: flex;
                flex-direction: column;
            }
            .c-receiving .c-detail{
                margin-right: auto;
                max-width: calc(100% - 130px);
            }
            .c-receiving .c-detail p{
                background: #fff;
                color: #333;
                border-radius: 18px 18px 18px 0;
            }
            .c-receiving span{
                margin-right: auto;
                max-width: calc(100% - 130px);
                font-style: oblique;
                font-size: 13px;
            }
            .c-typing {
                padding: 18px 20px;
                display: flex;
                justify-content: space-between;
            }
            .c-typing input{
                height: 40px;
                width: calc(100% - 60px);
                font-size: 17px;
                border: 1px solid #ccc;
                padding: 0 13px;
                border-radius: 5px;
                border-radius: 5px 0 0 5px;
                outline: none;
            }
            .c-typing button{
                width: 55px;
                border: none;
                outline: none;
                background: #333;
                color: #fff;
                font-size: 19px;
                cursor: pointer;
                border-radius: 0 5px 5px 0;
            }

    </style>  
  </head>  
  <body>   

    <?php include "header.php"; ?>
    <div class="h-content">
        <div class="c-left">
            <div class="c-new">
                <input type="text" placeholder="...">
                <button><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>

            <div class="c-userlist">
                
            </div>
        </div>

        <script src="js/users.js"></script>

        <?php 
        include_once "connection.php";
        $user_id = mysqli_real_escape_string($mysqli, $_GET['user_id']);
        if($user_id == 0)
        {
        ?>    
            <div class="c-right">

            </div>
        <?php
        }
        else{
            $sql = mysqli_query($mysqli, "SELECT * FROM users WHERE id = {$user_id}");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
            }else{
                header("location: users.php");
            }
        ?>

        <div class="c-right">
            <header>
                <img src="./images/<?php echo $row['avatar']; ?>" alt="">
                <div class="c-detail">
                    <span><?php echo $row['name'] ?></span>
                </div>
            </header>
            <div class="c-chatbox">

            </div>
            <form action="#" class="c-typing">
                <input type="text" class="c-receiving_id" name="receiving_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" class="c-input" name="message" placeholder="..." autocomplete="off">
                <button><i class="fa fa-telegram" aria-hidden="true"></i></button>
            </form>
        </div>
        <script src="js/chat.js"></script>
        <?php } ?>
    </div>

  </body>  
</html>