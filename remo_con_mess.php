<?php
session_start();

unset($_SESSION['chat_app_contact_session']);

if(isset($_SESSION['chat_app_contact_session'])){
    header("location:chat.php");
}else{
    header("location:home.php");
}