<?php
session_start();
include 'includes/insert.php';
if(isset($_SESSION['chat_app_user_session'])){
    $user = $_SESSION['chat_app_user_session'];
}else{
    header("location:login.php");
}

if(isset($_POST['message'])){
    $message = $_POST['message'];
    $time = $_POST['time'];
    $contact = $_POST['contact'];
    $return = new Send_Message($message, $user, $contact, $time);
    echo $return->insert();
}