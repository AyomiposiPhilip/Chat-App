<?php
session_start();
$conn = new mysqli("localhost", "root", "", "new_chat_app");
if(!$conn){
    die("Connection Failed");
}
$user = $_SESSION['chat_app_user_session'];
        $sql_contacts = "SELECT * FROM `users` WHERE `UserName` != '$user' ";
        $sql_chats = "SELECT * FROM `chats` ";
        $q_con = mysqli_query($conn, $sql_contacts);
        $q_cha = mysqli_query($conn, $sql_chats);
        while($row = mysqli_fetch_assoc($q_con)){
            $sq = "SELECT * FROM `chats` WHERE `From` = '".$row['UserName']."' and `To` = '$user' ";
            $sqi = "SELECT * FROM `chats` WHERE `From` = '$user' and `To` = '".$row['UserName']."' ";
            $i = mysqli_query($conn, $sq);
            $ii = mysqli_query($conn, $sqi);
            if(mysqli_num_rows($i)>0){
                ?><a href="send_message.php?user=<?php echo $row['UserName']; ?>"><div class="user-contacts" style="border-left:4px solid <?php echo $row['Act_Col']; ?>;">
                    <div class="contact-profile"><img src="profiles/<?php echo $row['Profile']; ?>" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span><?php echo $row['UserName']; ?></span><br>
                        <span style="color: grey;font-size:15px;"><?php echo $row['Active']; ?></span>
                    </div>
                    <div class="contact-status"></div>     
                </div></a><?php
            }elseif(mysqli_num_rows($ii)>0){
                ?><a href="send_message.php?user=<?php echo $row['UserName']; ?>"><div class="user-contacts" style="border-left:4px solid <?php echo $row['Act_Col']; ?>">
                    <div class="contact-profile"><img src="profiles/<?php echo $row['Profile']; ?>" style="width:99%;height:99%;float:left;object-fit:cover;object-position:center;border-radius:50%;"></div>
                    <div class="contact-username">
                        <span><?php echo $row['UserName']; ?></span><br>
                        <span style="color: grey;font-size:15px;"><?php echo $row['Active']; ?></span>
                    </div>
                    <div class="contact-status"></div>     
                </div></a><?php
            }
        }
        ?>