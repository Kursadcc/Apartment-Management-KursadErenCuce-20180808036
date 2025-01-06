<?php
require("../dbConnection.php");
$sql = "SELECT * FROM dues";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<?php
//if ($errorMessage != null) {
 //   if ($errorMessage != "") {
  //      echo "<span class='error'>" . $errorMessage . "</span>";
    //}
//}
?>

<div class="col-12 col-sm-6 col-md-6 col-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add Due Form</h5>
        </div>
        <div class="card-body">
            <form class="" id="myform" method="POST" action="AddEditDue.php">
                <input type="hidden" id="id" name="id" class="form-control">
                <div class="row">
                    <div class="col-12">
                        <label for="inlineFormInputName2">Amount</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="amount" name="amount" style="max-width:150px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label for="inlineFormInputName2">Month</label>
                        <select name="month" id="month" class="form-control mb-3">
                            <option selected value="-1">Select Month...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="inlineFormInputName2">Year</label>
                        <select name="year" id="year" class="form-control mb-3">
                            <option selected value="-1">Select Year...</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('myform');">Submit</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Dues</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th class="d-none d-md-table-cell">Amount</th>
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
                                echo "<tr><td>{$rowCount}</td><td>{$row['year']}</td><td >{$row['month']}</td><td>{$row['amount']} ₺</td><td>" .
                                    "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['year'] . "\",\"" . $row['month'] . "\",\"" . $row['amount'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
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
                amount: {
                    required: true,
                    number: true
                },
                month:{
                    required: true,
                    notEqualToString: "-1"
                },
                year:{
                    required: true,
                    notEqualToString: "-1"
                }
            },
            messages: {
                amount: {
                    required: "Please enter an amount.",
                    number: "Amount must be number."
                },
                month:{
                    required: "Month is required.",
                    notEqualToString: "Please select an option!"
                },
                year:{
                    required:"Year is required.",
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
    function FillFormFromRow(id, year, month, amount) {
        $("#id").val(id);
        $("#amount").val(amount);
        $("#year").val(year);
        $("#month").val(month);
    }
</script>