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
        $actcol = $rowx['Act_Col'];
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
    <script>
        setInterval(function(){
            var yu = document.getElementsByClassName("user-username").innerHTML;
            $.post("get_contacts.php", {
                yu: yu
            }, function(data, status){
                if(data==""){
                    document.getElementById("contact-container").innerHTML = "<div style='margin:auto;'>You have no contacts.<br><a href='add-conts.php'>+ Add Contact</a></div>";
                }else{
                    document.getElementById("contact-container").innerHTML = data;
                }
            })
        }, 1000);
    </script>
    <link rel="stylesheet" href="styles/home.css">
</head>
<body>
    <div class="contacts-box-container">
        <div class="user-details-container" style="border-right:4px solid <?php echo $actcol; ?>">
            <div class="user-details">
                <div class="user-dets">
                    <div class="user-profile"><img src="profiles/<?php echo $profile; ?>" style="width:95%;height:95%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="user-username">
                        <span><?php echo $user; ?></span><br>
                        <span style="color: grey;font-size:15px;"><?php echo $bio; ?></span>
                    </div>
                    <div class="user-settings"><a href="settings.php"><button><img src="img/settingsd.png" style="width:30px;height:30px;"></button></a></div>                    
                </div>
            </div>
        </div>
        <div id="search-contact" class="search-contact" style="border-top:2px solid #ddd;"></div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;"></div>
        <div class="footer">
            <br>
            <a href="add-conts.php">+ Add Contact</a>
        </div>
    </div>
</body>
</html>