<?php
include "db.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Partner List</title>
<style>
body{font-family:Arial;background:#eef2f3;}
.header{background:#2c3e50;color:#fff;padding:20px;font-size:22px;}
.container{padding:40px;}
table{
    width:100%;background:#fff;border-collapse:collapse;
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}
th,td{padding:14px;text-align:left;}
th{background:#34495e;color:#fff;}
tr:nth-child(even){background:#f2f2f2;}
a{color:#2c3e50;text-decoration:none;font-weight:bold;}
</style>
</head>

<body>
    <?php include "header.php"; ?>
<div class="header">Partner List</div>

<div class="container">
<a href="partner_registration.php">+ Add Partner</a>
<br><br>

<table>
<tr>
    <th>ID</th>
    <th>Company</th>
    <th>Type</th>
    <th>Contact</th>
    <th>Email</th>
    <th>Phone</th>
    <th>City</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM partners");
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['company_name']}</td>";
        echo "<td>{$row['partner_type']}</td>";
        echo "<td>{$row['contact_person']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['city']}</td>";
        echo "<td>
            <a href='partner_edit.php?id={$row['id']}'>Edit</a> |
            <a href='partner_delete.php?id={$row['id']}'
               onclick=\"return confirm('Delete this partner?')\">Delete</a>
        </td>";
        echo "</tr>";
    }
}else{
    echo "<tr><td colspan='8'>No partners found</td></tr>";
}
?>
</table>
</div>
</body>
</html>
