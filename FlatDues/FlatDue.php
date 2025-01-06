<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="0"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "FlatDue";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    
    $title = 'Dues';
    $layout = __DIR__ . '../layout.php';
    $content = 'FlatDues/_FlatDue.php';
    $selectedMenu = "FlatDue";
    require_once '../layout.php';
}
?>
