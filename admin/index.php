<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
?>
<?php include 'inc/header.php'?>
<?php include 'inc/navbar.php'?>
<?php include 'inc/leftbar.php'?>
i am from dashboard
<?php include 'inc/footer.php'?>