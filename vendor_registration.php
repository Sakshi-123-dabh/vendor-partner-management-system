<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Project Home</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#e0eafc,#cfdef3);
}

.container{
    width:1000px;
    margin:50px auto;
}

h1{
    text-align:center;
    margin-bottom:40px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
}

.card{
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 15px 30px rgba(0,0,0,0.25);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-10px);
}

.card h3{
    margin-bottom:15px;
}

.card p{
    color:#555;
    font-size:15px;
}

.card a{
    display:inline-block;
    margin-top:20px;
    padding:12px 30px;
    background:#2c3e50;
    color:#fff;
    text-decoration:none;
    border-radius:30px;
}

.card a:hover{
    background:#1a252f;
}

.bottom{
    margin-top:50px;
    text-align:center;
}

.bottom a{
    padding:14px 40px;
    background:#6c5ce7;
    color:#fff;
    border-radius:40px;
    text-decoration:none;
    font-size:18px;
}
</style>
</head>

<body>

<div class="container">

<h1>Vendor & Partner Management System</h1>

<div class="grid">

    <div class="card">
        <h3>Vendor Registration</h3>
        <p>Add new vendors to the system</p>
        <a href="resi_form.php">Open</a>
    </div>

    <div class="card">
        <h3>Vendor List</h3>
        <p>View, edit, delete vendors</p>
        <a href="vendor_list.php">Open</a>
    </div>

    <div class="card">
        <h3>Partner Registration</h3>
        <p>Add new partners</p>
        <a href="partner_registration.php">Open</a>
    </div>

    <div class="card">
        <h3>Partner List</h3>
        <p>View partner details</p>
        <a href="partner_list.php">Open</a>
    </div>

    <div class="card">
        <h3>Vendor Performance</h3>
        <p>Rate vendor performance</p>
        <a href="vendor_performance.php">Open</a>
    </div>

    <div class="card">
        <h3>Dashboard</h3>
        <p>Analytics & charts</p>
        <a href="dashboard.php">Open</a>
    </div>

</div>

<div class="bottom">
    <a href="logout.php">Logout</a>
</div>

</div>

</body>
</html>
