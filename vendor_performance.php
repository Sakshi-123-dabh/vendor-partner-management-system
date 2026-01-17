<?php
include "db.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$success = false;

if(isset($_POST['submit'])){
    $vendor_id = $_POST['vendor_id'];
    $rating    = $_POST['rating'];
    $feedback  = $_POST['feedback'];
    $date      = date("Y-m-d");

    $q = "INSERT INTO vendor_performance 
          (vendor_id, rating, feedback, evaluation_date)
          VALUES 
          ('$vendor_id','$rating','$feedback','$date')";

    if(mysqli_query($conn,$q)){
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Vendor Performance Evaluation</title>
<style>
body{font-family:Arial;background:#eef2f3;}
.container{
    width:800px;margin:50px auto;background:#fff;
    padding:50px;border-radius:15px;
    box-shadow:0 20px 35px rgba(0,0,0,0.25);
}
h1{text-align:center;margin-bottom:30px;}
label{font-weight:bold;}
select,textarea{
    width:100%;padding:12px;margin-bottom:20px;
    border-radius:6px;border:1px solid #ccc;
}
.rating input{margin-right:10px;}
.success{
    background:#d4edda;color:#155724;
    padding:15px;margin-bottom:20px;
    border-left:6px solid #28a745;
}
button{
    padding:14px 40px;background:#2c3e50;
    color:#fff;border:none;border-radius:30px;
    font-size:18px;
}/* Star Rating */
.star-rating{
    direction: rtl;
    display: inline-flex;
    font-size: 35px;
}

.star-rating input{
    display: none;
}

.star-rating label{
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s;
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label{
    color: #f5b301;
}

</style>
</head>

<body>
<?php include "header.php"; ?>
<div class="container">
<h1>Vendor Performance Evaluation</h1>

<?php if($success): ?>
<div class="success">✔ Performance recorded successfully</div>
<?php endif; ?>

<form method="post">

<label>Select Vendor</label>
<select name="vendor_id" required>
    <option value="">-- Select Vendor --</option>
    <?php
    $vendors = mysqli_query($conn,"SELECT id, company_name FROM vendors");
    while($v = mysqli_fetch_assoc($vendors)){
        echo "<option value='{$v['id']}'>{$v['company_name']}</option>";
    }
    ?>
</select>

<label>Rating</label>
<div class="star-rating">
    <input type="radio" id="star5" name="rating" value="5" required>
    <label for="star5">★</label>

    <input type="radio" id="star4" name="rating" value="4">
    <label for="star4">★</label>

    <input type="radio" id="star3" name="rating" value="3">
    <label for="star3">★</label>

    <input type="radio" id="star2" name="rating" value="2">
    <label for="star2">★</label>

    <input type="radio" id="star1" name="rating" value="1">
    <label for="star1">★</label>
</div>


<br>

<label>Feedback</label>
<textarea name="feedback" rows="4" placeholder="Enter performance feedback"></textarea>

<button type="submit" name="submit">Submit Evaluation</button>

</form>
</div>

</body>
</html>
