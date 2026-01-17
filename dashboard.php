<?php
session_start();
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* COUNTS */
$total_vendors = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM vendors")
)['total'];

$total_partners = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM partners")
)['total'];

$active_vendors = $total_vendors;
$pending_requests = 0;

/* AVERAGE RATING */
$avg_row = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT AVG(rating) AS avg_rating FROM vendor_performance")
);
$average_rating = $avg_row['avg_rating'] ? round($avg_row['avg_rating'],2) : 0;

/* MINI CHART DATA */
$chart_labels = [];
$chart_values = [];

$chart_sql = "
SELECT v.company_name, AVG(vp.rating) AS avg_rating
FROM vendor_performance vp
JOIN vendors v ON vp.vendor_id = v.id
GROUP BY vp.vendor_id
";

$chart_res = mysqli_query($conn,$chart_sql);
while($r = mysqli_fetch_assoc($chart_res)){
    $chart_labels[] = $r['company_name'];
    $chart_values[] = round($r['avg_rating'],2);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    margin:0;
    font-family:Arial;
    background: linear-gradient(135deg,#e0eafc,#cfdef3);
}
.header{
    background:#2c3e50;
    color:#fff;
    padding:20px 40px;
    font-size:24px;
}
.container{ padding:40px; }
.cards{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:25px;
}
.card{
    padding:30px;
    border-radius:16px;
    color:#fff;
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}
.blue{background:#1e90ff;}
.green{background:#2ed573;}
.orange{background:#ffa502;}
.purple{background:#a55eea;}

.actions{
    margin-top:40px;
    display:flex;
    gap:20px;
}
.actions a{
    text-decoration:none;
    padding:14px 30px;
    background:#2c3e50;
    color:#fff;
    border-radius:30px;
}
</style>
</head>

<body>
    <?php include "header.php"; ?>
<div class="header">Vendor & Partner Management Dashboard</div>

<div class="container">

<div class="cards">
    <div class="card blue">
        <h2><?= $total_vendors ?></h2>
        <p>Total Vendors</p>
    </div>

    <div class="card green">
        <h2><?= $active_vendors ?></h2>
        <p>Active Vendors</p>
    </div>

    <div class="card orange">
        <h2><?= $total_partners ?></h2>
        <p>Total Partners</p>
    </div>

    <div class="card purple">
        <h2><?= $pending_requests ?></h2>
        <p>Pending Requests</p>
    </div>

    <div class="card purple">
        <h2><?= $average_rating ?> / 5</h2>
        <p>Average Vendor Rating</p>
    </div>
</div>

<div class="actions">
    <a href="resi_form.php">+ Add Vendor</a>
    <a href="vendor_list.php">View Vendors</a>
    <a href="home.php">Project Home</a>
    <a href="logout.php">Logout</a>
</div>

<!-- MINI CHART -->
<div style="margin-top:50px;background:#fff;padding:30px;border-radius:16px;">
    <h3>Vendor Rating Overview</h3>
    <div style="height:300px;">
        <canvas id="miniRatingChart"></canvas>
    </div>
</div>

</div>

<script>
new Chart(document.getElementById('miniRatingChart'),{
    type:'bar',
    data:{
        labels: <?= json_encode($chart_labels) ?>,
        datasets:[{
            data: <?= json_encode($chart_values) ?>,
            backgroundColor:'#6c5ce7'
        }]
    },
    options:{
        scales:{ y:{ beginAtZero:true, max:5 }},
        plugins:{ legend:{ display:false }}
    }
});
</script>

</body>
</html>
