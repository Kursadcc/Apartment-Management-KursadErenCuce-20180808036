<?php
require("control.php");
$loginResult=checkLogin();
if(!$loginResult){
    header("Refresh: 2; url=loginPage.php");
}else{
    echo '<style type="text/css">
    body {
        display: block!important;
    }
    </style>';
}
?>
<html>
    <body style="display: none;">
        <style>
            .form{
	background:#f1f1f1; width:470px; margin:0 auto; padding-left:50px; padding-top:20px; margin-top: 2%;
}
.form fieldset{border:0px; padding:0px; margin:0px;}
.form p.contact { font-size: 12px; margin:0px 0px 10px 0;line-height: 14px; font-family:Arial, Helvetica;}

.form input[type="text"] { width: 400px; }
.form input[type="email"] { width: 400px; }
.forminput[type="password"] { width: 400px; }
.form input.birthday{width:60px;}
.form input.birthyear{width:120px;}
.form label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }
.form label.month {width: 135px;}
.form input, textarea { background-color: rgba(255, 255, 255, 0.4); border: 1px solid rgba(122, 192, 0, 0.15); padding: 7px; font-family: Keffeesatz, Arial; color: #4b4b4b; font-size: 14px; border-radius: 5px; margin-bottom: 15px; margin-top: -10px; }
.form input:focus, textarea:focus { border: 1px solid #ff5400; background-color: rgba(255, 255, 255, 1); }
.form .select-style {
  -webkit-appearance: button;
   border-radius: 2px;
   box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
  -webkit-padding-end: 20px;
  -webkit-padding-start: 2px;
  -webkit-user-select: none;
  background-image: url(images/select-arrow.png), 
    -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
  background-position: center right;
  background-repeat: no-repeat;
  border: 0px solid #FFF;
  color: #555;
  font-size: inherit;
  margin: 0;
  overflow: hidden;
  padding-top: 5px;
  padding-bottom: 5px;
  text-overflow: ellipsis;
  white-space: nowrap;}
.form .gender {
  width:410px;
  }
.form input.buttom{ background: #4b8df9; display: inline-block; padding: 5px 10px 6px; color: #fbf7f7; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
.form input.buttom:hover	{ background-color: #2a78f6; }
    </style>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' />
    <?php
    $usernameErr = $passwordErr = $passwordCheckErr = $roleErr = $firstNameErr = $lastNameErr = $emailErr = $phoneNumber1Err = $phoneNumber2Err = $doorNumberErr = $familyMemberCountErr = $genderErr = "";
    $userName = $password = $passwordCheck = $role = $firstName = $lastName = $email = $phoneNumber1 = $phoneNumber2 = $doorNumber = $familyMemberCount = $gender = "";
    $errorCount=0;
    $succesMessage="";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function clearform()
{
    $_POST["userName"]="";
    $_POST["password"]="";
    $_POST["passwordCheck"]="";
    $_POST["role"]="";
    $_POST["firstName"]="";
    $_POST["lastName"]="";
    $_POST["email"]="";
    $_POST["phoneNumber1"]="";
    $_POST["phoneNumber2"]="";
    $_POST["doorNumber"]="";
    $_POST["familyMemberCount"]="";
    $_POST["gender"]="";
}
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["id"])) {
        if(isset($_POST["userName"]) == false){
            require('db_connection.php');
            $id=$_POST["id"];
            $sql = "SELECT * FROM resident WHERE id='$id'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $_POST["userName"]=$row["user_name"];
            $_POST["role"]=$row["userrole"];
            $_POST["firstName"]=$row["firstname"];
            $_POST["lastName"]=$row["lastname"];
            $_POST["email"]=$row["email"];
            $_POST["phoneNumber1"]=$row["phonenumber1"];
            $_POST["phoneNumber2"]=$row["phonenumber2"];
            $_POST["doorNumber"]=$row["doornumber"];
            $_POST["familyMemberCount"]=$row["familymembercount"];
            $_POST["gender"]=$row["gender"];
           }
        }
        }else{
        $errorCount=0;
        $succesMessage="";
        if (empty($_POST["userName"])) {
            $usernameErr = "Name is required";
            $errorCount++;
        } else {
            $userName = test_input($_POST["userName"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
                $usernameErr = "Only letter and white space allowed";
                $errorCount++;
            }
        }
        
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $errorCount++;
        } else {
            $password = test_input($_POST["password"]);
            $md5password=md5($password);
        }

        if (empty($_POST["passwordCheck"])) {
            $passwordCheckErr = "Re-enter Password is required";
            $errorCount++;
        } else {
            $passwordCheck = test_input($_POST["passwordCheck"]);
            if ($_POST["passwordCheck"] != $_POST["password"]) {
                $passwordCheckErr = "Reentered password is not same with password.";
                $errorCount++;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $errorCount++;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format.";
                $errorCount++;
            }
        }

        if (empty($_POST["role"])) {
            $roleErr = "Role is required.";
            $errorCount++;
        }else if($_POST["role"]!= "admin" and $_POST["role"]!="user"){
                $roleErr = "Please enter valid role. Roles can be 'user' or 'admin'.";
                $errorCount++;
        } 
        else {
            $role = test_input($_POST["role"]);
        }

        if (empty($_POST["firstName"])) {
            $firstNameErr = "First Name is required";
            $errorCount++;
        } else {
            $firstName = test_input($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
                $firstNameErr = "Only letter and white space allowed";
                $errorCount++;
            }
        }

        if (empty($_POST["lastName"])) {
            $lastNameErr = "Last Name is required";
            $errorCount++;
        } else {
            $lastName = test_input($_POST["lastName"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
                $lastNameErr = "Only letter and white space allowed";
                $errorCount++;
            }
        }

        if (empty($_POST["phoneNumber1"])) {
            $phoneNumber1Err = "Phone number is required.";
            $errorCount++;
        } else {
            $phoneNumber1 = test_input($_POST["phoneNumber1"]);
            if (strlen($_POST["phoneNumber1"]) != 10) {
                $phoneNumber1Err = "Please enter your phone number without '0' at start, as 10 digits.";
                $errorCount++;
            } else if (!preg_match("/^[0-9-' ]*$/", $_POST["phoneNumber1"])) {
                $phoneNumber1Err = "Only digits allowed.";
                $errorCount++;
            }
        }
        if($_POST["phoneNumber2"]==""){
            $phoneNumber2 = test_input($_POST["phoneNumber2"]);
        }else if (strlen($_POST["phoneNumber2"]) != 10) {
            $phoneNumber2Err = "Please enter your phone number without '0' at start, as 10 digits.";
            $errorCount++;
        } else {
            $phoneNumber2 = test_input($_POST["phoneNumber2"]);
            if (!preg_match("/^[0-9-' ]*$/", $_POST["phoneNumber2"])) {
                $phoneNumber2Err = "Only digits allowed.";
                $errorCount++;
            }
        }
        if (empty($_POST["doorNumber"])) {
            $doorNumberErr = "Door number is required";
            $errorCount++;
        } else {
            $doorNumber = test_input($_POST["doorNumber"]);
            if (!preg_match("/^[0-9-' ]*$/", $_POST["doorNumber"])) {
                $doorNumberErr = "Only digits allowed.";
                $errorCount++;
            } else if ($_POST["doorNumber"] > 20 or $_POST["doorNumber"] < 0) {
                $doorNumberErr = "Door number must be between 1 and 10.";
                $errorCount++;
            }
        }

        if (!preg_match("/^[0-9-' ]*$/", $_POST["familyMemberCount"])) {
            $familyMemberCountErr = "Only digits allowed.";
            $errorCount++;
        } else {
            $familyMemberCount = test_input($_POST["familyMemberCount"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            $errorCount++;
        } else {
            $gender = test_input($_POST["gender"]);
        }
        if($errorCount==0){
          require('db_connection.php');
          $id=$_POST["id"];
          $query = "UPDATE resident SET user_name='$userName', pass_word='$md5password', phonenumber1='$phoneNumber1', userrole='$role', phonenumber2='$phoneNumber2', firstname='$firstName', lastname='$lastName', email='$email', doornumber='$doorNumber', familymembercount='$familyMemberCount', gender='$gender' WHERE id='$id'";
          $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $succesMessage="Information saved.";
          clearform();   
        }else{
          //echo "<script>alert('Information could not be saved. Please try adding again!')</script>"; 
          $succesMessage="Information could not be saved.";         
        }
    }
    }

    ?>
    
    <div  class="form">
    <p style="color:red;">* is required</p>
    <?php 
    if($errorCount==0){
      echo "<p style='margin-left:0%;width:25%;border-left: 6px solid green;background-color: lightgrey;'><bold>$succesMessage</bold></p>";
    }else{
      echo "<p style='margin-left:0%;width:25%;border-left: 6px solid red;background-color: lightgrey;'><bold>$succesMessage</bold></p>";   
    }
    ?>
    	<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
    	    <p class="contact"><label >User Name<small style="color:red;" >* <?php echo $usernameErr ?></small></label></p> 
    	    <input name="id" placeholder="id" tabindex="0" type="hidden" value="<?php echo isset($_POST["id"]) ? $_POST["id"] : ''; ?>"> 
    	    <input name="userName" placeholder="User Name" tabindex="1" type="text" value="<?php echo isset($_POST["userName"]) ? $_POST["userName"] : ''; ?>"> 
   			<p class="contact"><label >Password<small style="color:red;" >* <?php echo $passwordErr ?></small></label></p> 
   			<input name="password" placeholder="Password" type="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" > 
            <p class="contact"><label >Re-enter Password<small style="color:red;" >* <?php echo $passwordCheckErr ?></small></label></p> 
  			<input name="passwordCheck" placeholder="Password confirm" type="password" value="<?php echo isset($_POST["passwordCheck"]) ? $_POST["passwordCheck"] : ''; ?>" > </br>
            <small style="color:red;" >* <?php echo $roleErr ?></small></br>
            <select class="select-style gender" name="role" value="<?php echo isset($_POST["role"]) ? $_POST["role"] : ''; ?>" >
            <option value="select">Please select user role.</option>
            <option value="admin" <?php echo $_POST["role"] == "admin" ? "selected" : ''; ?>>Admin</option>
            <option value="user" <?php echo $_POST["role"] == "user" ? "selected" : ''; ?>>User</option>
            </select><br><br>
            <p class="contact"><label >First Name<small style="color:red;" >* <?php echo $firstNameErr ?></small></label></p> 
  			<input placeholder="First Name" name="firstName" type="text"  value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : ''; ?>"> 
            <p class="contact"><label >Last Name<small style="color:red;" >* <?php echo $lastNameErr ?></small></label></p> 
            <input placeholder="Last Name" name="lastName" type="text" value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : ''; ?>" > 
            <p class="contact"><label >E-mail<small style="color:red;" >* <?php echo $emailErr ?></small></label></p> 
            <input placeholder="ex: youremail@gmail.com" name="email" type="text" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>"> 
            <p class="contact"><label >Phone Number<small style="color:red;" >* <?php echo $phoneNumber1Err ?></small></label></p> 
            <input placeholder="ex: 55512377" name="phoneNumber1" type="text" value="<?php echo isset($_POST["phoneNumber1"]) ? $_POST["phoneNumber1"] : ''; ?>" >
            <p class="contact"><label >Phone Number 2</label></p> 
            <input placeholder="ex: 55512377" name="phoneNumber2" type="text" value="<?php echo isset($_POST["phoneNumber2"]) ? $_POST["phoneNumber2"] : ''; ?>" ></br>
            <small style="color:red;" >* <?php echo $doorNumberErr ?></small></br>
            <select class="select-style gender" name="doorNumber" value="<?php echo isset($_POST["doorNumber"]) ? $_POST["doorNumber"] : ''; ?>">
            <option value="select">Please select door number.</option>
            <option value="1" <?php echo $_POST["doorNumber"] == "1" ? "selected" : ''; ?>>NO: 1</option>
            <option value="2" <?php echo $_POST["doorNumber"] == "2" ? "selected" : ''; ?>>NO: 2</option>
            <option value="3" <?php echo $_POST["doorNumber"] == "3" ? "selected" : ''; ?>>NO: 3</option>
            <option value="4" <?php echo $_POST["doorNumber"] == "4" ? "selected" : ''; ?>>NO: 4</option>
            <option value="5" <?php echo $_POST["doorNumber"] == "5" ? "selected" : ''; ?>>NO: 5</option>
            <option value="6" <?php echo $_POST["doorNumber"] == "6" ? "selected" : ''; ?>>NO: 6</option>
            <option value="7" <?php echo $_POST["doorNumber"] == "7" ? "selected" : ''; ?>>NO: 7</option>
            <option value="8" <?php echo $_POST["doorNumber"] == "8" ? "selected" : ''; ?>>NO: 8</option>
            <option value="9" <?php echo $_POST["doorNumber"] == "9" ? "selected" : ''; ?>>NO: 9</option>
            <option value="10" <?php echo $_POST["doorNumber"] == "10" ? "selected" : ''; ?>>NO: 10</option>
            <option value="11" <?php echo $_POST["doorNumber"] == "11" ? "selected" : ''; ?>>NO: 11</option>
            <option value="12" <?php echo $_POST["doorNumber"] == "12" ? "selected" : ''; ?>>NO: 12</option>
            <option value="13" <?php echo $_POST["doorNumber"] == "13" ? "selected" : ''; ?>>NO: 13</option>
            <option value="14" <?php echo $_POST["doorNumber"] == "14" ? "selected" : ''; ?>>NO: 14</option>
            <option value="15" <?php echo $_POST["doorNumber"] == "15" ? "selected" : ''; ?>>NO: 15</option>
            <option value="16" <?php echo $_POST["doorNumber"] == "16" ? "selected" : ''; ?>>NO: 16</option>
            <option value="17" <?php echo $_POST["doorNumber"] == "17" ? "selected" : ''; ?>>NO: 17</option>
            <option value="18" <?php echo $_POST["doorNumber"] == "18" ? "selected" : ''; ?>>NO: 18</option>
            <option value="19" <?php echo $_POST["doorNumber"] == "19" ? "selected" : ''; ?>>NO: 19</option>
            <option value="20" <?php echo $_POST["doorNumber"] == "20" ? "selected" : ''; ?>>NO: 20</option>
            </select><br><br>

            <p class="contact"><label >Family Member Count</label></p> 
            <input placeholder="Family member count" name="familyMemberCount" type="text" value="<?php echo isset($_POST["familyMemberCount"]) ? $_POST["familyMemberCount"] : ''; ?>">
            </br>
            <small style="color:red;" >* <?php echo $genderErr ?></small></br>
            <select class="select-style gender" name="gender" value="<?php echo isset($_POST["gender"]) ? $_POST["gender"] : ''; ?>">
            <option value="select">Please select your gender</option>
            <option value="male" <?php echo $_POST["gender"] == "male" ? "selected" : ''; ?>>Male</option>
            <option value="female"<?php echo $_POST["gender"] == "female" ? "selected" : ''; ?>>Female</option>
            <option value="other"<?php echo $_POST["gender"] == "other" ? "selected" : ''; ?>>Other</option>
            </select>
            <br><br>
            <input class="buttom" name="submit" id="submit" tabindex="50" value="Submit" type="submit"> 
            <input class="buttom"  onclick="location.href='showList.php'" name="cancel" id="cancel" tabindex="50" value="Cancel" type="button">	 
   </form> 
</div>
    </body>
</html>