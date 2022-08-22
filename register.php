<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <script src="js/register.js"></script>
    <link rel="stylesheet" href="styles/register.css">
    <title>Register</title>
</head>
<body>
    <div class="login-container">
        <div class="login">
            <h1>Register</h1>
        </div>
        <?php
        if(isset($_POST['register'])){
            ?><div class="php-response-container"><?PHP
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $date = date("d-m-Y");
            $username_length = strlen($username);
            $password_length = strlen($password);
            $password_hash = sha1($password);
            $sql = "INSERT INTO `users`(`Id`, `UserName`, `Email`, `Password`, `Profile`, `Blocked`, `Active`, `Act_Col`, `Login Date`, `About`, `Date`) VALUES ('','$username', '$email', '$password_hash','default/default.png','0','Online','green','$date','','$date')";
            if(mysqli_query($conn, $sql)){
                $_SESSION['chat_app_user_session'] = $username;
                setcookie("chat_app_user_cookie", $username, time() + (86400 * 365), "/");
                header("location:home.php");
            }else{
                echo "Failure in Insertion";
            };
            ?></div><br><?php
        }
        ?>
        <div class="input-container">
            <form action="register.php" method="post">
                <input type="text" name="username" id="username" onkeyup="check_user()" placeholder="UserName..." autocomplete="off" required><br>
                <div id="php-response-container-one"></div>
                <br>
                <input type="email" name="email" id="email" onkeyup="check_email()" placeholder="Email..." autocomplete="off" required><br>
                <div id="php-response-container-thr"></div>
                <br>
                <input type="password" name="password" id="password" onkeyup="check_password()" placeholder="Password..." required><br>
                <div id="php-response-container-two"></div><br>
                <input type="submit" id="button_reg" name="register" value="Register" disabled>                
            </form>
        </div>
        <hr>
        <div class="signup">
            <p>Have an account ?</p>
            <a href="login.php"><button>Login</button></a>
        </div>
    </div>
</body>
</html>