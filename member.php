<?php
include("connect.php");
session_start();


if (isset($_SESSION['username'])) {
    include("connect.php");
    $username = $_SESSION['username'];
    $sql = "SELECT id, role FROM member WHERE username = '$username'";
    $result = $connect->query($sql);
    $row = mysqli_fetch_array($result);
    $sql_student = "SELECT username, email, fullname, phone, role, id FROM member";
    $result_student = $connect->query($sql_student);
} else {
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Danh sách</title>
    <style type="text/css">
        table, th, td{
            border:1px solid #868585;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th, td{
            text-align:left;
            padding:10px;
        }
        table tr:nth-child(odd){
            background-color:#eee;
        }
        table tr:nth-child(even){
            background-color:white;
        }
        table tr:nth-child(1){
            background-color:#4CAF50;
        }
    </style>
</head>
<body>

<h1>Members</h1>
<table>
    <tr>
        <th>Username</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Action for teacher</th>
        <th>Message</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result_student)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td><a href="edit_profile.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">edit</a></td>
            <td><a href="send_message.php?recipient=<?php echo $row['username']; ?>">Write</a> <a href="edit_message.php?recipient=<?php echo $row['username']; ?>">Edit</a></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>