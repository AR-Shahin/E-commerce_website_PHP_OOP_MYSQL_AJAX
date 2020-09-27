<?php

namespace App\classes;
require_once '../../vendor/autoload.php';
use App\classes\Database;

class User extends Database
{
    public function verify_email($table,$email,$pk='user_id'){
        //rizwankhan.august16@gmail.com
        $regexp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
        if(!preg_match($regexp,$email)){
            return "invalid_email";
        }
        //Check email already exists or not
        $sql = "SELECT $pk  FROM ".$table." WHERE email = '$email' LIMIT 1";
        $query = mysqli_query($this->con,$sql);
        $count = mysqli_num_rows($query);
        if($count == 1){
            return "already_exists";
        }else{
            return "ok";
        }
    }

    public function verify_username($table,$username){
        //Check username already exists or not
        $sql = "SELECT user_id FROM ".$table." WHERE username = '$username' LIMIT 1";
        $query = mysqli_query($this->con,$sql);
        $count = mysqli_num_rows($query);
        if($count == 1){
           return "<span class='text-danger'><b>$username</b> not available! :)</span>";

        }else{
            return "<span class='text-success'><b>$username</b> is available!!</span>";
        }
    }

    public function insert_record($table,$fields){
        //INSERT INTO `medicine`(`id`, `mediname`, `quantity`) VALUES ('f','5')
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",",array_keys($fields)).") VALUES";
        $sql .= "('".implode("','",array_values($fields))."')";
        $res = mysqli_query($this->con,$sql);
        $last_id = mysqli_insert_id($this->con);
        if($res){
            return $last_id;
        }
    }

    public function single_record($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            return $row;
        }
    }
    public  function changeLoginTime($date,$id){
        $sql = "UPDATE `user` SET `last-login` = '$date' WHERE `id` = '$id' ";
        $res = mysqli_query($this->con,$sql);
    }

    public function verify($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            return "<span class='text-danger'><b></b> Not available! :)</span>";

        }else{
            return "<span class='text-success'><b></b> Available!!</span>";
        }
    }
}
//$ob = new User();
//$ob->test();