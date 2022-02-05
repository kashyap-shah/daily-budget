<?php
    include_once "connection.php";

    $sqlBank = "SELECT * FROM bank";
    $bank = mysqli_query($conn, $sqlBank);

    $sqlTransactions = "SELECT * FROM transactions";
    $transactions = mysqli_query($conn, $sqlTransactions);
    
    if(isset($_POST['btnCredit'])){
        $amount = $_POST['txtAmount'];
        $bankname = $_POST['bankName'];
        $creditedFrom = $_POST['txtSummary'];
        $date = DateTime::createFromFormat('d/m/Y', $_POST['dateCredit']);
        $date = $date->format('Y-m-d');
        // print_r($_POST);

        $insertSql = "INSERT INTO transactions(typeoftransaction,transactionfrom,amount,summary,dateupdated) VALUES('Credit','$bankname','$amount','$creditedFrom','$date')";
        // echo $insertSql;
        $updateSql = "UPDATE bank SET $bankname=$bankname+$amount, dateupdated=NOW()";
        // echo $updateSql;

        $insertResult = mysqli_query($conn, $insertSql);
        $updateResult = mysqli_query($conn, $updateSql);
        $bank = mysqli_query($conn, $sqlBank);
        $transactions = mysqli_query($conn, $sqlTransactions);
    }

    if(isset($_POST['btnDebit'])){
        $amount = $_POST['txtAmount'];
        $bankname = $_POST['bankName'];
        $debitedTo = $_POST['txtSummary'];
        $date = DateTime::createFromFormat('d/m/Y', $_POST['dateDebit']);
        $date = $date->format('Y-m-d');
        // print_r($_POST);

        $insertSql = "INSERT INTO transactions(typeoftransaction,transactionfrom,amount,summary,dateupdated) VALUES('Debit','$bankname','$amount','$debitedTo','$date')";
        // echo $insertSql;
        $updateSql = "UPDATE bank SET $bankname=$bankname-$amount, dateupdated=NOW()";
        // echo $updateSql;

        $insertResult = mysqli_query($conn, $insertSql);
        $updateResult = mysqli_query($conn, $updateSql);
        $bank = mysqli_query($conn, $sqlBank);
        $transactions = mysqli_query($conn, $sqlTransactions);
    }
    