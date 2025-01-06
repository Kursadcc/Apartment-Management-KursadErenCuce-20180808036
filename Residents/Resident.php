<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="0"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "Resident";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Residents';
    $layout = __DIR__ . '../layout.php';
    $content = 'Residents/_Resident.php';
    $selectedMenu = "Resident";
    require_once '../layout.php';
}
?>
