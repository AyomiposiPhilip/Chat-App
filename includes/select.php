<?php

class Register_Check_User{
    public $user;

    public function __construct($user){
        $this->user = $user;
    }

    public function select(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM `users` WHERE `UserName` = '$this->user' ";
        $q = mysqli_query($conn, $sql);
        if(mysqli_num_rows($q)>0){
            echo "That name is taken";
        }elseif(empty($this->user)){
            echo "That name is empty";
        }else{
            echo "You can take that name";
        }
    }
}

class Register_Check_Email{
    public $email;

    public function __construct($email){
        $this->email = $email;
    }

    public function select(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM `users` WHERE `Email` = '$this->email' ";
        $q = mysqli_query($conn, $sql);
        if(mysqli_num_rows($q)>0){
            echo "That email is taken";
        }elseif(empty($this->email)){
            echo "That email is empty";
        }else{
            echo "You can take that email";
        }
    }
}

class Load_Messages{
    public $user;
    public $contact;

    public function __construct($user, $contact){
        $this->user = $user;
        $this->contact = $contact;
    }

    public function select(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM `chats` ";
        $q = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($q)){
            if($row['Type']=="date" && $row['From']==$this->user && $row['To']==$this->contact){
                ?><div class="message-date">
                    <?php echo $row['Message']; ?>
                </div><?php
            }elseif($row['Type']=="date" && $row['From']==$this->contact && $row['To']==$this->user){
                ?><div class="message-date">
                    <?php echo $row['Message']; ?>
                </div><?php
            }elseif($row['From']==$this->user && $row['To']==$this->contact){
                ?><div class="sep">
                    <div class="message-from-user">
                        <div class="message"><?php echo $row['Message']; ?></div>
                        <div class="time"><?php echo $row['Time']; ?></div>
                    </div>
                </div><?php
            }elseif($row['From']==$this->contact && $row['To']==$this->user){
                ?><div class="sep">
                    <div class="message-to-user">
                        <div class="message"><?php echo $row['Message']; ?></div>
                        <div class="time"><?php echo $row['Time']; ?></div>
                    </div>
                </div><?php
            }
        }
    }
}

class Addc_Check_User{
    public $user;

    public function __construct($user){
        $this->user = $user;
    }

    public function select(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM `users` WHERE `UserName` = '$this->user' ";
        $q = mysqli_query($conn, $sql);
        if(mysqli_num_rows($q)>0){
            echo "That Contact is valid";
        }else{
            echo "That Contact is not valid";
        }
    }
}

class Contact_Typing{
    public $user;
    public $cont;

    public function __construct($user, $cont){
        $this->user = $user;
        $this->cont = $cont;
    }

    public function select(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM `users` WHERE `UserName` = '$this->cont' ";
        $q = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($q)){
            if($row['Typing']==$this->user){
                echo "<b>".$this->cont."</b> is typing...";
            }else{
                echo "";
            }
        }
    }
}
