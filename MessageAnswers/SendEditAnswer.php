<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "Answer";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id=$_POST["id"];
        $answer=$_POST["answer"];
        $userId = $_SESSION["id"];
        require('../dbConnection.php');
        $query = "UPDATE residentmessages SET answer='$answer', managerId='$userId' WHERE id='$id'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        
    }
    $title = 'Messages';
    $layout = __DIR__ . '../layout.php';
    $content = 'MessageAnswers/_Answer.php';
    $selectedMenu = "Answer";
    require_once '../layout.php';
}
?>
