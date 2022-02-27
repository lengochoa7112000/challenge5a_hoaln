<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Quản lý sinh viên</title>
</head>
<body>

<?php
    session_start();
    if (isset($_SESSION['username'])) {
        include("connect.php");
        $username = $_SESSION['username'];
        $sql = "SELECT id, role FROM member WHERE username = '$username'";
        $result = $connect->query($sql);
        $row = mysqli_fetch_array($result);
    } else {
        header("location:login.php");
    }

?>

<a href="index.php">Trang chủ<br></a>
<a href="profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Profile<br></a>
<a href="member.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Members<br></a>
<a href="message_received.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Message Received<br></a>
<?php
    if ($row['role'] === "teacher") {
        echo '<a href="teacher_exercise.php">View exercise<br></a>';
    }
    if ($row['role'] === "student") {
        echo '<a href="student_exercise.php">My exercise<br></a>';
    }
?>
<?php
    if ($row['role'] === "teacher") {
        echo '<a href="teacher_challenge.php">Upload challenges<br></a>';
    }
    if ($row['role'] === "student") {
        echo '<a href="student_challenge.php">My challenges<br></a>';
    }
?>
<a href="logout.php">Log out<br></a>


</body>
</html>