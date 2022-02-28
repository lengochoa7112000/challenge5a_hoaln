<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	}
    include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>List</title>
</head>
<body>

<?php

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	if (isset($_POST["submit"])) {
		$fullname = $_POST["fullname"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$sql_update = "UPDATE member SET fullname = '$fullname', password = '$password', email = '$email', phone = '$phone' WHERE id = '$id'";
		$connect->query($sql_update);
		echo '<script language="javascript">alert("Profile edited!"); window.location="member.php"</script>';
	}

	if (isset($_GET['role'])) {
		$role = $_GET['role'];
	}

	$username = $_SESSION['username'];
	$sql_check_role = "SELECT role, username FROM member WHERE username = '$username'";
	$result = $connect->query($sql_check_role);
	$row = mysqli_fetch_array($result);
	if ($row['role'] === "student") {
		if ($username != $row['username']) {
			echo '<script language="javascript">alert("You don\'t have permision!"); history.back()</script>';
		}
	} elseif ($row['role'] != "teacher") {
		echo '<script language="javascript">alert("You don\'t have permision!"); history.back()</script>';
	}

?>

	<form action="edit_profile.php?id=<?php echo $id; ?>&role=<?php echo $role; ?>" method="post">
		<table>
			<tr>
				<td>
					<h3>Edit information of students</h3>
				</td>
			</tr>
			<?php
			$sql = "SELECT * FROM member WHERE id = ".$id;
			$result = $connect->query($sql);
			$row = mysqli_fetch_array($result);
			$username = $row['username'];
			?>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" value="<?php echo $row['username']; ?>" disabled=""></td>
				
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
			</tr>
				<td>Full name:</td>
				<td><input type="text" name="fullname" value="<?php echo $row['fullname']; ?>"></td>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td>
			</tr>
			<tr>
				<td>Mobile:</td>
				<td><input type="text" name="phone" value="<?php echo $row['phone']; ?>"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Save"></td>
			</tr>

		</table>
	</form>

</body>
</html>
