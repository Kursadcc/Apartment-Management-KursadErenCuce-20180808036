<?php
session_start();
function checkLogin(){
if(!isset($_SESSION["login"])){
    return false;
}else{
    return true;
}
}
?>