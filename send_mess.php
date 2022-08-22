<?php
session_start();
include 'includes/insert.php';
if(isset($_SESSION['chat_app_user_session'])){
    if(isset($_SESSION['chat_app_contact_session'])){
        $user = $_SESSION['chat_app_user_session'];
        $contact = $_SESSION['chat_app_contact_session'];
    }else{
        header("location:login.php");
    }
}else{
    header("location:login.php");
}

if(isset($_POST['message'])){
    $message = $_POST['message'];
    $time = $_POST['time'];
    $return = new Send_Message($message, $user, $contact, $time);
    echo $return->insert();
}