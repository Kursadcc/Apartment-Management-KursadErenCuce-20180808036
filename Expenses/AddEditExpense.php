<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "ExpenseManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function clearForm()
    {
        $_POST["expenseType"] = "";
        $_POST["expenseInformation"] = "";
        $_POST["expenseAmount"] = "";
        $_POST["expenseId"] = "";
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        $typeId=$_POST["expenseType"];
        $information=$_POST["expenseInformation"];
        $amount=$_POST["expenseAmount"];
        $managerId=$_SESSION["id"];
        $createDate=date("Y-m-d");
        $id=$_POST["expenseId"];
        if($id==""){
            require('../dbConnection.php');
            $query = "INSERT INTO `expenses`(`typeId`, `information`, `managerId`, `amount`,`createDate`) VALUES ('" . $typeId . "','" . $information . "','" . $managerId . "','" . $amount . "','" . $createDate . "')";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $successMsg = "Information saved.";
            clearform();
        }else{
            require('../dbConnection.php');
                $query = "UPDATE expenses SET typeId='$typeId',information='$information',managerId='$managerId',amount='$amount' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
        }
    }
    $title = 'Expenses';
    $layout = __DIR__ . '../layout.php';
    $content = 'Expenses/_ExpenseManagement.php';
    $selectedMenu = "ExpenseManagement";
    require_once '../layout.php';
}
?>