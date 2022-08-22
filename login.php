<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
if(isset($_COOKIE['chat_app_user_cookie'])){
    $date = date("d-m-Y");
    $user = $_COOKIE['chat_app_user_cookie'];
    $_SESSION['chat_app_user_session'] = $user;
    if($_SESSION['chat_app_user_session']==$user){
        $upd = "UPDATE `users` SET `Active`='Online',`Act_Col`='green',`Login Date`='$date' WHERE `UserName` = '$user' ";
        if(mysqli_query($conn, $upd)){
            $_SESSION['chat_app_user_session'] = $username;
            setcookie("chat_app_user_cookie", $username, time() + (86400 * 365), "/");
            header("location:home.php");
        }else{
            echo "Login Failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login">
            <h1>Login</h1>
        </div>
        <?php
        if(isset($_POST['login'])){
            ?><div class="php-response-container"><?PHP
            $username = $_POST['username'];
            $password = $_POST['password'];
            $date = date("d-m-Y");
            $password_hash = sha1($password);
            $sql = "SELECT * FROM `users` WHERE `UserName` = '$username' and `Password` = '$password_hash' ";
            $q = mysqli_query($conn, $sql);
            if(mysqli_num_rows($q)>0){
                $upd = "UPDATE `users` SET `Active`='Online',`Act_Col`='green',`Login Date`='$date' WHERE `UserName` = '$username' ";
                if(mysqli_query($conn, $upd)){
                    $_SESSION['chat_app_user_session'] = $username;
                    setcookie("chat_app_user_cookie", $username, time() + (86400 * 365), "/");
                    header("location:home.php");
                }else{
                    echo "Login Failed!";
                }
            }else{
                echo "Login Failed!";
            }
            ?></div><br><?php
        }
        ?>
        <div class="input-container">
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="UserName..." autocomplete="off"><br><br>
                <input type="password" name="password" placeholder="Password..."><br><br>
                <input type="submit" name="login" value="Login">                
            </form>
        </div>
        <hr>
        <div class="signup">
            <p>Don't have an account ?</p>
            <a href="register.php"><button>Sign Up</button></a>
        </div>
    </div>
</body>
</html>