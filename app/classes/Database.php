<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/20/2020
 * Time: 8:04 PM
 */

namespace App\classes;


class Database
{
    public $con;
    public function __construct(){
        $this->con = mysqli_connect("localhost:3307",'root','','ecom');
        if($this->con){
            return $this->con;
        }
    }
    public function test(){
        echo 'test from db';
    }
}