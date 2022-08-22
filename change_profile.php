<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
if(isset($_SESSION['chat_app_user_session'])){
    $user = $_SESSION['chat_app_user_session'];
    $sql = "SELECT * FROM `users` WHERE `UserName`='$user' ";
    $q = mysqli_query($conn, $sql);
    while($rowx = mysqli_fetch_assoc($q)){
        $profile = $rowx['Profile'];
        $bio = $rowx['About'];
        $ema = $rowx['Email'];
    }
}else{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="styles/settings.css">
</head>
<body>
    <div class="contacts-box-container">
        <div class="contact-chatting">
            <div class="contact">
                <div class="back">
                    <a href="settings.php"><img src="img/back.png" style="width:25px;height:20px;"></a>
                </div>
                <div class="contact-name">
                    <span>Change Profile Picture</span><br>
                    <span class="bio"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <div id="contact-container" class="contact-container" style="border-top:2px solid #ddd;">
            <br><br>
            <?php
            if(isset($_POST['submit'])){
                $new_pic = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
                $location = "profiles/$new_pic";
                $id = date("d-m-y-h-i-sa");
                if(strpos($new_pic, ".jpg")){
                    if(move_uploaded_file($tmp_name, $location)){
                        $new_file_name = "$user $id";
                        $rename = rename("profiles/$new_pic", "profiles/$new_file_name.jpg");
                        if($rename){
                            $sqlu = "UPDATE `users` SET `Profile`='$new_file_name.jpg' WHERE `UserName`='$user' ";
                            if(mysqli_query($conn, $sqlu)){
                                header("location:settings.php");
                            }else{
                                ?><div class="php-response-container"><?php echo "Profile Change Failed"; ?></div><?php
                            }                            
                        }else{
                            ?><div class="php-response-container"><?php echo "Profile Change Failed"; ?></div><?php
                        }
                    }else{
                        ?><div class="php-response-container"><?php echo "Profile Picture Upload Failed"; ?></div><?php
                    }
                }elseif(strpos($new_pic, ".jpeg")){
                    if(move_uploaded_file($tmp_name, $location)){
                        $new_file_name = "$user $id";
                        $rename = rename("profiles/$new_pic", "profiles/$new_file_name.jpeg");
                        if($rename){
                            $sqlu = "UPDATE `users` SET `Profile`='$new_file_name.jpeg' WHERE `UserName`='$user' ";
                            if(mysqli_query($conn, $sqlu)){
                                header("location:settings.php");
                            }else{
                                ?><div class="php-response-container"><?php echo "Profile Change Failed"; ?></div><?php
                            }                            
                        }else{
                            ?><div class="php-response-container"><?php echo "Profile Picture Upload Failed"; ?></div><?php
                        }
                    }else{
                        ?><div class="php-response-container"><?php echo "Profile Picture Upload Failed"; ?></div><?php
                    }
                }elseif(strpos($new_pic, ".png")){
                    if(move_uploaded_file($tmp_name, $location)){
                        $new_file_name = "$user $id";
                        $rename = rename("profiles/$new_pic", "profiles/$new_file_name.png");
                        if($rename){
                            $sqlu = "UPDATE `users` SET `Profile`='$new_file_name.png' WHERE `UserName`='$user' ";
                            if(mysqli_query($conn, $sqlu)){
                                header("location:settings.php");
                            }else{
                                ?><div class="php-response-container"><?php echo "Profile Change Failed"; ?></div><?php
                            }
                        }else{
                            ?><div class="php-response-container"><?php echo "Profile Picture Upload Failed"; ?></div><?php
                        }
                    }else{
                        ?><div class="php-response-container"><?php echo "Profile Picture Upload Failed"; ?></div><?php
                    }
                }else{
                    ?><div class="php-response-container"><?php echo "Picture extension not recognized"; ?></div><?php
                }

            }
            ?>
            <br>
            <span><img src="profiles/<?php echo $profile; ?>" style="width:15%;height:15%;border-radius:50%;"></span>
            <br>
            <form action="change_profile.php" method="post" enctype="multipart/form-data">
                <label class="image-btn" for="file"><input type="file" name="file" id="file" autocomplete="off" accept="image/png, image/jpeg, image/jpg" required><center><img src="img/uploadb.png" style="width:35px;height:35px;object-position:center;object-fit:cover;"></center></label><br><br>
                <button type="submit" name="submit">Change</button>
            </form>
        </div>
    </div>
</body>
</html>