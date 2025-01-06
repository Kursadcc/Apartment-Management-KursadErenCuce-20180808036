<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "IncomeManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function clearForm()
    {
        $_POST["incomeType"] = "";
        $_POST["incomeInformation"] = "";
        $_POST["incomeAmount"] = "";
        $_POST["incomeId"] = "";
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        $typeId=$_POST["incomeType"];
        $information=$_POST["incomeInformation"];
        $amount=$_POST["incomeAmount"];
        $managerId=$_SESSION["id"];
        $createDate=date("Y-m-d");
        $id=$_POST["incomeId"];
        if($id==""){
            require('../dbConnection.php');
            $query = "INSERT INTO `incomes`(`typeId`, `information`, `managerId`, `amount`,`createDate`) VALUES ('" . $typeId . "','" . $information . "','" . $managerId . "','" . $amount . "','" . $createDate . "')";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $successMsg = "Information saved.";
            clearform();
        }else{
            require('../dbConnection.php');
                $query = "UPDATE incomes SET typeId='$typeId',information='$information',managerId='$managerId',amount='$amount' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
        }
    }
    $title = 'Incomes';
    $layout = __DIR__ . '../layout.php';
    $content = 'Incomes/_IncomeManagement.php';
    $selectedMenu = "IncomeManagement";
    require_once '../layout.php';
}
?>