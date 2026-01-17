<?php
session_start();
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // फक्त username check
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        // HASHED password verify
        if(password_verify($password, $row['password'])){
            $_SESSION['admin'] = $row['username'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid Username or Password";
        }
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#667eea,#764ba2);
}
.login-box{
    width:400px;
    margin:120px auto;
    background:#fff;
    padding:40px;
    border-radius:12px;
    box-shadow:0 20px 35px rgba(0,0,0,0.3);
}
h2{text-align:center;margin-bottom:30px;}
input{
    width:100%;
    padding:12px;
    margin-bottom:20px;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:12px;
    background:#2c3e50;
    color:#fff;
    border:none;
    font-size:18px;
    border-radius:30px;
}
.error{
    background:#f8d7da;
    color:#721c24;
    padding:10px;
    margin-bottom:15px;
}
</style>
</head>

<body>

<div class="login-box">
<h2>Admin Login</h2>

<?php if($error): ?>
<div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>
