<?php
require("../dbConnection.php");
$sql = "SELECT * FROM flats";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>

<div class="col-5">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Add Flat Form</h5>
    </div>
    <div class="card-body">
      <form class="row row-cols-md-auto align-items-center" method="POST" action="AddEditFlat.php">
        <input type="hidden" id="id" name="id" class="form-control">
        <div class="col-12">
          <label for="inlineFormInputName2">Owner Name</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="ownerName" name="ownerName">
        </div>
        <div class="col-12">
          <label for="inlineFormInputName2">Owner Phone Number</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="ownerPhoneNumber" name="ownerPhoneNumber">
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
        <h5 class="card-title">Flats</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Door Number</th>
              <th>Owner Name</th>
              <th>Owner Phone Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr><td>NO: {$row['doorNumber']}</td><td>{$row['ownerName']}</td><td>{$row['ownerPhoneNumber']}</td><td>" .
                  "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['doorNumber'] . "\",\"" . $row['ownerName'] . "\",\"" . $row['ownerPhoneNumber'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
                  "<a href='../Settings/DeleteFlat.php?id=" . urlencode($row['id']) . "' ><i class='align-middle' data-feather='trash'></i></a>" .
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
	function FillFormFromRow(id, doorNumber, ownerName, ownerPhoneNumber){
		$("#id").val(id);
		$("#doorNumber").val(doorNumber);
		$("#ownerName").val(ownerName);
    $("#ownerPhoneNumber").val(ownerPhoneNumber);
	}
</script>