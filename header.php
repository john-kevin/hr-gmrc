<?php
	session_start();
	if(!isset($_SESSION['user_details']['user_id'])){
		// header('Location: index.php');
	}
	require("dbConnect.php");
?>
<div>
	<form action="schedule.php" method="POST">
		<button type="submit" name="schedule">Schedule</button>
	</form>	
	<form action="salary.php" method="POST">
		<button type="submit" name="salary">Salary</button>
	</form>	
	<?php if($_SESSION['user_details']['user_type'] != '0'){ ?>
		<form action="profile.php" method="POST">
			<button type="submit" name="profile">Profile</button>
		</form>
	<?php }else{ ?>
		<form action="pay-computer.php" method="POST">
			<button type="submit" name="compute_pay">Compute Pay</button>
		</form>
		<form action="salary-type.php" method="POST">
			<button type="submit" name="salary_type">Salary Type</button>
		</form>
	<?php } ?>
	<form action="logout.php" method="POST">
		<button type="submit" name="logout">Logout</button>
	</form>
</div>