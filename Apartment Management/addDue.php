<?php
require('db_connection.php');

    $query = "UPDATE dues SET  debt=debt+45 ";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    header('Location:dues.php');
?>