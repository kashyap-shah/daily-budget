<?php
    //connection
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $database = "budget";

    $conn = mysqli_connect($servername, $username, $password,$database);

    if(!$conn){
        echo mysqli_connect_error();
        die;
    }
?>