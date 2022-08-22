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
                    <span>Change Username</span><br>
                    <span class="bio"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <br><br>
            <?php
            if(isset($_POST['submit'])){
                $new_username = $_POST['username'];
                $sqlu = "UPDATE `users` SET `UserName`='$new_username' WHERE `UserName`='$user' ";
                if(mysqli_query($conn, $sqlu)){
                    $sqluu = "UPDATE `chats` SET `From`='$new_username' WHERE `From`='$user' ";
                    if(mysqli_query($conn, $sqluu)){
                        $sqluuu = "UPDATE `chats` SET `To`='$new_username' WHERE `To`='$user' ";
                        if(mysqli_query($conn, $sqluuu)){
                            $_SESSION['chat_app_user_session'] = $new_username;
                            header("location:settings.php");
                        }else{
                            ?><div class="php-response-container"><?php echo "UserName Change Failed"; ?></div><?php
                        }
                    }else{
                        ?><div class="php-response-container"><?php echo "UserName Change Failed"; ?></div><?php
                    }
                }else{
                    ?><div class="php-response-container"><?php echo "UserName Change Failed"; ?></div><?php
                }
            }
            ?>
            <br><br>
            <form action="change_username.php" method="post">
                <input type="text" name="username" id="username" placeholder="New UserName..." autocomplete="off" autofocus required><br><br>
                <button type="submit" name="submit">Change</button>
            </form>
        </div>
    </div>
</body>
</html>