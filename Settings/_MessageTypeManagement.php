<?php
require("../dbConnection.php");
$sql = "SELECT*FROM residentmessagetypes";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
?>
<div class="col-xl-4 col-md-4 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add/Edit Message Types</h5>
        </div>
        <div class="card-body">
            <form id="messageTypeForm" method="POST" action="AddEditMessageType.php" class="row row-cols-md-auto align-items-center">
                <input type="hidden" id="id" name="id" class="form-control">
                <div class="col-12">
                    <label class="sr-only" for="inlineFormInputName2">Message Type</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="messageType" name="messageType">
                </div>
                <div class="col-12">
                    <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('messageTypeForm');">Submit</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Message Types</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($result->num_rows > 0) {
                            $rowCount = 0;
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $rowCount++;
                                echo "<tr><td>{$rowCount}</td><td>{$row['messageType']}</td><td>" .
                                    "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['messageType'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
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
        $("#messageTypeForm").validate({
            rules: {
                messageType: {
                    required: true,
                }
            },
            messages: {
                messageType: {
                    required: "Message type is required."
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
    function FillFormFromRow(id, messageType) {
        $("#id").val(id);
        $("#messageType").val(messageType);
    }
</script>