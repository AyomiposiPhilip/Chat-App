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
    <script src="js/change_pass.js"></script>
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
                    <span>Change Password</span><br>
                    <span class="bio"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <br><br>
            <?php
            if(isset($_POST['submit'])){
                $old_pass = $_POST['old_password'];
                $new_pass = $_POST['new_password'];
                $old_pass_hash = sha1($old_pass);
                $new_pass_hash = sha1($new_pass);
                $check_oldp = "SELECT * FROM `users` WHERE `UserName` = '$user' and `Password` = '$old_pass_hash' ";
                $check_oldp_query = mysqli_query($conn, $check_oldp);
                if(mysqli_num_rows($check_oldp_query)>0){
                    $sqlu = "UPDATE `users` SET `Password`='$new_pass_hash' WHERE `Password`='$old_pass_hash' and `UserName` = '$user' ";
                    if(mysqli_query($conn, $sqlu)){
                        header("location:settings.php");
                    }else{
                        ?><div class="php-response-container"><?php echo "Password Change Failed"; ?></div><?php
                    }                    
                }else{
                    ?><div class="php-response-container"><?php echo "Incorrect Current Password"; ?></div><?php
                }
            }
            ?>
            <br>
            <form action="change_pass.php" method="post">
                <input type="password" name="old_password" id="old_password" placeholder="Current Password..." autocomplete="off" autofocus required><br>
                <span class="confirmp" id="confirmp"></span><br>
                <input type="password" name="new_password" id="new_password" placeholder="New Password..." onkeyup="check_new_pass()" autocomplete="off" required><br>
                <span class="confirmnp" id="confirm_np"></span><br><br>
                <button type="submit" id="submit" name="submit" disabled>Change</button>
            </form>
        </div>
    </div>
</body>
</html>