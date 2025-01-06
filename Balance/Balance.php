<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else{
    $title = 'Balance';
    $layout = __DIR__ . '../layout.php';
    $content = 'Balance/_Balance.php';
    $selectedMenu = "Balance";
    require_once '../layout.php';
}
?>
