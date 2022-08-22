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
                    <a href="home.php"><img src="img/back.png" style="width:25px;height:20px;"></a>
                </div>
                <div class="contact-name">
                    <span>Settings</span><br>
                    <span class="bio"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <a href="change_username.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change UserName</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="change_email.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change Email</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="change_profile.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change Profile Picture</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="change_pass.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change Password</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="change_status.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change Status</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="change_bio.php">
                <div class="user-contacts">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Change Bio</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="delete_account.php">
                <div class="user-contacts" style="border-left:3px solid red;">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Delete Account</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
            <a href="logout.php">
                <div class="user-contacts" style="border-left:3px solid orange;">
                    <div class="contact-profile"><img src="img/user.png" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span>Logout</span>
                    </div>
                    <div class="contact-status"></div>    
                </div>
            </a>
        </div>
    </div>
</body>
</html>