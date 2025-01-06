<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "FlatDueManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    
    $title = 'Dues';
    $layout = __DIR__ . '../layout.php';
    $content = 'FlatDues/_FlatDueManagement.php';
    $selectedMenu = "FlatDueManagement";
    require_once '../layout.php';
}
?>
