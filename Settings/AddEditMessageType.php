<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "MessageTypeManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $messageType = $_POST["messageType"];
        $id = $_POST["id"];
        if ($id == "") {
            require('../dbConnection.php');
            $query = "INSERT INTO `residentmessagetypes`(`messageType`) VALUES ('" . $messageType . "')";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }else{
            require('../dbConnection.php');
            $query = "UPDATE residentmessagetypes SET messageType='$messageType' WHERE id='$id'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
    }


    $title = 'Message Types';
    $layout = __DIR__ . '../layout.php';
    $content = 'Settings/_MessageTypeManagement.php';
    $selectedMenu = "MessageTypeManagement";
    require_once '../layout.php';
}
