<?php

include 'includes/select.php';

if(isset($_POST['user'])){
    $user = $_POST['user'];
    $check = new Addc_Check_User($user);
    echo $check->select();
}