<?php

include 'includes/select.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $check = new Register_Check_Email($email);
    echo $check->select();
}