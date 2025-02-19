<?php
require("../dbConnection.php");
$sql = "SELECT * FROM residents WHERE isActive=1";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
$sql1 = "SELECT * FROM flats";
$result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
?>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add/Edit Resident Form</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="myform" action="AddEditResident.php">
                <input type="hidden" id="id" name="id" class="form-control">
                <div class="row">
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">User Name</label>
                        <div class="col-6">
                            <input type="text" name="userName" id="userName" class="form-control" placeholder="User Name">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Password</label>
                        <div class="col-6">
                            <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Password Check</label>
                        <div class="col-6">
                            <input type="password" id="userPasswordCheck" name="userPasswordCheck" class="form-control" placeholder="Re-enter Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">First Name</label>
                        <div class="col-6">
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Last Name</label>
                        <div class="col-6">
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">E-mail</label>
                        <div class="col-6">
                            <input type="text" name="email" id="email" class="form-control" placeholder="example@exmail.com">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Phone Number</label>
                        <div class="col-6">
                            <input type="text" name="phoneNumber1" id="phonenumber1" class="form-control" placeholder="EX:5552228899">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Phone Number</label>
                        <div class="col-6">
                            <input type="text" name="phoneNumber2" id="phoneNumber2" class="form-control" placeholder="EX:5552228899">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Role</label>
                        <div class="col-6">
                            <select name="isManager" id="isManager" class="form-control mb-3">
                                <option selected value="-1">Select role...</option>
                                <option value="1">Manager</option>
                                <option value="0">Resident</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Family Member Count</label>
                        <div class="col-6">
                            <input type="text" name="familyMemberCount" id="familyMemberCount" class="form-control" placeholder="Family Member Count">
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Door Number</label>
                        <div class="col-6">
                            <select name="doorNumber" id="doorNumber" class="form-control mb-3">
                                <option selected value="0">Select door number...</option>
                                <?php
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "<option value='{$row1['id']}'>NO: {$row1['doorNumber']}</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row col-4">
                        <label class="col-form-label col-6 text-right">Gender</label>
                        <div class="col-6">
                            <select name="gender" id="gender" class="form-control mb-3">
                                <option selected value="0">Select gender...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" type="button" class="btn btn-info align-self-end" onclick="ValidateFormAndSubmit('myform');">Submit</a>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Residents</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-mail</th>
                            <th>Door Number</th>
                            <th>Phone Number</th>
                            <th>Phone Number</th>
                            <th>is Manager</th>
                            <th>Gender</th>
                            <th>Family Member Count</th>
                            <th>Move in Date</th>
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
                                $flatId = $row['flatId'];
                                $sql2 = "SELECT * FROM flats WHERE id='$flatId'";
                                $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $doorNumber = $row2['doorNumber'];
                                    }
                                } else {
                                    echo "0 results";
                                }

                                echo "<tr><td>{$rowCount}</td><td>{$row['userName']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['email']}</td><td>NO: {$doorNumber}</td><td>{$row['phoneNumber1']}</td><td>{$row['phoneNumber2']}</td><td>{$row['isManager']}</td><td>{$row['gender']}</td><td>{$row['familyMemberCount']}</td><td>{$row['createDate']}</td><td>" .
                                    "<a class='mr-3' href='#' onclick='FillFormFromRow(\"" . $row['id'] . "\",\"" . $row['userName'] . "\",\"" . $row['firstName'] . "\",\"" . $row['lastName'] . "\",\"" . $row['email'] . "\",\"" . $row['phoneNumber1'] . "\",\"" . $row['phoneNumber2'] . "\",\"" . $row['isManager'] . "\",\"" . $row['familyMemberCount'] . "\",\"" . $row['flatId'] . "\",\"" . $row['gender'] . "\")'><i class='align-middle' data-feather='edit-2'></i></a>" .
                                    "<a href='../Residents/DeleteResident.php?id=" . urlencode($row['id']) . "' ><i class='align-middle' data-feather='trash'></i></a>" .
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
                userName: {
                    required: true,
                },
                userPassword: {
                    required: true
                },
                userPasswordCheck: {
                    required: true,
                    equalTo: "#userPassword"
                },
                firstName: {
                    required: true
                },
                lastName: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phoneNumber1: {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    digits: true
                },
                phoneNumber2: {
                    maxlength: 10,
                    minlength: 10,
                    digits: true
                },
                isManager: {
                    required: true,
                    notEqualToString: "-1"
                },
                familyMemberCount: {
                    digits: true
                },
                doorNumber: {
                    required: true,
                    notEqualToString: "0"
                },
                gender: {
                    required: true,
                    notEqualToString: "0"
                }
            },
            messages: {
                userName: {
                    required: "User name is required."
                },
                userPassword: {
                    required: "Password is required."
                },
                userPasswordCheck: {
                    required: "Password check is required.",
                    equalTo: "Re-entered password is not same with password."
                },
                firstName: {
                    required: "First name is required."
                },
                lastName: {
                    required: "Last Name is required."
                },
                email: {
                    required: "E-mail is required.",
                    email: "Invalid e-mail format."
                },
                phoneNumber1: {
                    required: "Phone number is required.",
                    maxlength: "Phone number must be 10 digits without 0 at start.",
                    minlength: "Phone number must be 10 digits without 0 at start.",
                    digits: "Phone number must be 10 digits without 0 at start."
                },
                phoneNumber2: {
                    maxlength: "Phone number must be 10 digits without 0 at start.",
                    minlength: "Phone number must be 10 digits without 0 at start.",
                    digits: "Phone number must be 10 digits without 0 at start."
                },
                isManager: {
                    required: "Role is required.",
                    notEqualToString: "Please select an option!"
                },
                familyMemberCount: {
                    digits: "Family member count can be digit."
                },
                doorNumber: {
                    required: "Door number is required.",
                    notEqualToString: "Please select an option!"
                },
                gender: {
                    required: "Gender is required.",
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
    function FillFormFromRow(id, userName, firstName, lastName, email, phoneNumber1, phoneNumber2, isManager, familyMemberCount, flatId, gender) {
        $("#id").val(id);
        $("#userName").val(userName);
        $("#firstName").val(firstName);
        $("#lastName").val(lastName);
        $("#email").val(email);
        $("#phoneNumber1").val(phoneNumber1);
        $("#phoneNumber2").val(phoneNumber2);
        $("isManager").val(isManager);
        $("#familyMemberCount").val(familyMemberCount);
        $("#flatId").val(flatId);
        $("#gender").val(gender);
    }
</script>