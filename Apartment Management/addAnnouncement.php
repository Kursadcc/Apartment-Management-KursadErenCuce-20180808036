<?php
require("control.php");
$loginResult = checkLogin();
if (!$loginResult) {
  header("Refresh: 2; url=loginPage.php");
} else if ($_SESSION["role"] != "admin") {
  header("Refresh: 2; url=loginPage.php");
} else {
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
    .form {
      background: #f1f1f1;
      width: 470px;
      margin: 0 auto;
      padding-left: 50px;
      padding-top: 20px;
      margin-top: 15%;
    }

    .form fieldset {
      border: 0px;
      padding: 0px;
      margin: 0px;
    }

    .form p.contact {
      font-size: 12px;
      margin: 0px 0px 10px 0;
      line-height: 14px;
      font-family: Arial, Helvetica;
    }

    .form input[type="text"] {
      width: 400px;
    }

    .form input[type="email"] {
      width: 400px;
    }

    .forminput[type="password"] {
      width: 400px;
    }

    .form input.birthday {
      width: 60px;
    }

    .form input.birthyear {
      width: 120px;
    }

    .form label {
      color: #000;
      font-weight: bold;
      font-size: 12px;
      font-family: Arial, Helvetica;
    }

    .form label.month {
      width: 135px;
    }

    .form input,
    textarea {
      background-color: rgba(255, 255, 255, 0.4);
      border: 1px solid rgba(122, 192, 0, 0.15);
      padding: 7px;
      font-family: Keffeesatz, Arial;
      color: #4b4b4b;
      font-size: 14px;
      border-radius: 5px;
      margin-bottom: 15px;
      margin-top: -10px;
    }

    .form input:focus,
    textarea:focus {
      border: 1px solid #ff5400;
      background-color: rgba(255, 255, 255, 1);
    }

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
      white-space: nowrap;
    }

    .form .gender {
      width: 410px;
    }

    .form input.buttom {
      background: #4b8df9;
      display: inline-block;
      padding: 5px 10px 6px;
      color: #fbf7f7;
      text-decoration: none;
      font-weight: bold;
      line-height: 1;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      -moz-box-shadow: 0 1px 3px #999;
      -webkit-box-shadow: 0 1px 3px #999;
      box-shadow: 0 1px 3px #999;
      text-shadow: 0 -1px 1px #222;
      border: none;
      position: relative;
      cursor: pointer;
      font-size: 14px;
      font-family: Verdana, Geneva, sans-serif;
    }

    .form input.buttom:hover {
      background-color: #2a78f6;
    }
  </style>
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' />

  <?php
  function clearForm()
  {
    $_POST["date"] = "";
    $_POST["content"] = "";
  }
  $error = 1;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $succesMsg = "";
    $date = $_POST['date'];
    $content = $_POST['content'];
    require('db_connection.php');
    $query = "INSERT INTO `announcement`(`announceDate`, `content`) VALUES ( '" . $date . "','" . $content . "')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $succesMsg = "Announcement is shared.";
    $error = 0;
    clearForm();
    header('Location:announcements.php');
  }

  ?>
  <div class="form">
    <?php
    if ($error == 0) {
      echo "<p style='margin-left:0%;width:25%;border-left: 6px solid green;background-color: lightgrey;'><bold>$succesMsg</bold></p>";
    }
    ?>
    <form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <p class="contact"><label>Date</label></p>
      <input name="date" type="date">
      <p class="contact"><label>Content</label></p>
      <textarea rows="5" cols="60" name="content">Enter details here...</textarea>

      <input class="buttom" name="submit" id="submit" tabindex="50" value="Submit" type="submit">
      <input class="buttom" onclick="location.href='announcements.php'" name="cancel" id="cancel" tabindex="50" value="Cancel" type="button">
    </form>
  </div>

</body>

</html>