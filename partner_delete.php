<?php
include "db.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM partners WHERE id=$id");
header("Location: partner_list.php");
?>
