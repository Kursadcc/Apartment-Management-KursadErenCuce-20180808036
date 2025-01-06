<?php
require("../dbConnection.php");
$query2 = "SELECT*FROM incometypes WHERE isActive=1 and isShown=1";
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
$query3 = "SELECT*FROM incomes ORDER BY createDate DESC";
$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
?>
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
                            echo "<tr><td>{$rowCount}</td><td>{$incomeType}</td><td>{$row3['information']}</td><td>{$row3['amount']} ₺</td><td>{$row3['createDate']}</td></tr>";
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