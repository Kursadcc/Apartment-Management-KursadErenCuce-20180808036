<?php
    require("../dbConnection.php");
$startDate=$_GET["startDate"];
$endDate=$_GET["endDate"];
    $group = "SELECT t2.expenseType typeName, SUM(amount) total FROM expenses t1 INNER JOIN esxpensetypes t2 ON t1.typeId = t2.id WHERE t1.createDate<='$endDate' and t1.createDate>='$startDate' GROUP BY typeId";

    $resultGroup = mysqli_query($connection, $group) or die(mysqli_error($connection));
    $expenseLabelValueArray = array();
    $expenseLabelArray = array();
    $expenseValueArray = array();
    //check if there is any data returned by the SQL Query
    if ($resultGroup->num_rows > 0) {
      //Converting the results into an associative array
      $counter = 0;
      while($row = $resultGroup->fetch_assoc()) {
        $jsonArrayItem = array();
        $expenseLabelArray[$counter] = $row['typeName'];
        $expenseValueArray[$counter] = intval($row['total']);
        //append the above created object into the main array.
        $counter++;
      }
    }
    //Closing the connection to DB
    $connection->close();
    //set the response content type as JSON
    header('Content-type: application/json');
    //output the return value of json encode using the echo function.
    $expenseLabelValueArray[0] = $expenseLabelArray;
    $expenseLabelValueArray[1] = $expenseValueArray;
    echo json_encode($expenseLabelValueArray);
?>
