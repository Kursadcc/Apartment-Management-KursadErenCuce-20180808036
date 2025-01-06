<?php
require("../dbConnection.php");
$query2 = "SELECT*FROM incometypes WHERE isActive=1 and isShown=1";
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
$query3 = "SELECT*FROM incomes ORDER BY createDate DESC";
$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
?>
<div class="col-12 col-xl-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add/Edit Income Form</h5>
        </div>
        <div class="card-body">
            <form class="row row-cols-md-auto align-items-center" id="incomeForm" method="POST" action="AddEditIncome.php">
                <input type="hidden" id="incomeId" name="incomeId" class="form-control">
                <div class="col-12">
                    <label for="inlineFormInputName2">Income Type</label>
                    <div class="col-12">
                        <select name="incomeType" id="incomeType" class="form-control mb-3">
                            <option selected value="0">Select Income type...</option>
                            <?php
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo "<option value='{$row2['id']}'>{$row2['incomeType']}</option>";
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
                        <textarea type="text" class="form-control mb-3" placeholder="Information..." rows="1" id="incomeInformation" name="incomeInformation"></textarea>
                    </div>
                </div>
                <div class="col-12"></br>
                    <label for="inlineFormInputName2">Amount</label>
                    <div class="col-12">
                        <input type="text" class="form-control mb-3" placeholder="Amount..." id="incomeAmount" name="incomeAmount"></br>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('incomeForm');">Submit</a>
                </div>
        </div>

        </form>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Incomes</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="IncomeList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Income Type</th>
                        <th>Information</th>
                        <th class="d-none d-md-table-cell">Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result3->num_rows > 0) {
                        $rowCount = 0;
                        // output data of each row
                        while ($row3 = $result3->fetch_assoc()) {
                            $rowCount++;
                            $typeId = $row3["typeId"];
                            $query2 = "SELECT*FROM incometypes WHERE isActive=1 and id='$typeId'";
                            $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $incomeType = $row2["incomeType"];
                                }
                            }
                            echo "<tr><td>{$rowCount}</td><td>{$incomeType}</td><td>{$row3['information']}</td><td>{$row3['amount']} ₺</td><td>{$row3['createDate']}</td><td>" .
                                "<a class='mr-3' href='#' onclick='FillFormFromRow1(\"" . $row3['id'] . "\",\"" . $row3['typeId'] . "\",\"" . $row3['information'] . "\",\"" . $row3['amount'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
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
<script>
    $(document).ready(function() {
        $("#incomeForm").validate({
            rules: {
                incomeType: {
                    required: true,
                    notEqualToString: "0"
                },
                incomeInformation: {
                    required: true
                },
                incomeAmount: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                incomeType: {
                    required: "Income type is required.",
                    notEqualToString: "Please select an option!"
                },
                incomeInformation: {
                    required: "Information is required."
                },
                incomeAmount: {
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
        $("#IncomeList").DataTable({
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
    function FillFormFromRow1(id, incomeType, incomeInformation, incomeAmount) {
        $("#expenseId").val(id);
        $("#incomeType").val(incomeType);
        $("#incomeInformation").val(incomeInformation);
        $("#incomeAmount").val(incomeAmount);
    }
</script>