<?php
require("../dbConnection.php");
$messages = "SELECT*FROM residentmessages ORDER BY createDate DESC";
$resultMessage = mysqli_query($connection, $messages) or die(mysqli_error($connection));
?>
<div class="col-12 col-xl-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Send Message</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="answerFrom" action="SendEditAnswer.php">
                <input type="hidden" id="id" name="id" class="form-control">
                <div class="mb-3 row">
                    <label class="col-form-label col-sm-2 ">Answer</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" placeholder="Answer..." rows="3" id="answer" name="answer"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('answerFrom');">Submit</a>
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
                <h5 class="card-title">Announcements</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Message Type</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th class="d-none d-md-table-cell">Answer</th>
                            <th>Send Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultMessage->num_rows > 0) {
                            $rowCount = 0;
                            // output data of each row
                            while ($rowMessage = $resultMessage->fetch_assoc()) {
                                $messageId = $rowMessage["typeId"];
                                $rowCount++;
                                $messageType1 = "SELECT*FROM residentmessagetypes WHERE id='$messageId'";
                                $resultMessageType1 = mysqli_query($connection, $messageType1) or die(mysqli_error($connection));
                                if ($resultMessageType1->num_rows > 0) {
                                    while ($rowMessageType1 = $resultMessageType1->fetch_assoc()) {
                                        $type = $rowMessageType1["messageType"];
                                    }
                                }
                                echo "<tr><td>{$rowCount}</td><td>{$type}</td><td>{$rowMessage['title']}</td><td>{$rowMessage['content']}</td><td>{$rowMessage['answer']}</td><td>{$rowMessage['createDate']}</td><td>" .
                                    "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $rowMessage['id'] . "\",\"" . $rowMessage['answer'] . "\")'><i class='align-middle' data-feather='edit-2'></i>Answer</a>" .
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
        $("#answerFrom").validate({
            rules: {
                answer: {
                    required: true
                },
            },
            messages: {
                answer: {
                    required: "Answer is required."
                }
            }
        });
    });

    function ValidateFormAndSubmit(formId) {
        if ($("#" + formId).valid()) {
            $("#" + formId).submit();
        }
    }

    function FillFormFromRow(id, answer) {
        $("#id").val(id);
        $("#answer").val(answer);
    }
</script>