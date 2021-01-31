<?php
require("control.php");
$loginResult=checkLogin();
if(!$loginResult){
  header("Refresh: 2; url=loginPage.php");
}else if($_SESSION["role"]!="admin"){
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
<h1 style="margin-left: 32%;" ><img src="logo.png" alt="logo">Apartment Management</h1>
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
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="economy.php">Income/Expense<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dues.php">Dues</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="showList.php">Resident List</a>
        </li>
        <li class="nav-item" style="margin-right:10px;">
        </li>
      </ul>
    </div>
    <p style="margin-right:2%;color:white;" class="nav-item" ><?php echo $_SESSION['userName']; ?></p>
    <button style="width:129px" class="btn btn-danger"><a style="margin-right:2%;color:white;" class="nav-link" href="logout.php">Log out</a></button>
  </nav>
  <div style="margin-left: 39%;" id="piechart"></div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

  // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Income', <?php 
          require('db_connection.php');
          $sql = mysqli_query($connection,"SELECT SUM(income_amount) as total FROM income") or die(mysqli_error($connection));;
          $row = mysqli_fetch_array($sql);
          $sum = $row['total'];
          echo $sum;
        ?>],
        ['Expense', <?php 
          require('db_connection.php');
          $sql = mysqli_query($connection,"SELECT SUM(expense_amount) as total FROM expense") or die(mysqli_error($connection));;
          $row = mysqli_fetch_array($sql);
          $sum = $row['total'];
          echo $sum;
        ?>],
      ]);

  // Optional; add a title and set the width and height of the chart
    var options = {'title':'Income/Expense', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
</script>
  <ul style="border-color:#222;width:70%;margin-left:15%;" class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link" href="economy.php">Income</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="expense.php">Expense</a>
  </li>
</ul></br>
<button style="margin-left:81.5%;" onclick="location.href='addExpense.php'" class="btn btn-success">+Add</button>
<div style="width:70%;margin-left:15%;background-color:rgb(240,240,240);" >
  <table class="table table-striped table-hover ">
  <tr style='background-color:rgb(25, 21, 53);color:white;'>
    <th>Explanation</th>
    <th>Expense Date</th>
    <th>Expense Amount</th>
    <th></th>
  </tr>

<?php
 $id="";
 if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["delete"])){
   $id=$_POST["id"];
   delete($id);
 }
   function delete($data){
   require('db_connection.php'); 
   
   $sql1="DELETE FROM expense WHERE id=$data";
   $result1=mysqli_query($connection, $sql1) or die(mysqli_error($connection));
   $sql2="SELECT * FROM expense WHERE id=$data";
   $result2=mysqli_query($connection, $sql2) or die(mysqli_error($connection));
   if ($result2->num_rows > 0) {
       echo "<script>alert('Expense could not deleted.');</script>";
   }else
       echo "<script>alert('Expense successfully deleted.');</script>";

 }
  require('db_connection.php'); 
  $sql = "SELECT * FROM expense ";
  $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['explanation']}</td><td >{$row['expense_date']}</td><td >{$row['expense_amount']} ₺</td><td style='width: 50px;'><form action='expense.php' method='post'><input class='btn btn-danger' type='submit' name='delete' value='Delete' /><input type='hidden' name='id' value='".$row["id"]."'/></form></td></tr>";
    }
    
} else {
  echo "0 results";
}
$connection->close();
?>
  </table>
</div>
</body>
</html>