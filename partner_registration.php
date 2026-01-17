<?php
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$success = false;

if(isset($_POST['submit'])){
    $company_name   = $_POST['company_name'];
    $partner_type   = $_POST['partner_type'];
    $contact_person = $_POST['contact_person'];
    $email          = $_POST['email'];
    $phone          = $_POST['phone'];
    $city           = $_POST['city'];
    $state          = $_POST['state'];

    $query = "INSERT INTO partners
    (company_name, partner_type, contact_person, email, phone, city, state)
    VALUES
    ('$company_name','$partner_type','$contact_person','$email','$phone','$city','$state')";

    if(mysqli_query($conn,$query)){
        $success = true;
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Partner Registration</title>
<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#fdfbfb,#ebedee);
}
.container{
    width:850px;
    margin:50px auto;
    background:#fff;
    padding:50px;
    border-radius:15px;
    box-shadow:0 20px 35px rgba(0,0,0,0.25);
}
h1{text-align:center;margin-bottom:30px;}
label{font-weight:bold;}
input,select{
    width:100%;
    padding:12px;
    margin:8px 0 20px;
    border-radius:6px;
    border:1px solid #ccc;
}
.success{
    background:#d4edda;
    color:#155724;
    padding:15px;
    margin-bottom:20px;
    border-left:6px solid #28a745;
}
button{
    padding:14px 40px;
    border:none;
    background:#2c3e50;
    color:#fff;
    font-size:18px;
    border-radius:30px;
    cursor:pointer;
}
button:hover{background:#1a252f;}
</style>
</head>

<body>
<?php include "header.php"; ?>
<div class="container">
<h1>Partner Registration</h1>

<?php if($success): ?>
<div class="success">✔ Partner Registered Successfully</div>
<?php endif; ?>

<form method="post">

<label>Partner Company Name</label>
<input type="text" name="company_name" required>

<label>Partner Type</label>
<select name="partner_type" required>
    <option value="">-- Select --</option>
    <option>Technology Partner</option>
    <option>Business Partner</option>
    <option>Service Partner</option>
</select>

<label>Contact Person</label>
<input type="text" name="contact_person" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Phone</label>
<input type="text" name="phone" required>

<label>City</label>
<input type="text" name="city">

<label>State</label>
<input type="text" name="state">

<button type="submit" name="submit">Register Partner</button>

</form>
</div>

</body>
</html>
