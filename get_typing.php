<?php
session_start();
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
        $sqlc = "SELECT * FROM `users` WHERE `UserName`='$contact' ";
        $qc = mysqli_query($conn, $sqlc);
        while($rowxc = mysqli_fetch_assoc($qc)){
            $profilec = $rowxc['Profile'];
            $actc = $rowxc['Active'];
        }
    }else{
        header("location:login.php");
    }
}else{
    header("location:login.php");
}

include 'includes/select.php';
if(isset($_POST['message'])){
    $gtyp = new Contact_Typing($user, $contact);
    echo $gtyp->select();
}