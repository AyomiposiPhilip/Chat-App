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
    <script>
        document.getElementById("button_reg").disabled = true;

        function check_user(){
        var user = document.getElementById("cont").value;
        $.post("check_add_user.php", {
            user: user
        }, function (data, status){
                if(data=="That Contact is valid"){
                    document.getElementById("button_reg").disabled = false;
                    document.getElementById("user_is_valid").innerHTML = "<span style='color:green;'>"+data+"</span>";
                    document.getElementById("cont").style.border = "2px solid green";
                }else if(data=="That Contact is not valid"){
                    document.getElementById("button_reg").disabled = true;
                    document.getElementById("user_is_valid").innerHTML = "<span style='color:red;'>"+data+"</span>";
                    document.getElementById("cont").style.border = "2px solid red";
                }
            })
        }

        function send_mes(){
            var date = new Date();
            var hour = date.getHours();
            var mins = date.getMinutes();
            var time = hour+":"+mins;
            var contact = document.getElementById("cont").value;
            var message = document.getElementById("message").value;
            $.post("addc_sm.php", {
                message: message,
                time: time,
                contact: contact
            }, function(data, status){
                window.location.replace("home.php");
            })
        }
    </script>
    <link rel="stylesheet" href="styles/home.css">
</head>
<body>
    <div class="contacts-box-container">
        <div class="user-details-container">
            <div class="user-details">
                <div class="user-dets">
                    <div class="user-profile"><img src="profiles/<?php echo $profile; ?>" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="user-username">
                        <span><?php echo $user; ?></span><br>
                        <span style="color: grey;font-size:15px;"><?php echo $bio; ?></span>
                    </div>
                    <div class="user-settings"><a href="settings.php"><button><img src="img/settingsd.png" style="width:30px;height:30px;"></button></a></div>                    
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <br><br><a href="home.php" style="padding:1px 20px;float:left;"><img src="img/back.png" style="width:25px;height:20px;"></a><span style="float:left;padding:1px 80px;">Add Contact</span><br><hr>
            <input type="text" name="cont" id="cont" autocomplete="off" onkeyup="check_user()" placeholder="Contact UserName..."><br>
            <span id="user_is_valid" style="font-size:15px;"></span><br>
            <input type="text" name="message" id="message" autocomplete="off" placeholder="Message to Contact..."><br><br>
            <button id="button_reg" onclick="send_mes()" disabled="disabled">Add Contact</button>
        </div>
    </div>
</body>
</html>