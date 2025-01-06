<?php
setlocale(LC_MONETARY, 'tr_TR');

require("../dbConnection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $EndDate = $_POST["EndDate"];
    $StartDate = $_POST["StartDate"];
} else {
    //$StartDate = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
    $StartDate = date('Y-m-d', strtotime(date('Y-m-d') . " -1 month"));
    $EndDate = date("Y-m-d");
}


$query2 = "SELECT*FROM incometypes WHERE isActive=1 and isShown=1";
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
$query3 = "SELECT*FROM incomes WHERE createDate<='$EndDate' and createDate>='$StartDate' ORDER BY createDate DESC";
$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
$query = "SELECT*FROM expenses WHERE createDate<='$EndDate' and createDate>='$StartDate' ORDER BY createDate DESC";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$query1 = "SELECT*FROM esxpensetypes WHERE isActive=1 and isShown=1";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
?>

<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Select date interval</h5>
            </div>
            <div class="card-body">
                <form id="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="row row-cols-md-auto align-items-center">
                    <div class="col-12">
                        <label>From</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="StartDate" name="StartDate" value="<?php echo $StartDate; ?>" />
                    </div>
                    <div class="col-12">
                        <label>To</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="EndDate" name="EndDate" value="<?php echo $EndDate; ?>" />
                    </div>
                    <div class="col-12"></br>
                        <a href="#" type="button" class="btn btn-info align-self-end mb-2" onclick="ValidateFormAndSubmit('myform');">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card" style="min-height:157px;">
            <div class="card-header">
                <h5 class="card-title">Balance</h5>
            </div>
            <div class="card-body py-0" style=>
                <div class="col-12">
                    <div class="col-12">
                        <span style="font-size:18px!important;" class="align-middle text-success">
                            <i class="align-middle" data-feather="trending-up"></i> Income:
                            <?php require("../dbConnection.php");
                            $sql = mysqli_query($connection, "SELECT SUM(amount) as total FROM incomes WHERE createDate<='$EndDate' and createDate>='$StartDate'") or die(mysqli_error($connection));;
                            $row4 = mysqli_fetch_array($sql);
                            $sum = $row4['total'];
                            echo "$sum ₺";
                            ?>
                        </span>
                    </div>
                    <div class="col-12">
                        <span style="font-size:18px!important;" class="align-middle text-danger">
                            <i class="align-middle" data-feather="trending-down"></i>&nbsp;Expense:
                            <?php require("../dbConnection.php");
                            $sql1 = mysqli_query($connection, "SELECT SUM(amount) as total FROM expenses WHERE createDate<='$EndDate' and createDate>='$StartDate'") or die(mysqli_error($connection));;
                            $row5 = mysqli_fetch_array($sql1);
                            $sum1 = $row5['total'];
                            echo "$sum1 ₺";
                            ?>
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <span style="font-size:24px!important;" class="float-right align-middle <?php if ($sum - $sum1 >= 0)  echo "text-success";
                                                                                            else echo "text-danger"; ?>">
                        <i class="align-middle" data-feather="pie-chart"></i>&nbsp;Balance: <?php $balance = $sum - $sum1;
                                                                                            echo "$balance ₺ "; ?> </span>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Incomes</h5>
            </div>
            <div class="card-body">
                <div class="chart chart-sm">
                    <canvas id="income"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Incomes</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="incomeList">
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

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Expenses</h5>
            </div>
            <div class="card-body">
                <div class="chart chart-sm">
                    <canvas id="expense"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Expenses</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="expenseList">
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
                            $rowCount = 0;

                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $rowCount++;
                                $typeId = $row["typeId"];
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
                        $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
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
        $("#expenseList").DataTable({
            "iDisplayLength": 20,
            "lengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            "pageLength": 20,
            "sDom": 'TlfBrtip',
            "proccessing": true,

        });
        $("#incomeList").DataTable({
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
<?php
require("../dbConnection.php");

$group = "SELECT t2.incomeType it, SUM(amount) total FROM incomes t1 INNER JOIN incometypes t2 ON t1.typeId = t2.id GROUP BY typeId";
$resultGroup = mysqli_query($connection, $group) or die(mysqli_error($connection));
if ($resultGroup->num_rows > 0) {
    // output data of each row
    while ($row = $resultGroup->fetch_assoc()) {
        echo "{$row['it']} - {$row['total']}";
    }
} else {
    echo "0 results";
}
?>


<script>
    const colorScheme = [
        "#25CCF7", "#FD7272", "#54a0ff", "#00d2d3",
        "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e",
        "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
        "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6",
        "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d",
        "#55efc4", "#81ecec", "#74b9ff", "#a29bfe", "#dfe6e9",
        "#00b894", "#00cec9", "#0984e3", "#6c5ce7", "#ffeaa7",
        "#fab1a0", "#ff7675", "#fd79a8", "#fdcb6e", "#e17055",
        "#d63031", "#feca57", "#5f27cd", "#54a0ff", "#01a3a4"
    ];

    function picColors(count) {
        var colors = new Array();
        for (i = 0; i < count; i++) {
            var index = Math.floor(Math.random() * 43);
            var val = colorScheme[index];
            colorScheme.pop(val);
            colors.push(val);
        }

        return colors;
    }
    $(document).ready(function() {

        $.getJSON("<?php echo ('http://localhost/ApartmentManagementV2.0/Balance/IncomeChart.php?startDate=' . $StartDate . '&endDate=' . $EndDate) ?>", function(jsonData) {
            var c = document.getElementById("income");
            var labelData = jsonData[0];
            var valueData = jsonData[1];
            // Pie chart
            new Chart(document.getElementById("income"), {
                type: "pie",
                data: {
                    labels: labelData,
                    datasets: [{
                        data: valueData,
                        backgroundColor: picColors(valueData.length),
                        borderColor: "transparent"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        });



        // Pie chart
        $.getJSON("<?php echo ('http://localhost/ApartmentManagementV2.0/Balance/ExpenseChart.php?startDate=' . $StartDate . '&endDate=' . $EndDate) ?>", function(jsonExpenseData) {
            var c = document.getElementById("expense");
            var labelExpenseData = jsonExpenseData[0];
            var valueExpenseData = jsonExpenseData[1];
            // Pie chart
            new Chart(document.getElementById("expense"), {
                type: "pie",
                data: {
                    labels: labelExpenseData,
                    datasets: [{
                        data: valueExpenseData,
                        backgroundColor: picColors(valueExpenseData.length),
                        borderColor: "transparent"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        });
    });
</script>

<!-- 
new Chart(document.getElementById("income"), {
            type: "pie",
            data: {
                labels: ["Income", "Expense"],
                datasets: [{
                    data: [?php echo "$sum"; ?>, ?php echo "$sum1"; ?>],
                    backgroundColor: [
                        window.theme.succes,
                        window.theme.danger,
                    ],
                    borderColor: "transparent"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        }); -->