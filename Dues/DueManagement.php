<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "DueManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Due Management';
    $layout = __DIR__ . '../layout.php';
    $content = 'Dues/_DueManagement.php';
    $selectedMenu = "DueManagement";
    require_once '../layout.php';
}
?>
