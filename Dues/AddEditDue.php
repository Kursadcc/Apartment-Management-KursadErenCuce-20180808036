<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "DueManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {

    $titleErr = $contentErr = "";
    $errorCount = 0;
    $successMsg = "";
    function clearForm()
    {
        $_POST["id"] = "";
        $_POST["year"] = "";
        $_POST["month"] = "";
        $_POST["amount"] = "";
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errorCount = 0;
        $errorMsg = "";
        $year = $_POST["year"];
        $month = $_POST["month"];
        $amount = $_POST["amount"];
        $id = $_POST["id"];
        if ($id == "") {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query1 = "SELECT*FROM dues WHERE year='$year'";
                $query2 = "SELECT*FROM dues WHERE month='$month'";
                $resultAnyExist = mysqli_query($connection, $query1) or die(mysqli_error($connection));
                $resultAnyExist1 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                if ($resultAnyExist->num_rows > 0 and $resultAnyExist1->num_rows > 0) {
                    $errorMsg = "A record with this year and month has already been saved! You can use edit button!";
                    $title = 'Dues';
                    $layout = __DIR__ . '../layout.php';
                    $content = 'Dues/_DueManagement.php';
                    $selectedMenu = "DueManagement";
                    require_once '../layout.php';
                }
                $query = "INSERT INTO `dues`(`year`, `month`, `amount`) VALUES ('" . $year . "','" . $month . "','" . $amount . "')";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $query3 = "SELECT*FROM flats";
                $result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
                if ($result3->num_rows > 0) {
                    while ($row = $result3->fetch_assoc()) {
                        $query4 = "SELECT*FROM dues ORDER BY id DESC LIMIT 1";
                        $result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));
                        if ($result4->num_rows > 0) {
                            while ($row1 = $result4->fetch_assoc()) {
                                $flatId = $row["id"];
                                $dueId = $row1["id"];
                                $query5 = "INSERT INTO `flatdues` (`flatId`, `dueId`, `isPaid`) VALUES ('" . $flatId . "','" . $dueId . "','0')";
                                $result5 = mysqli_query($connection, $query5) or die(mysqli_error($connection));
                            }
                        }
                    }
                }
                $successMsg = "Information saved.";
                clearform();
            } else {
                $errorMsg = "Information could not be saved.";
            }
        } else {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "UPDATE dues SET year='$year',month='$month', amount='$amount' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $errorMsg = "Information could not be saved.";
            }
        }
    }
    $title = 'Dues';
    $layout = __DIR__ . '../layout.php';
    $content = 'Dues/_DueManagement.php';
    $selectedMenu = "DueManagement";
    require_once '../layout.php';
}
