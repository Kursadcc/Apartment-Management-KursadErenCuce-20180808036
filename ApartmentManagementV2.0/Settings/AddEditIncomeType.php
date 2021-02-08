
<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "IncomeTypeManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {

    $titleErr = $contentErr = "";
    $errorCount = 0;
    $successMsg = "";
    function clearForm()
    {
        $_POST["id"]="";
        $_POST["incomeType"] = "";
        $_POST["isShown"] = "";

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
        if (empty($_POST["incomeType"])) {
            $titleErr = "This is required.";
            $errorCount++;
        } else {
            $incomeType = test_input($_POST["incomeType"]);
        }
        if (empty($_POST["isShown"])) {
            $contentErr = "This is required.";
            $errorCount++;
        } else {
            $isShown = test_input($_POST["isShown"]);
        }
        $id = $_POST["id"];
        if ($id == "") {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "INSERT INTO `incometypes`(`incomeType`, `isShown`, `isActive`) VALUES ('" . $incomeType . "','" . $isShown . "','1')";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $succesMessage = "Information could not be saved.";
            }
        } else {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "UPDATE incometypes SET incomeType='$incomeType',isShown='$isShown' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $succesMessage = "Information could not be saved.";
            }
        }
    }
    $title = 'Income Types';
    $layout = __DIR__ . '../layout.php';
    $content = 'Settings/_IncomeTypeManagement.php';
    $selectedMenu = "IncomeTypeManagement";
    require_once '../layout.php';
}

?>
