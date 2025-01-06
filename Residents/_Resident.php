<?php
require("../dbConnection.php");
$sql = "SELECT * FROM residents WHERE isActive=1";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
$sql1 = "SELECT * FROM flats";
$result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
?>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($result->num_rows > 0) {
                            $rowCount=0;
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

                                echo "<tr><td>{$rowCount}</td><td>{$row['userName']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['email']}</td><td>NO: {$doorNumber}</td><td>{$row['phoneNumber1']}</td><td>{$row['phoneNumber2']}</td><td>{$row['isManager']}</td><td>{$row['gender']}</td><td>{$row['familyMemberCount']}</td><td>{$row['createDate']}</td></tr>";
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