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
<body id="body" style="display: none;">
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 70%;
  margin-left: 15%;
  margin-top: 20px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #d9dbdc;
}

#customers tr:nth-child(odd){background-color: #ffffff;
}
#customers tr:hover {background-color: #adaeaf;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #355685;
  color: white;
}
.popup{
  width: 100%;
  height: 100vh;
  display: none;
  
  position: fixed;
  top: 0;
  right: 0;
}

#popup-article:target{
  display: flex;
}

.popup::before{
  content: "";
  box-sizing: border-box;
  width: 50%;
  background-image:url("https://i.pinimg.com/736x/8a/44/79/8a447928116ae5440922ef357dadcf7e.jpg");
  background-size: contain;
  background-repeat: no-repeat;
  margin-left: 30%;

  position: fixed;
  left: 0;
  top: 50%;
  will-change: height, top;
  animation: open-animation .6s cubic-bezier(0.83, 0.04, 0, 1.16) .65s both;
}

.popup::after{
  content: "";
  width: 0;
  height: 2px;
  background-color: #f0f0f0;

  will-change: width, opacity;
  animation: line-animation .6s cubic-bezier(0.83, 0.04, 0, 1.16) both;

  position: absolute;
  top: 50%;
  left: 0;
  margin-top: -1px;
}

@keyframes line-animation{

  0%{
    width: 0;
    opacity: 1;
  }

  99%{
    width: 100%;
    opacity: 1;
  }

  100%{
    width: 100%;
    opacity: 0;
  }  
}

@keyframes open-animation{

  0%{
    height: 0;
    top: 50%;
  }

  100%{
    height: 100vh;
    top: 0;
  }
}

.popup__block{
  height: calc(100vh - 40px);
  padding: 5% 15%;
  box-sizing: border-box;
  position: relative;
  
  margin-left: 20%;
  overflow: auto;
  animation: fade .5s ease-out 1.3s both;
}

@keyframes fade{

  0%{
    opacity: 0;
  }

  100%{
    opacity: 1;
  }
}

.popup__title{
  font-size: 1.5rem;
  margin: 0 0 1em;
}

.popup__close{
  width: 2rem;
  height: 2rem;
  text-indent: -9999px;

  position: fixed;
  top: 20px;
  right: 20px;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: contain;
  background-image: url(data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjMDAwMDAwIiBoZWlnaHQ9IjI0IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHdpZHRoPSIyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4gICAgPHBhdGggZD0iTTE5IDYuNDFMMTcuNTkgNSAxMiAxMC41OSA2LjQxIDUgNSA2LjQxIDEwLjU5IDEyIDUgMTcuNTkgNi40MSAxOSAxMiAxMy40MSAxNy41OSAxOSAxOSAxNy41OSAxMy40MSAxMnoiLz4gICAgPHBhdGggZD0iTTAgMGgyNHYyNEgweiIgZmlsbD0ibm9uZSIvPjwvc3ZnPg==);
}

body{
  font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Open Sans, Ubuntu, Fira Sans, Helvetica Neue, sans-serif;
  font-size: 1rem;
  color: #222;
  background-color: #512da8;
  margin: 0;
}

p{
  margin: 0;
  line-height: 1.5;
}

p:nth-child(n+2){
  margin-top: 1rem;
}

.open-popup{
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  padding: .75rem 1.25rem;
  border: 1px solid;
}

.page{
  min-height: 100vh;
  display: flex;
}

.page__container{
  max-width: 1200px;
  padding-left: .75rem;
  padding-right: .75rem;  
  margin: auto;
}
a {
    text-decoration: none ;
}

a:hover {
    color:white;
    text-decoration:none;
    cursor:pointer;
}

</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"> </script>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css' /></br>
<h1 style="margin-left: 32%;" >Apartment Management<img src="logo.png" alt="logo"></h1>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="announcements.php">Announcements</a>
        </li>
        <li>
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
    </div>
    <div style="margin-left:0%;" class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="economy.php">Income/Expense</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="dues.php">Dues<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showList.php">Resident List</a>
        </li>
        
        <li class="nav-item" style="margin-right:10px;">
        </li>
      </ul>
    </div>
    <a style="margin-right:2%;" class="nav-item" >Logged in: <?php echo $_SESSION['userName']; ?></a>
    <a style="margin-right:2%;" class="nav-link" href="logout.php">Log out</a>
  </nav></br></br>
  <ul style="border-color:#222;width:70%;margin-left:15%;" class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link" href="dues.php">Dues</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="dueHistory.php">Due History</a>
  </li>
</ul></br></br>
<table style="width:70%;margin-left:15%;"  class="table table-striped table-hover ">
  <tr style='background-color:rgb(25, 21, 53);color:white;'>
    <th>Door Number</th>
    <th>Payment Date</th>
    <th>Paid Amount</th>
    <th>Remaining Debt</th>
  </tr>
<?php
  require('db_connection.php');
  $sql = "SELECT * FROM due_history";
  $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>NO: {$row['door_number']}</td><td>{$row['payment_date']}</td><td>{$row['paid_amount']} ₺</td><td>{$row['remaining_debt']} ₺</td></tr>";
    }
} else {
    echo "0 results";
}
$connection->close();
      
?>


</body>
</html>