<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="0"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "Income";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Incomes';
    $layout = __DIR__ . '../layout.php';
    $content = 'Incomes/_Income.php';
    $selectedMenu = "Income";
    require_once '../layout.php';
}
?>
