
<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "0") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "ResidentMessage";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $typeId = $_POST["messageType"];
        $messageTitle = $_POST["title"];
        $messageContent = $_POST["content"];
        $userId = $_SESSION["id"];
        if ($id == "") {
            require('../dbConnection.php');
            $query = "INSERT INTO `residentmessages`(`residentId`,`typeId`, `title`, `content`) VALUES ('" . $userId . "','" . $typeId . "','" . $messageTitle . "','" . $messageContent . "')";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        } else {
            require('../dbConnection.php');
            $query = "UPDATE residentmessages SET typeId='$typeId', title='$messageTitle',content='$messageContent' WHERE id='$id'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
    }

    $title = 'Messages';
    $layout = __DIR__ . '../layout.php';
    $content = 'ResidentMessages/_ResidentMessage.php';
    $selectedMenu = "ResidentMessage";
    require_once '../layout.php';
}

?>