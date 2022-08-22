<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
if(isset($_SESSION['chat_app_user_session'])){
    if(isset($_SESSION['chat_app_contact_session'])){
        $user = $_SESSION['chat_app_user_session'];
        $contact = $_SESSION['chat_app_contact_session'];
        $sql = "SELECT * FROM `users` WHERE `UserName`='$user' ";
        $q = mysqli_query($conn, $sql);
        while($rowx = mysqli_fetch_assoc($q)){
            $profile = $rowx['Profile'];
            $act = $rowx['Active'];
        }
        $sqlc = "SELECT * FROM `users` WHERE `UserName`='$contact' ";
        $qc = mysqli_query($conn, $sqlc);
        while($rowxc = mysqli_fetch_assoc($qc)){
            $profilec = $rowxc['Profile'];
            $actc = $rowxc['Active'];
            $bioc = $rowxc['About'];
            $actcolc = $rowxc['Act_Col'];
        }
    }else{
        header("location:login.php");
    }
}else{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <script src="js/chat.js"></script>
    <link rel="stylesheet" href="styles/chat.css">
    <title>Chat</title>
</head>
<body onload="scroll_down_bt()">
    <div class="chat-box-container">
        <div class="contact-chatting" style="border-right:4px solid <?php echo $actcolc; ?>;">
            <div class="contact">
                <div class="back">
                    <a href="remo_con_mess.php"><img src="img/back.png" style="width:25px;height:20px;"></a>
                </div>
                <div class="contact-name">
                    <div class="img">
                        <img src="profiles/<?php echo $profilec; ?>" style="float:left;width:50px;height:50px;object-position:center;object-fit:cover;border-radius:50px;">
                    </div>
                    <div class="name">
                        <span><?php echo $contact; ?></span><br>
                        <span class="bio"><?php echo $bioc; ?></span>                        
                    </div>
                </div>
            </div>
        </div>
        <div id="messages-container" class="messages-container"></div>
        <div id="messages-info" class="messages-info">
            <span id="typing" class="typing"></span>
            <button id="scroll-down" class="scroll-down" onclick="scroll_down()"><img src="img/down.png" style="width:20px;height:20px;"></button>
        </div>
        <div class="message-typing-box">
            <div>
                <input type="text" name="message" id="message" autocomplete="off" placeholder="Message..." autofocus="on" onkeyup="typing_mess()">
                <button onclick="send_message()"><img src="img/send.png" style="width:23px;height:23px;"></button>
            </div>
        </div>
    </div>
</body>
</html>