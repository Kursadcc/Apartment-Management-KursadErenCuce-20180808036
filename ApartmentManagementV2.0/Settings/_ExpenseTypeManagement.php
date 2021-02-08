<?php
require("../dbConnection.php");
$sql = "SELECT * FROM esxpensetypes WHERE isActive='1' ORDER BY createDate DESC";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<div class="col-md-5">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Expense Types Form</h5>
		</div>
		<div class="card-body">
			<form class="row row-cols-md-auto align-items-center" method="POST" action="AddEditExpenseType.php">
				<input type="hidden" id="id" name="id" class="form-control">
				<div class="col-12">
					<label for="inlineFormInputName2">Expense Type</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="expenseType">
				</div>

				<div class="col-12">
					<label  for="inlineFormInputName">Select to show in expenses</label>
					<select name="isShown" class="form-control mb-3" id="isShown">
						<option selected>Select...</option>
						<option value="1">Show</option>
						<option value="0">Do not show</option>
					</select>
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-info align-self-end">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Expense Types</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th class="d-none d-md-table-cell">Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($result->num_rows > 0) {
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								echo "<tr><td>{$row['expenseType']}</td><td>{$row['createDate']}</td><td>".
								"<a class='mr-3' href='#' onclick='FillFormFromRow(\"".$row['id']."\",\"".$row['expenseType']."\",\"".$row['isShown']."\")'><i class='align-middle' data-feather='edit-2'></i></a>".
								"<a href='../Settings/DeleteExpenseType.php?id=".urlencode($row['id'])."' ><i class='align-middle' data-feather='trash'></i></a>".
								"</td></tr>";
							}
						} else {
							echo "0 results";
						}
						$connection->close();

						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
<script>
	function FillFormFromRow(id, expenseType, isShown){
		$("#id").val(id);
		$("#inlineFormInputName2").val(expenseType);
		$("#isShown").val(isShown);
	}
</script>