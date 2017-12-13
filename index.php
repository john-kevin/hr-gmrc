<?php
	require("dbConnect.php");
	session_start();
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = sha1($_POST['password']);
		$query="SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$result = mysqli_query($dbcon, $query);
			$row=mysqli_fetch_array($result);
			if(count($row) > 0){ 
				$_SESSION['user_details'] = $row;
				header('Location: home.php');
			}else{
				echo 'No such user';
			}
	}
?>
<form action="index.php" method="POST">
	<label for="username">Employee Id :</label>
	<input type="text" name="username" id="username">
	<br><br>
	<label for="password">Password :</label>
	<input type="password" name="password" id="password">
	<br><br>
	<button type="submit" name="submit">Login</button>
</form>