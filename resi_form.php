<?php
include "db.php";
require_once 'fpdf186/fpdf.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Admin security */
// if(!isset($_SESSION['admin'])){
//     header("Location: admin_login.php");
//     exit();
// }

$success = "";
$error = "";

if(isset($_POST['submit'])){
    $company_name = $_POST['company_name'];
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $address      = $_POST['address'];
    $city         = $_POST['city'];
    $state        = $_POST['state'];
    $zip          = $_POST['zip'];
  $vendorfile = $_FILES['pdf_file']['name'];
$tmpName    = $_FILES['pdf_file']['tmp_name'];
$fileType   = pathinfo($vendorfile, PATHINFO_EXTENSION);

// Allow only PDF
if($fileType != 'pdf'){
    die("Only PDF files allowed");
}

// Create folder
if (!is_dir('documents')) {
    mkdir('documents', 0777, true);
}

// Save uploaded PDF
$uploadPath = "documents/" . time() . "_" . $vendorfile;
move_uploaded_file($tmpName, $uploadPath);

// CREATE PDF USING FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Vendor Document:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,10,$vendorfile);

// Save generated PDF
$pdf->Output('F', 'documents/vendor_info.pdf');




echo "PDF created and saved successfully.";
    $query = "INSERT INTO vendors 
    (company_name, first_name, last_name, email, phone, address, city, state, zip)
    VALUES 
    ('$company_name','$first_name','$last_name','$email','$phone','$address','$city','$state','$zip')";

    if(mysqli_query($conn, $query)){
        $success = "Vendor registered successfully";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Vendor Registration</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background: linear-gradient(135deg,#e0eafc,#cfdef3);
}

.container{
    width:900px;
    margin:50px auto;
    background:#fff;
    padding:50px;
    border-radius:16px;
    box-shadow:0 20px 35px rgba(0,0,0,0.25);
}

h1{
    text-align:center;
    margin-bottom:30px;
}

label{
    font-weight:bold;
}

input, textarea{
    width:100%;
    padding:12px;
    margin:8px 0 20px;
    border-radius:6px;
    border:1px solid #ccc;
}

.row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:15px;
    margin-bottom:20px;
    border-left:6px solid #28a745;
}

.error{
    background:#f8d7da;
    color:#721c24;
    padding:15px;
    margin-bottom:20px;
    border-left:6px solid #dc3545;
}

button{
    padding:14px 45px;
    font-size:18px;
    border:none;
    border-radius:30px;
    background:#2c3e50;
    color:#fff;
    cursor:pointer;
}

button:hover{
    background:#1a252f;
}
</style>
</head>

<body>
    <?php include "header.php"; ?>
<div class="container">
<h1>Vendor Registration</h1>

<?php if($success): ?>
<div class="success"><?= $success ?></div>
<?php endif; ?>

<?php if($error): ?>
<div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

<label>Company Name</label>
<input type="text" name="company_name" required>

<div class="row">
    <div>
        <label>First Name</label>
        <input type="text" name="first_name" required>
    </div>
    <div>
        <label>Last Name</label>
        <input type="text" name="last_name" required>
    </div>
</div>

<label>Email</label>
<input type="email" name="email" required>

<label>Phone</label>
<input type="text" name="phone" required>

<label>Address</label>
<textarea name="address" rows="3"></textarea>

<div class="row">
    <div>
        <label>City</label>
        <input type="text" name="city">
    </div>
    <div>
        <label>State</label>
        <input type="text" name="state">
    </div>
</div>

<label>Zip Code</label>
<input type="text" name="zip">
<label for="pdf_file">vendor docu</label>
<input type="file" name="pdf_file" accept="application/pdf" required>

<button type="submit" name="submit">Register Vendor</button>

</form>
</div>

</body>
</html>
