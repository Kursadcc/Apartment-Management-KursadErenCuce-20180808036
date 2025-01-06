<?php
require("../dbConnection.php");
$query = "SELECT*FROM expenses ORDER BY createDate DESC";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$query1 = "SELECT*FROM esxpensetypes WHERE isActive=1 and isShown=1";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));


?>

<div class="col-12 col-xl-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add/Edit Expense Form</h5>
        </div>
        <div class="card-body">
            <form class="row row-cols-md-auto align-items-center" id="expenseForm" method="POST" action="AddEditExpense.php">
                <input type="hidden" id="expenseId" name="expenseId" class="form-control">
                <div class="col-12">
                    <label for="inlineFormInputName2">Expense Type</label>
                    <div class="col-12">
                        <select name="expenseType" id="expenseType" class="form-control mb-3">
                            <option selected value="0">Select expense type...</option>
                            <?php
                            if ($result1->num_rows > 0) {
                                while ($row1 = $result1->fetch_assoc()) {
                                    echo "<option value='{$row1['id']}'>{$row1['expenseType']}</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="inlineFormInputName2">Information</label>
                    <div class="col-12">
                        <textarea type="text" class="form-control mb-3" placeholder="Information..." rows="1" id="expenseInformation" name="expenseInformation"></textarea>
                    </div>
                </div>
                <div class="col-12"></br>
                    <label for="inlineFormInputName2">Amount</label>
                    <div class="col-12">
                        <input type="text" class="form-control mb-3" placeholder="Amount..." id="expenseAmount" name="expenseAmount"></br>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('expenseForm');">Submit</a>
                </div>
        </div>

        </form>
    </div>
</div>




<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Expenses</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="ExpenseList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Expense Type</th>
                        <th>Information</th>
                        <th class="d-none d-md-table-cell">Amount</th>
                        <th>Date</th>
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
                            $typeId=$row["typeId"];
                            $query1 = "SELECT*FROM esxpensetypes WHERE isActive=1 and isShown=1 and id='$typeId'";
                            $result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
                            if ($result1->num_rows > 0) {
                                while ($row1 = $result1->fetch_assoc()) {
                                    $expenseType = $row1["expenseType"];
                                }
                            } else {
                                echo "0 results";
                            }
                            echo "<tr><td>{$rowCount}</td><td>{$expenseType}</td><td>{$row['information']}</td><td>{$row['amount']}  ₺</td><td>{$row['createDate']}</td><td>" .
                                "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['typeId'] . "\",\"" . $row['information'] . "\",\"" . $row['amount'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
                                "</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $("#expenseForm").validate({
            rules: {
                expenseType: {
                    required: true,
                    notEqualToString: "0"
                },
                expenseInformation: {
                    required: true
                },
                expenseAmount: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                expenseType: {
                    required: "Expense type is required.",
                    notEqualToString: "Please select an option!"
                },
                expenseInformation: {
                    required: "Information is required."
                },
                expenseAmount: {
                    required: "Amount is required.",
                    digits: "Amount must be number."
                }
            }
        });
    });

    function ValidateFormAndSubmit(formId) {
        if ($("#" + formId).valid()) {
            $("#" + formId).submit();
        }
    }
    $(document).ready(function() {
        $("#ExpenseList").DataTable({
            "iDisplayLength": 20,
            "lengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            "pageLength": 20,
            "sDom": 'TlfBrtip',
            "proccessing": true,

        });
    });
</script>
<script>
    function FillFormFromRow(id, expenseType, expenseInformation, expenseAmount) {
        $("#expenseId").val(id);
        $("#expenseType").val(expenseType);
        $("#expenseInformation").val(expenseInformation);
        $("#expenseAmount").val(expenseAmount);
    }
</script>