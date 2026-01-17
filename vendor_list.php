<?php
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vendor List</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background: linear-gradient(135deg,#e0eafc,#cfdef3);
}

/* Header */
.header{
    background:#2c3e50;
    color:#fff;
    padding:20px 40px;
    font-size:24px;
    letter-spacing:1px;
}

/* Container */
.container{
    padding:40px;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 15px 30px rgba(0,0,0,0.25);
}

th, td{
    padding:14px;
    text-align:left;
    font-size:15px;
}

th{
    background:#34495e;
    color:#fff;
}

tr:nth-child(even){
    background:#f2f2f2;
}

tr:hover{
    background:#dfe6e9;
}

/* Buttons */
.actions{
    margin-bottom:25px;
}

.actions a{
    text-decoration:none;
    padding:12px 28px;
    background:#2c3e50;
    color:#fff;
    border-radius:30px;
    font-size:15px;
    margin-right:10px;
    transition:0.3s;
}

.actions a:hover{
    background:#1a252f;
    transform:scale(1.05);
}
</style>
</head>

<body>
    <?php include "header.php"; ?>

<div class="header">
    Vendor List
</div>

<div class="container">

    <div class="actions">
       
        <a href="dashboard.php">Dashboard</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>State</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM vendors");

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['company_name']."</td>";
                echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['city']."</td>";
                echo "<td>".$row['state']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;'>No vendors found</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>
