
<?php
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$success = false;

if (isset($_POST['submit'])) {

    $company_name = $_POST['company_name'];
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $address      = $_POST['address1'] . " " . $_POST['address2'];
    $city         = $_POST['city'];
    $state        = $_POST['state'];
    $zip          = $_POST['zip'];

    $query = "INSERT INTO vendors 
    (company_name, first_name, last_name, email, phone, address, city, state, zip)
    VALUES 
    ('$company_name','$first_name','$last_name','$email','$phone','$address','$city','$state','$zip')";

    if (mysqli_query($conn, $query)) {
        $success = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$submitted = false;
if(isset($_POST['submit'])){
    $submitted = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vendor Registration</title>

<style>
body{
    margin:0;
    font-family: "Segoe UI", Arial, sans-serif;
    background:#f3ecd9;
    color:#3b2f2f;
}

/* Container */
.wrapper{
    width:900px;
    margin:40px auto;
    background:#f3ecd9;
}

/* Heading */
h1{
    font-size:36px;
    font-weight:600;
    margin-bottom:10px;
}

hr{
    border:0;
    border-top:1px solid #b9a58a;
    margin:20px 0 40px;
}

/* Form layout */
.form-group{
    margin-bottom:30px;
}

label{
    display:block;
    font-weight:600;
    margin-bottom:8px;
}

input{
    width:420px;
    padding:12px;
    font-size:16px;
    border:1px solid #7a6a58;
    border-radius:6px;
    background:#fff;
}

input:focus{
    outline:none;
    border-color:#3b2f2f;
}

/* Two columns */
.row{
    display:flex;
    gap:40px;
}

.small{
    font-size:14px;
    margin-top:6px;
    color:#6b5c4d;
}

/* Full width */
.full input{
    width:100%;
}

/* Submit button */
button{
    background:#2e1f16;
    color:#fff;
    border:none;
    padding:14px 45px;
    font-size:18px;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#1f140d;
}

/* Success msg */
.success{
    background:#d4edda;
    color:#155724;
    padding:15px;
    margin-bottom:25px;
    border-left:6px solid #28a745;
}
</style>
</head>

<body>

<div class="wrapper">

    <h1>Supplier Information Form</h1>
    <hr>

    <?php if($submitted): ?>
        <div class="success">
            ✔ Vendor registered successfully (Demo – no database)
        </div>
    <?php endif; ?>

    <form method="post">

        <div class="form-group">
            <label>Supplier Company Name</label>
            <input type="text" name="company_name" required>
        </div>

        <div class="form-group">
            <label>Contact Person</label>
            <div class="row">
                <div>
                    <input type="text" name="first_name" required>
                    <div class="small">First Name</div>
                </div>
                <div>
                    <input type="text" name="last_name" required>
                    <div class="small">Last Name</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="example@example.com" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" placeholder="(000) 000-0000" required>
            <div class="small">Please enter a valid phone number.</div>
        </div>

        <div class="form-group full">
            <label>Address</label>
            <input type="text" name="address1" placeholder="Street Address">
            <br><br>
            <input type="text" name="address2" placeholder="Street Address Line 2">
        </div>

        <div class="form-group">
            <div class="row">
                <div>
                    <input type="text" name="city">
                    <div class="small">City</div>
                </div>
                <div>
                    <input type="text" name="state">
                    <div class="small">State / Province</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="text" name="zip">
            <div class="small">Postal / Zip Code</div>
        </div>

        <br>

        <button type="submit" name="submit">Submit</button>

    </form>

</div>

</body>
</html>
