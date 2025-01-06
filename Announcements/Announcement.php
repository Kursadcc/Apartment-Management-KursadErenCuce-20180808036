<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="0"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "Announcement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Announcements';
    $layout = __DIR__ . '../layout.php';
    $content = 'Announcements/_Announcement.php';
    $selectedMenu = "Announcement";
    require_once '../layout.php';
}
?>
