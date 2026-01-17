<?php
include "db.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* Fetch average rating per vendor */
$query = "
SELECT v.company_name, AVG(vp.rating) AS avg_rating
FROM vendor_performance vp
JOIN vendors v ON vp.vendor_id = v.id
GROUP BY vp.vendor_id
";

$result = mysqli_query($conn, $query);

$vendors = [];
$ratings = [];

while($row = mysqli_fetch_assoc($result)){
    $vendors[] = $row['company_name'];
    $ratings[] = round($row['avg_rating'], 2);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Vendor Rating Chart</title>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    font-family:Arial;
    background:#eef2f3;
}
.container{
    width:900px;
    margin:50px auto;
    background:#fff;
    padding:40px;
    border-radius:15px;
    box-shadow:0 20px 35px rgba(0,0,0,0.25);
}
h2{
    text-align:center;
    margin-bottom:30px;
}
</style>
</head>

<body>
<?php include "header.php"; ?>
<div class="container">
<h2>Vendor Performance Rating Chart</h2>

<canvas id="ratingChart"></canvas>

</div>

<script>
const ctx = document.getElementById('ratingChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($vendors); ?>,
        datasets: [{
            label: 'Average Rating',
            data: <?php echo json_encode($ratings); ?>,
            backgroundColor: [
                '#6c5ce7','#00b894','#0984e3','#fdcb6e','#e17055'
            ],
            borderRadius: 8
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 5
            }
        }
    }
});
</script>

</body>
</html>
