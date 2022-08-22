<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
if(isset($_SESSION['chat_app_user_session'])){
    $user = $_SESSION['chat_app_user_session'];
    $sql = "SELECT * FROM `users` WHERE `UserName`='$user' ";
    $q = mysqli_query($conn, $sql);
    while($rowx = mysqli_fetch_assoc($q)){
        $profile = $rowx['Profile'];
        $bio = $rowx['About'];
        $ema = $rowx['Email'];
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
    <title>Home</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="styles/settings.css">
</head>
<body>
    <div class="contacts-box-container">
        <div class="contact-chatting">
            <div class="contact">
                <div class="back">
                    <a href="settings.php"><img src="img/back.png" style="width:25px;height:20px;"></a>
                </div>
                <div class="contact-name">
                    <span>Change Status</span><br>
                    <span class="bio"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <br><?php
            if(isset($_POST['away'])){
                $upd = "UPDATE `users` SET `Active`='Away',`Act_Col`='#7aac08' WHERE `UserName` = '$user' ";
                if(mysqli_query($conn, $upd)){
                    header("location:settings.php");
                }else{
                    ?><div class="php-response-container"><?php echo "Couldn't Update Status"; ?></div><?php
                }
            }elseif(isset($_POST['busy'])){
                $updr = "UPDATE `users` SET `Active`='Busy', `Act_Col`='#0014c7' WHERE `UserName` = '$user' ";
                if(mysqli_query($conn, $updr)){
                    header("location:settings.php");
                }else{
                    ?><div class="php-response-container"><?php echo "Couldn't Update Status"; ?></div><?php
                }
            }elseif(isset($_POST['def'])){
                $updr = "UPDATE `users` SET `Active`='Online', `Act_Col`='green' WHERE `UserName` = '$user' ";
                if(mysqli_query($conn, $updr)){
                    header("location:settings.php");
                }else{
                    ?><div class="php-response-container"><?php echo "Couldn't Update Status"; ?></div><?php
                }
            }
            ?><br>
            <span style="font-size:15px;">Set my status to :</span><br><br>
            <form action="change_status.php" method="post">
                <button type="submit" id="away" name="away">Away</button><br><br>
                <button type="submit" id="busy" name="busy">Busy</button><br><br>
                <button type="submit" id="def" name="def">Available</button><br><br>
            </form>
        </div>
    </div>
</body>
</html>