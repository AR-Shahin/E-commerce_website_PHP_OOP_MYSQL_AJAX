<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/21/2020
 * Time: 7:40 AM
 */

session_start();
session_destroy();
header('location:login.php');