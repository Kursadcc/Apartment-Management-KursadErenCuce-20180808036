
<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "AnnouncementManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {

    $titleErr = $contentErr = "";
    $errorCount = 0;
    $successMsg = "";
    function clearForm()
    {
        $_POST["id"] = "";
        $_POST["Title"] = "";
        $_POST["Content"] = "";
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
        if (empty($_POST["Title"])) {
            $titleErr = "This is required.";
            $errorCount++;
        } else {
            $title = $_POST["Title"];
        }
        if (empty($_POST["Content"])) {
            $contentErr = "This is required.";
            $errorCount++;
        } else {
            $content = $_POST["Content"];
        }
        $id = $_POST["id"];
        if ($id == "") {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "INSERT INTO `announcements`(`title`, `content`, `managerId`, `isActive`) VALUES ('" . $title . "','" . $content . "','" . $_SESSION['id'] . "','1')";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $succesMessage = "Information could not be saved.";
            }
        } else {
            if ($errorCount == 0) {
                require('../dbConnection.php');
                $query = "UPDATE announcements SET title='$title',content='$content' WHERE id='$id'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $successMsg = "Information saved.";
                clearform();
            } else {
                $succesMessage = "Information could not be saved.";
            }
        }
    }
    $title = 'Announcements';
    $layout = __DIR__ . '../layout.php';
    $content = 'Announcements/_AnnouncementManagement.php';
    $selectedMenu = "AnnouncementManagement";
    require_once '../layout.php';
}

?>
