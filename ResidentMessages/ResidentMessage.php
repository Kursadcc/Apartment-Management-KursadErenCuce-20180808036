<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="0"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "ResidentMessage";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Messages';
    $layout = __DIR__ . '../layout.php';
    $content = 'ResidentMessages/_ResidentMessage.php';
    $selectedMenu = "ResidentMessage";
    require_once '../layout.php';
}
?>
