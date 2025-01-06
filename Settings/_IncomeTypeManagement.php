<?php
require("../dbConnection.php");
$sql = "SELECT * FROM incometypes WHERE isActive='1' ORDER BY createDate DESC";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<div class="col-md-5">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Income Types Form</h5>
		</div>
		<div class="card-body">
			<form class="row row-cols-md-auto align-items-center" id="myform" method="POST" action="AddEditIncomeType.php">
				<input type="hidden" id="id" name="id" class="form-control">
				<div class="col-12">
					<label for="inlineFormInputName2">Income Type</label>
					<input type="text" class="form-control mb-3 mr-sm-2" id="incomeType" name="incomeType">
				</div>

				<div class="col-12">
					<label for="inlineFormInputName">Select to show in incomes</label>
					<select name="isShown" class="form-control mb-3" id="isShown">
						<option selected value="-1">Select to show in incomes...</option>
						<option value="1">Show</option>
						<option value="0">Do not show</option>
					</select>
				</div>
				<div class="col-12">
					<a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('myform');">Submit</a>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Income Types</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th class="d-none d-md-table-cell">Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($result->num_rows > 0) {
							$rowCount=0;
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								$rowCount++;
								echo "<tr><td>{$rowCount}</td><td>{$row['incomeType']}</td><td>{$row['createDate']}</td><td>" .
									"<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['incomeType'] . "\",\"" . $row['isShown'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
									"<a href='../Settings/DeleteIncomeType.php?id=" . urlencode($row['id']) . "' ><i class='align-middle' data-feather='trash'></i></a>" .
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
	$(document).ready(function() {
		$("#myform").validate({
			rules: {
				incomeType: {
					required: true,
				},
				isShown: {
					required: true,
					notEqualToString: "-1"
				}
			},
			messages: {
				incomeType: {
					required: "Income type is required."
				},
				isShown: {
					required: "This is required.",
					notEqualToString: "Please select an option!"
				}
			}
		});


	});

	function ValidateFormAndSubmit(formId) {
		if ($("#" + formId).valid()) {
			$("#" + formId).submit();
		}
	}
</script>
<script>
	function FillFormFromRow(id, incomeType, isShown) {
		$("#id").val(id);
		$("#incomeType").val(incomeType);
		$("#isShown").val(isShown);
	}
</script>