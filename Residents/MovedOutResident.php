<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else{
    $title = 'Residents';
    $layout = __DIR__ . '../layout.php';
    $content = 'Residents/_MovedOutResident.php';
    $selectedMenu = "MovedOutResident";
    require_once '../layout.php';
}
?>
