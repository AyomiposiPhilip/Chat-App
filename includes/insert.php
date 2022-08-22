<?php


class Send_Message{
    public $message;
    public $from;
    public $to;
    public $time;

    public function __construct($message, $from, $to, $time){
        $this->message = $message;
        $this->from = $from;
        $this->to = $to;
        $this->time = $time;
    }

    public function insert(){
        $conn = new mysqli("localhost", "root", "", "new_chat_app");
        if(!$conn){
            die("Connection Failed");
        }
        $current_date = date("d l Y");
        $checkd = "SELECT * FROM `chats` WHERE `From`='$this->from' AND `To`='$this->to' ORDER BY `id` DESC LIMIT 1";
        $checkd2 = "SELECT * FROM `chats` WHERE `From`='$this->to' AND `To`='$this->from' ORDER BY `id` DESC LIMIT 1";
        $qq = mysqli_query($conn, $checkd);
        $qqs = mysqli_query($conn, $checkd2);
        if(mysqli_num_rows($qq)>0){
            while($row = mysqli_fetch_assoc($qq)){
                $date = $row['Date'];
                if($current_date==$date){
                    $sql = "INSERT INTO `chats`(`Id`, `Message`, `From`, `To`, `Type`, `Date`, `Time`) VALUES ('','$this->message','$this->from','$this->to','','$current_date', '$this->time')";
                    if(mysqli_query($conn, $sql)){
                        echo "Done";
                    }else{
                        echo "Fail";
                    }                    
                }else{
                    $sqla = "INSERT INTO `chats`(`Id`, `Message`, `From`, `To`, `Type`, `Date`, `Time`) VALUES ('', '$current_date', '$this->from', '$this->to', 'date', '$current_date', '$this->time'), ('', '$this->message', '$this->from', '$this->to', '', '$current_date', '$this->time')";
                    if(mysqli_query($conn, $sqla)){
                        echo "Done";
                    }else{
                        echo "Fail";
                    }
                }
            }
        }elseif(mysqli_num_rows($qqs)>0){
            while($row = mysqli_fetch_assoc($qqs)){
                $date = $row['Date'];
                if($current_date==$date){
                    $sql = "INSERT INTO `chats`(`Id`, `Message`, `From`, `To`, `Type`, `Date`, `Time`) VALUES ('','$this->message','$this->from','$this->to','','$current_date', '$this->time')";
                    if(mysqli_query($conn, $sql)){
                        echo "Done";
                    }else{
                        echo "Fail";
                    }                    
                }else{
                    $sqla = "INSERT INTO `chats`(`Id`, `Message`, `From`, `To`, `Type`, `Date`, `Time`) VALUES ('', '$current_date', '$this->from', '$this->to', 'date', '$current_date', '$this->time'), ('', '$this->message', '$this->from', '$this->to', '', '$current_date', '$this->time')";
                    if(mysqli_query($conn, $sqla)){
                        echo "Done";
                    }else{
                        echo "Fail";
                    }
                }
            }
        }else{
            $sqla = "INSERT INTO `chats`(`Id`, `Message`, `From`, `To`, `Type`, `Date`, `Time`) VALUES ('', '$current_date', '$this->from', '$this->to', 'date', '$current_date', '$this->time'), ('', '$this->message', '$this->from', '$this->to', '', '$current_date', '$this->time')";
            if(mysqli_query($conn, $sqla)){
                echo "Done";
            }else{
                echo "Fail";
            }
        }
    }
}


