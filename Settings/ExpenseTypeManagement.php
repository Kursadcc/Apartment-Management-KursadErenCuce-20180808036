<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "ExpenseTypeManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Expense Types';
    $layout = __DIR__ . '../layout.php';
    $content = 'Settings/_ExpenseTypeManagement.php';
    $selectedMenu = "ExpenseTypeManagement";
    require_once '../layout.php';
}
?>
