<?php

class User_Typing{
    public $mess;
    public $cont;
    public $user;

    public function __construct($user, $cont, $mess){
        $this->mess = $mess;
        $this->cont = $cont;
        $this->user = $user;
    }

    public function update(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        if(!empty($this->mess)){
            $sqli = "UPDATE `users` SET `Typing`='$this->cont' WHERE `UserName`='$this->user' ";
            if(mysqli_query($conn, $sqli)){
                echo "Done";
            };           
        }else{
            $sql = "UPDATE `users` SET `Typing`='no' WHERE `UserName`='$this->user' ";
            if(mysqli_query($conn, $sql)){
                echo "Done";
            };       
        }
    }
}