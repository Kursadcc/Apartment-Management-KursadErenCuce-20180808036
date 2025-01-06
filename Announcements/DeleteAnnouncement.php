
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
    function delete($data)
    {
        require('../dbConnection.php');

        $sql1 = "UPDATE announcements SET isActive=0  WHERE id=$data";
        $result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
        $sql2 = "SELECT * FROM announcements WHERE id=$data";
        $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            echo "<script>alert('Announcement successfully deleted.');</script>";
    }

    $id = "";
    $id = $_GET["id"];
    delete($id);
   

    require('../dbConnection.php');
    $sql = "SELECT * FROM announcements Where isActive = 1 ORDER BY createDate DESC ";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $title = 'Announcements';
    $layout = __DIR__ . '../layout.php';
    $content = 'Announcements/_AnnouncementManagement.php';
    $selectedMenu = "AnnouncementManagement";
    require_once '../layout.php';
}

?>