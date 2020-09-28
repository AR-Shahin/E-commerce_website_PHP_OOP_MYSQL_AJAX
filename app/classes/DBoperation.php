<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/21/2020
 * Time: 7:47 AM
 */

namespace App\classes;


require_once '../../vendor/autoload.php';
use App\classes\Database;

class DBoperation extends Database
{
    public function insert_record($table,$fields){
        //INSERT INTO `medicine`(`id`, `mediname`, `quantity`) VALUES ('f','5')
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",",array_keys($fields)).") VALUES";
        $sql .= "('".implode("','",array_values($fields))."')";
        $res = mysqli_query($this->con,$sql);
        if($res){
            return true;
        }else{
            return false;
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
        }else{
            return false;
        }
    }
    public function fetch_data($table,$pk,$order="ASC"){
        //SELECT * FROM `medicine` ORDER BY `id` DESC
        $sql = "SELECT * FROM ".$table." ORDER BY ".$pk."  ".$order;
        $data = array();
        $res = mysqli_query($this->con,$sql);
        if($res->num_rows >0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function verify_Double_data($table,$where){
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
            return "already_exists";
        }else{
            return "ok";
        }
    }
    public function fetch_data_conditions($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $data = array();
        $res = mysqli_query($this->con,$sql);
        $r = $res->num_rows;
        if( $r>0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function countRows($table,$where){
        $r = 0;
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = mysqli_query($this->con,$sql);
        $r = $res->num_rows;
        return $r;
    }
    public function delete_record($table,$where){
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions .= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        //DELETE FROM `medicine` WHERE 0
        $sql = "DELETE FROM ".$table. " WHERE ".$conditions;
        if($this->con->query($sql)){
            return 'DELETED';
        }else{
            return 'NOT_DELETE';
        }
    }

}
//$ob = new DBoperation();
//$ob->test();