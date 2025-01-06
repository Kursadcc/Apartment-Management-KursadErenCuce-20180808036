<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "FlatManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {

    $titleErr = $contentErr = "";
    $errorCount = 0;
    $successMsg = "";
    function clearForm()
    {
        $_POST["id"]="";
        $_POST["ownerName"] = "";
        $_POST["ownerPhoneNumber"] = "";

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
        $successMsg = "";
        $ownerName = test_input($_POST["ownerName"]);
        $ownerPhoneNumber = test_input($_POST["ownerPhoneNumber"]);
        $id = $_POST["id"];
        if ($id == "") {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query1="SELECT MAX(doorNumber) AS lastDoorNumber FROM flats";
                $result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
                if ($result1->num_rows > 0){
                    $row = $result1->fetch_assoc();
                    $doorNumber="";
                    $doorNumber=$row["lastDoorNumber"]+1;
                }
                $query = "INSERT INTO `flats`(`doorNumber`, `ownerName`, `ownerPhoneNumber`) VALUES ('" . $doorNumber . "','" . $ownerName . "','" . $ownerPhoneNumber . "')";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            
            } else {
                $succesMessage = "Information could not be saved.";
            }
        } else {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "UPDATE flats SET ownerName='$ownerName',ownerPhoneNumber='$ownerPhoneNumber' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $succesMessage = "Information could not be saved.";
            }
        }
    }
    $title = 'Expense Types';
    $layout = __DIR__ . '../layout.php';
    $content = 'Settings/_FlatManagement.php';
    $selectedMenu = "FlatManagement";
    require_once '../layout.php';
}
