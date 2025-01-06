<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "ExpenseManagement";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Expenses';
    $layout = __DIR__ . '../layout.php';
    $content = 'Expenses/_ExpenseManagement.php';
    $selectedMenu = "ExpenseManagement";
    require_once '../layout.php';
}
?>
