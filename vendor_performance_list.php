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
<title>Vendor Performance List</title>
<style>
body{font-family:Arial;background:#eef2f3;}
.container{padding:40px;}
table{
    width:100%;background:#fff;border-collapse:collapse;
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}
th,td{padding:14px;text-align:left;}
th{background:#34495e;color:#fff;}
tr:nth-child(even){background:#f2f2f2;}
</style>
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
<h2>Vendor Performance Records</h2>

<table>
<tr>
    <th>Vendor</th>
    <th>Rating</th>
    <th>Feedback</th>
    <th>Date</th>
</tr>

<?php
$q = "SELECT vp.rating, vp.feedback, vp.evaluation_date, v.company_name
      FROM vendor_performance vp
      JOIN vendors v ON vp.vendor_id = v.id";

$res = mysqli_query($conn,$q);

while($row = mysqli_fetch_assoc($res)){
    echo "<tr>";
    echo "<td>{$row['company_name']}</td>";
    echo "<td>{$row['rating']}/5</td>";
    echo "<td>{$row['feedback']}</td>";
    echo "<td>{$row['evaluation_date']}</td>";
    echo "</tr>";
}
?>
</table>
</div>

</body>
</html>
