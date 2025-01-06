<?php
require("../dbConnection.php");
$flatId = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flatId = $_POST["doorNumber"];
}
$query1 = "SELECT*FROM flatdues WHERE isPaid=1 and flatId='$flatId'";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));


?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"></h5>
            </div>
            <div class="card-body">
                <form method="post" id="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" id="id" name="id" class="form-control">
                    <div class="mb-3">
                        <div class="col-6">
                            <label class="form-label">Select Door Number</label>
                            <select name="doorNumber" id="doorNumber" class="form-control mb-3">
                                <option selected value="1">Select door number...</option>
                                <?php
                                $query4 = "SELECT*FROM flats";
                                $result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));
                                if ($result4->num_rows > 0) {
                                    while ($row3 = $result4->fetch_assoc()) {
                                        echo "<option value='{$row3['id']}'>NO: {$row3['doorNumber']}</option>";
                                    }
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('myform');">Submit</a>
                </form>
            </div>
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
                <table class="table table-striped table-hover" id="FlatDueTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Door Number</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowCount = 0;
                        if ($result1->num_rows > 0) {
                            $rowCount = 0;
                            while ($row = $result1->fetch_assoc()) {
                                $rowCount++;
                                $flatId1 = $row["flatId"];
                                $dueId = $row["dueId"];
                                $query2 = "SELECT*FROM flats WHERE id='$flatId1'";
                                $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                                if ($result2->num_rows > 0) {
                                    while ($row1 = $result2->fetch_assoc()) {
                                        $doorNumber = $row1["doorNumber"];
                                    }
                                }
                                $query3 = "SELECT*FROM dues WHERE id='$dueId'";
                                $result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
                                if ($result3->num_rows > 0) {
                                    while ($row2 = $result3->fetch_assoc()) {
                                        $year = $row2["year"];
                                        $month = $row2["month"];
                                        $amount = $row2["amount"];
                                    }
                                }
                                echo "<tr><td>{$rowCount}</td><td>NO: {$doorNumber}</td><td >{$year}-{$month}</td><td>{$amount} ₺</td><td>{$row['paymentDate']}   <i class='align-middle mr-2' data-feather='check'></i></td>";
                            }
                        }
                        $query4 = "SELECT*FROM flatdues WHERE isPaid=0 and flatId='$flatId'";
                        $result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));
                        if ($result4->num_rows > 0) {
                            $rowCountNotPaid = $rowCount;
                            while ($notPaidRow = $result4->fetch_assoc()) {
                                $dueId = $notPaidRow["dueId"];
                                $flatId1 = $notPaidRow["flatId"];
                                $query2 = "SELECT*FROM flats WHERE id='$flatId1'";
                                $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                                if ($result2->num_rows > 0) {
                                    while ($row1 = $result2->fetch_assoc()) {
                                        $doorNumber = $row1["doorNumber"];
                                    }
                                }
                                $query3 = "SELECT*FROM dues WHERE id='$dueId'";
                                $result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
                                if ($result3->num_rows > 0) {
                                    while ($row2 = $result3->fetch_assoc()) {
                                        $year = $row2["year"];
                                        $month = $row2["month"];
                                        $amount = $row2["amount"];
                                    }
                                }
                                $rowCountNotPaid++;
                                echo "<tr><td>{$rowCountNotPaid}</td><td>NO: {$doorNumber}</td><td >{$year}-{$month}</td><td>{$amount} ₺</td><td>{$notPaidRow['paymentDate']}   <i class='align-middle mr-2' data-feather='x'></i></td>";
                            }
                        }


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
                doorNumber: {
                    required: true,
                }
            },
            messages: {
                doorNumber: {
                    required: "Door number is required."
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
        $("#FlatDueTable").DataTable({
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