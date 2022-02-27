<!DOCTYPE html> 
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <link rel="stylesheet" href="style.css"/> 
    </head> 
    <body> 
        <form action='login.php' class="form" method='POST'> 
            Username: <input type='text' name='username' required/> 
            Password: <input type='password' name='password' required/>
            <a href="register.php">Register</a>
            <input type='submit' class="button" name="dangnhap" value='Đăng nhập' /> 
        <form>
    </body> 
</html>

<?php
    session_start();
    header('Content-Type: text/html; charset=UTF-8');

    if (isset($_POST['dangnhap'])) {
    $connect = mysqli_connect ('localhost', 'root', '', 'user');
    mysqli_set_charset($connect, 'UTF8');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM member WHERE username='$username'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_array($result);

        if ($password != $row['password']) {
        echo "Password wrong. Try again!";
        exit();
        } else {

            $_SESSION['username'] = $username;
            header("location:index.php");
        }
    } else {
    echo "The username doesn't consist!";
    }

    $connect->close();
    }
?>