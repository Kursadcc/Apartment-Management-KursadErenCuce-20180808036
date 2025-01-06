<?php
require("../dbConnection.php");
$query = "SELECT*FROM expenses ORDER BY createDate DESC";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$query1 = "SELECT*FROM esxpensetypes WHERE isActive=1 and isShown=1";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
?>
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
                            echo "<tr><td>{$rowCount}</td><td>{$expenseType}</td><td>{$row['information']}</td><td>{$row['amount']}  ₺</td><td>{$row['createDate']}</td></tr>";
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