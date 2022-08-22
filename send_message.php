<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
$username = $_SESSION['chat_app_user_session'];

if(isset($_GET['user'])){
    $contact = $_GET['user'];
    if($contact==$username){
        header("location:home.php");
    }else{
        $sql = "SELECT * FROM `users` WHERE `UserName` = '$contact' ";
        $q = mysqli_query($conn, $sql);
        if(mysqli_num_rows($q)>0){
            $_SESSION['chat_app_contact_session'] = $contact;
            header("location:chat.php");
        }else{
            header("location:home.php");
        }
    }
}