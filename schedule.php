<link rel="stylesheet" href="css/jquery.timepicker.min.css">
<?php include "header.php" ?>
<?php 
	print_r($list); die;
	$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
	$filterResults = [];
	$filterResultsError = 'No results found';
	if(isset($_POST['add'])){
		$scheduleName = $_POST['schedule-type'];
		$error = [];
		foreach($_POST['schedule'] as $key => $row){
			$start = strtotime($row[0]);
			$end = strtotime($row[1]);
			$computation = $start-$end;
			if($computation > 0){
				$error[$key] = 'Start time must not be later than end time';
			}else if($computation == 0){
				$error[$key] = 'Start time must not be equal to the end time';
			}
		}
		$schedule = json_encode($_POST['schedule']);
		$createdBy = $_SESSION['user_details']['user_id']; 
		$q = "INSERT INTO schedule (schedule_name, schedule, created_by)
							VALUES ('$scheduleName', '$schedule', '$createdBy')";
			
		$result = @mysqli_query ($dbcon, $q);
	}
	if(isset($_POST['filter'])){
		$filterSchedule = $_POST['filter-schedule'];
		$query="SELECT * FROM employee 
			LEFT JOIN employee_schedule ON employee.employee_id = employee_schedule.employee_id 
			LEFT JOIN schedule ON employee_schedule.schedule_id = schedule.schedule_id 
			WHERE schedule.schedule_name = '$filterSchedule'";
		$result = mysqli_query($dbcon, $query);
		if(!$result){ 
			$filterResultsError = 'No results found';
		}else{
			while($row=mysqli_fetch_array($result)){
				$filterResults[] = $row;
			}
		}
	}
?>
<div>
	<?php if($_SESSION['user_details']['user_type'] == '0'){ ?>
		<form action="schedule.php" method="POST">
			<label>Schedule type</label>
			<select name="filter-schedule">
			<?php
				$query="SELECT * FROM schedule";
				$result = mysqli_query($dbcon, $query);
				while($row=mysqli_fetch_array($result)){
					echo '<option value="'.$row['schedule_name'].'">'.$row['schedule_name'].'</option>';
				}
			?>
			</select>
			<button type="submit" name="filter">Filter</button>
		</form>
		<div>
			<?php if(count($filterResults) > 0){ ?>
			<?php }else{ echo $filterResultsError; }?>
		</div>
	<?php }else{ ?>
		
	<?php } ?>
</div>
<?php if($_SESSION['user_details']['user_type'] == '0'){ ?>
<hr></hr>
<div>
	<form action="schedule.php" method="POST" id="add-form">
		<label>Schedule Type</label>
		<input class="type" type="text" name="schedule-type" value="<?php echo isset($_POST['schedule-type'])? $_POST['schedule-type'] : '' ?>">
		
		<div class="details-load">
			<?php foreach($days as $day) { ?>
				<br><br>
				<label><?php echo ucfirst($day); ?> :</label>
				<input class="times" type="text" name="schedule[<?php echo $day; ?>][]" value="<?php echo isset($_POST['schedule'][$day][0])? $_POST['schedule'][$day][0] : '' ?>"> - 
				<input class="times" type="text" name="schedule[<?php echo $day; ?>][]" value="<?php echo isset($_POST['schedule'][$day][1])? $_POST['schedule'][$day][1] : '' ?>">
				<br>
				<label><?php echo isset($error[$day])? $error[$day] : '' ?></label>
			<?php } ?>
		</div>
		<br><br>
		<button type="submit" class="add-schedule" name="add">Add New Schedule</button>
	</form>
</div>
<?php } ?>

<script src="scripts/jquery-1.8.3.min.js"></script>
<script src="scripts/jquery.timepicker.min.js"></script>
<script>
	$(document).ready(function(){
		$('.times').timepicker({ 'timeFormat': 'H:i:s' });
		$('.times').on('keypress', function(e){
			var regex = new RegExp("^[0-9:]+$");
            var key = String.fromCharCode(e.charCode ? e.which : e.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
		});
		$('.type').on('keypress', function(e){
			var regex = new RegExp("^[0-9a-zA-Z]+$");
            var key = String.fromCharCode(e.charCode ? e.which : e.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
		});
	});
</script>