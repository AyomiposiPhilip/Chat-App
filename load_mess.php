<?php
session_start();
include 'includes/select.php';
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
if(isset($_SESSION['chat_app_user_session'])){
    if(isset($_SESSION['chat_app_contact_session'])){
        $user = $_SESSION['chat_app_user_session'];
        $contact = $_SESSION['chat_app_contact_session'];
        $sql = "SELECT * FROM `users` WHERE `UserName`='$contact' ";
        $q = mysqli_query($conn, $sql);
        while($rowx = mysqli_fetch_assoc($q)){
            $profile = $rowx['Profile'];
            $act = $rowx['Active'];
        }
    }else{
        header("location:login.php");
    }
}else{
    header("location:login.php");
}

if(isset($_POST['message'])){
    $mess = $_POST['message'];
    $che = new Load_Messages($user, $contact);
    echo $che->select();
}