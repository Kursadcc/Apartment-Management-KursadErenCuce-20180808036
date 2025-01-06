<?php
require("../control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=../loginPage.php");
}else if($_SESSION["isManager"]!="1"){
    $title='Warning!';
    $layout=__DIR__.'../layout.php';
    $selectedMenu = "Answer";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
}else{
    $title = 'Messages';
    $layout = __DIR__ . '../layout.php';
    $content = 'MessageAnswers/_Answer.php';
    $selectedMenu = "Answer";
    require_once '../layout.php';
}
?>