<!DOCTYPE html>
<html>
<head>
	<title>HR - GMRC</title>
	<?php 

		//Set here the module name, so assets/scripts/dependencies will be loaded
		$module = 'income';	 
		include('Includes/includes.php');

		//Instantiations
		$incomeModel = new \Classes\Model\IncomeModel;
				
	?>
</head>
<body>
	<div class="income-wrapper">
			<section class="compute-income">
				<div class="compute-income-container">
					<form id="computeIncomeForm">
						<table class="table table1" border =1>
							<tr>
								<th colspan="2"> Compute Income</th>
							</tr>
							<tr>
								<td>Total Hours:</td>
								<td> <input type="text" name="totalHours"/></td>
							</tr>
							<tr>	
								<td>Salary Type:</td>
								<td>
									<select class='salaryTypeOption' name="salaryType">	
									<?php
										$salaryType = $incomeModel->getSalaryType();
										foreach ($salaryType as $key => $value) {  //loop ?>

										<option value="<?php echo $value['salary_computation']; ?>">
											<?php echo $value['salary_type']; ?>	
										</option>
									<?php } //end loop?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Total Deductions:</td>
								<td><input type="text" name="totalDeductions" readonly></td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="btn btn-save center save-computed-income-js">Save</div>
								</td>
							</tr>
						</table>

					</form>
				</div>
			</section>

			<section class='add-ons'>
				<div class="add-income-container m-t-md">
					<table>
						<tr>
							<th colspan="2">Add Income </th>
						</tr>
						<tr>
							<td><input type="text" name="incomeName" placeholder="Income name"></td>
							<td><input type="text" name="incomePrice" placeholder="Income price"></td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="btn btn-save center add-new-income-js">Add more</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="add-deduction-container m-t-md">
					<table>
						<tr>
							<th colspan="2">Add Income </th>
						</tr>
						<tr>
							<td><input type="text" name="deductionName" placeholder="Deduction name"></td>
							<td><input type="text" name="deductionPrice" placeholder="Deduction price"></td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="btn btn-save center add-new-deduction-js">Add more</div>
							</td>
						</tr>
					</table>
				</div>
			</section>
	</div>
	<script src="scripts/jquery-v2.1.0.js"></script>
</body>
</html>