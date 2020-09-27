<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/21/2020
 * Time: 7:40 AM
 */

session_start();
unset($_SESSION['cus_id']);
unset($_SESSION['cusname']);
unset($_SESSION['email']);
header('location:index.php');