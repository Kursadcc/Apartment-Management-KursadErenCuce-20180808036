<?php
require("../control.php");
$loginResult = checkLogin();
if (!$loginResult) {
  header("Refresh: 2; url=../loginPage.php");
} else if ($_SESSION["isManager"] != "1") {
  $title = 'Warning!';
  $layout = __DIR__ . '../layout.php';
  $selectedMenu = "AnnouncementManagement";
  $content = '../notManagerWarning.php';
  require_once '../layout.php';
} else {
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorCount = 0;
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $userName = test_input($_POST["userName"]);
    $userPassword = test_input($_POST["userPassword"]);
    $md5userPassword = md5($userPassword);
    $email = test_input($_POST["email"]);
    $phoneNumber1 = test_input($_POST["phoneNumber1"]);
    $phoneNumber2 = test_input($_POST["phoneNumber2"]);
    $familyMemberCount = test_input($_POST["familyMemberCount"]);
    $doorNumber = test_input($_POST["doorNumber"]);
    $isManager = test_input($_POST["isManager"]);
    $gender = test_input($_POST["gender"]);
    $id = $_POST["id"];
    if ($id == "") {
      if ($errorCount == 0) {
        require('../dbConnection.php');
        $query1 = "SELECT*FROM residents WHERE userName='$userName'";
        $resultAnyExist = mysqli_query($connection, $query1) or die(mysqli_error($connection));
        if ($resultAnyExist->num_rows > 0) {
          $errorMsg = "A record with this year and month has already been saved! You can use edit button!";
          $title = 'Residents';
          $layout = __DIR__ . '../layout.php';
          $content = 'Residents/_ResidentManagement.php';
          $selectedMenu = "ResidentManagement";
          require_once '../layout.php';
        }
        require('../dbConnection.php');
        $query = "INSERT INTO `residents`(`firstName`, `lastName`, `userName`, `userPassword`, `email`, `phoneNumber1`, `phoneNumber2`, `familyMembercount`, `flatId`, `isManager`, `isActive`, `gender`) VALUES ( '" . $firstName . "','" . $lastName . "','" . $userName . "','" . $md5userPassword . "','" . $email . "','" . $phoneNumber1 . "','" . $phoneNumber2 . "','" . $familyMemberCount . "','" . $doorNumber . "','" . $isManager . "','1','" . $gender . "')";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $successMsg = "Information saved.";
        // clearform();
      } else {
        $succesMessage = "Information could not be saved.";
      }
    } else {
      if ($errorCount == 0) {
        require('../dbConnection.php');
        $query = "UPDATE residents SET firstName='$firstName', lastName='$lastName', userName='$userName', userPassword='$md5userPassword', email='$email', phoneNumber1='$phoneNumber1', phoneNumber2='$phoneNumber2', familyMemberCount='$familyMemberCount', flatId='$doornumber', isManager='$isManager', gender='$gender' WHERE id='$id'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $successMsg = "Information saved.";
        //clearform();
      } else {
        $succesMessage = "Information could not be saved.";
      }
    }
  }
  $title = 'Residents';
  $layout = __DIR__ . '../layout.php';
  $content = 'Residents/_ResidentManagement.php';
  $selectedMenu = "ResidentManagement";
  require_once '../layout.php';
}
