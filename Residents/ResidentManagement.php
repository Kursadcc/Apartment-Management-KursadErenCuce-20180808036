<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "ResidentManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Residents';
    $layout = __DIR__ . '../layout.php';
    $content = 'Residents/_ResidentManagement.php';
    $selectedMenu = "ResidentManagement";
    require_once '../layout.php';
}
?>
