<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}

if(isset($_SESSION['chat_app_user_session'])){
    if(isset($_COOKIE['chat_app_user_cookie'])){
        $username = $_SESSION['chat_app_user_session'];
        $upd = "UPDATE `users` SET `Active`='Offline',`Act_Col`='red' WHERE `UserName` = '$username' ";
        if(mysqli_query($conn, $upd)){
            unset($_COOKIE['chat_app_user_cookie']);
            setcookie('chat_app_user_cookie', '', time() - 3600, '/');
            unset($_SESSION['chat_app_user_session']);
            header("location:login.php");
        }else{
            header("location:settings.php");
        }        
    }
}else{
    header("location:settings.php");
}



