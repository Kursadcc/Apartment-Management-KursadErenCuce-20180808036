<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
    header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "0") {
    $title = 'Warning!';
    $layout = __DIR__ . '../layout.php';
    $selectedMenu = "FlatDue";
    $content = '../notManagerWarning.php';
    require_once '../layout.php';
} else {
    function pay($data)
    {
        require('../dbConnection.php');
        $paymentDate=date("Y-m-d");
        $sql1 = "UPDATE flatdues SET isPaid=1 , paymentDate='$paymentDate'  WHERE id='$data'";
        $result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
        $sql2 = "SELECT * FROM flatdues WHERE id=$data";
        $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        if($result2->num_rows>0){
            while($rowFlat=$result2->fetch_assoc()){
                $dueId=$rowFlat["dueId"];
                $flatId=$rowFlat["flatId"];
            }
        }
        $doorNumber="SELECT*FROM flats WHERE id='$flatId'";
        $resultDoorNumber=mysqli_query($connection, $doorNumber) or die(mysqli_error($connection));
        if($resultDoorNumber->num_rows>0){
            while($rowDoorNumber=$resultDoorNumber->fetch_assoc()){
                $doorN=$rowDoorNumber["doorNumber"];
            }
        }
        $dueIdAmount="SELECT*FROM dues WHERE id='$dueId'";
        $resultDueAmount=mysqli_query($connection, $dueIdAmount) or die(mysqli_error($connection));
        if($resultDueAmount->num_rows>0){
            while($rowDueAmount=$resultDueAmount->fetch_assoc()){
                $dueAmount=$rowDueAmount["amount"];
                $dueYear=$rowDueAmount["year"];
                $dueMonth=$rowDueAmount["month"];
            }
        }

        $income="INSERT INTO `incomes`(`typeId`, `information`, `flatDueId`, `managerId`,`amount`) VALUES ( '7','NO: ".$doorN." Due of: ".$dueYear."-".$dueMonth."','" . $data . "','1','" . $dueAmount . "') ";
        $resultIncome=mysqli_query($connection, $income) or die(mysqli_error($connection));
        echo "<script>alert('Due successfully paid.');</script>";
    }
    $id=$_GET["id"];
    pay($id);



    require('../dbConnection.php');
    $title = 'Dues';
    $layout = __DIR__ . '../layout.php';
    $content = 'FlatDues/_FlatDue.php';
    $selectedMenu = "FlatDues";
    require_once '../layout.php';
}

?>