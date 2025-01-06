<?php
require("../dbConnection.php");
$sql = "SELECT * FROM announcements WHERE isActive='1' ORDER BY createDate DESC";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Announcements</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Content</th>
							<th class="d-none d-md-table-cell">Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($result->num_rows > 0) {
							$rowCount=0;
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								$rowCount++;
								echo "<tr><td>{$rowCount}</td><td>{$row['title']}</td><td >{$row['content']}</td><td>{$row['createDate']}</td></tr>";
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