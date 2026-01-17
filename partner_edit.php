<?php
include "db.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM partners WHERE id=$id");
$partner = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $company = $_POST['company_name'];
    $type    = $_POST['partner_type'];
    $contact = $_POST['contact_person'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $city    = $_POST['city'];
    $state   = $_POST['state'];

    $q = "UPDATE partners SET
        company_name='$company',
        partner_type='$type',
        contact_person='$contact',
        email='$email',
        phone='$phone',
        city='$city',
        state='$state'
        WHERE id=$id";

    mysqli_query($conn,$q);
    header("Location: partner_list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Partner</title>
<style>
body{font-family:Arial;background:#eef2f3;}
.box{
    width:600px;margin:50px auto;background:#fff;
    padding:40px;border-radius:12px;
}
input,select{width:100%;padding:12px;margin-bottom:15px;}
button{padding:12px 30px;background:#2c3e50;color:#fff;border:none;}
</style>
</head>
<body>

<div class="box">
<h2>Edit Partner</h2>
<form method="post">
<input name="company_name" value="<?= $partner['company_name'] ?>" required>
<input name="partner_type" value="<?= $partner['partner_type'] ?>" required>
<input name="contact_person" value="<?= $partner['contact_person'] ?>" required>
<input name="email" value="<?= $partner['email'] ?>" required>
<input name="phone" value="<?= $partner['phone'] ?>" required>
<input name="city" value="<?= $partner['city'] ?>">
<input name="state" value="<?= $partner['state'] ?>">
<button name="update">Update Partner</button>
</form>
</div>

</body>
</html>
