<?php

//SESSION
if(!isset($_SESSION)){
    session_start();
}

// XAMPP CONNECTION
include_once("connections/connection.php");
$con = connection();

// LOGIN VERIFICATION
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login_list WHERE username = '$username' AND password = '$password'";
    $user = $con-> query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total > 0){
        $_SESSION['AdminLogin'] = $row['username'];
        $_SESSION['Access'] = $row['role'];

        echo header("Location: index.php");
    }else{
        echo "<script>alert('INVALID CREDENTIALS!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Earist Logo">
        </div>
        <div class="name">
            <h1>REGISTRAR QUEUEING SYSTEM</h1>
        </div>
    </nav>

    <div class="loginForm">
        <form class="box" action="" method="post">
            <br>
            <h1>Welcome ADMIN!</h1>
            <input id="username" type="text" name="username" placeholder="Enter Username" required><br>
            <input id="password" type="text" name="password" placeholder="Enter Password" required><br>
            <input type="submit" name="login" value="Login"><br>
        </form>
    </div>

    <div class="contact">
        <p>- Contact Developer -</p>
        <ul class="dev-socials">
            <li><a href="https://www.facebook.com/markee2301" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="https://www.instagram.com/super.markee" target="_blank"><i class="fa-brands fa-square-instagram"></i></a></li>
            <li><a href="https://www.twitter.com/markee2301" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="mailto:navarro.m.bscs@gmail.com" target="_blank"><i class="fa-solid fa-envelope"></i></a></li>
        </ul>
    </div>

</body>
</html>