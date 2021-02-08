<?php
require("../dbConnection.php");
$sql = "SELECT * FROM announcements WHERE isActive='1' ORDER BY createDate DESC";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<h1 class="h3 mb-3">Announcement Management</h1>
<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Announcement Add/Edit Form</h5>
			</div>
			<div class="card-body">
				<form method="post" action="AddEditAnnouncement.php">
					<input type="hidden" id="id" name="id" class="form-control">

					<div class="mb-3">
						<label class="form-label">Title</label>
						<input type="text" class="form-control" placeholder="Title" id="Title" name="Title">
					</div>
					<div class="mb-3">
						<label class="form-label">Content</label>
						<textarea type="text" class="form-control" placeholder="Content" rows="5" id="Content" name="Content"></textarea>
					</div>
					<button type="submit" class="btn btn-info align-self-end">Submit</button></br>
				</form>

			</div>

		</div>
	</div>
</div>

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
							<th>Title</th>
							<th>Content</th>
							<th class="d-none d-md-table-cell">Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($result->num_rows > 0) {
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								echo "<tr><td>{$row['title']}</td><td >{$row['content']}</td><td>{$row['createDate']}</td><td>".
								"<a class='mr-3' href='#' onclick='FillFormFromRow(\"".$row['id']."\",\"".$row['title']."\",\"".$row['content']."\")'><i class='align-middle' data-feather='edit-2'></i></a>".
								"<a href='../Announcements/DeleteAnnouncement.php?id=".urlencode($row['id'])."' ><i class='align-middle' data-feather='trash'></i></a>".
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
	function FillFormFromRow(id, title, content){
		$("#id").val(id);
		$("#Title").val(title);
		$("#Content").val(content);
	}
</script>