<?php
    session_start();
    include "../connection.php";

    $user_id = $_SESSION['user_id'];
    $team_id = $_SESSION['team_id'];

    $tran_sql = "SELECT * FROM `test`.`transaction` WHERE `team_id` = $team_id ORDER BY `timestamp`";
    $tran_result = mysqli_query($conn, $tran_sql);


    echo "<div id=\"transactionTableWrap\">";
    echo "<table id=\"transactionTable\" class=\"table table-striped table-bordered dt-responsive break-word\" cellspacing=\"0\" width=\"100%\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th style=\"max-width: 20px\">ID #</th>";
    echo "<th>Debit/Credit</th>";
    echo "<th>Person</th>";
    echo "<th>Place/Account</th>";
    echo "<th>Description</th>";
    echo "<th>Date (YMD)</th>";
    echo "<th>Amount</th>";
    echo "<th>Receipt</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $id_counter = 0;
    $receipt_directory = 'uploads\\receipts\\' . ((string) $team_id);
    while ($row = mysqli_fetch_assoc($tran_result)){
        $id_counter = $id_counter + 1;
        $type = $row['type'];
        $place = $row['place'];
        $desc = $row['description'];
        $date = $row['date'];
        if ($row['amount'] == ''){
            $amount = '$0.00';
        } else {
            $amount = '$' . $row['amount'];
        }
        if ($row['receipt'] !== ''){
            $receipt = $receipt_directory . '\\' .$row['receipt'];
        } else {
            $receipt = NULL;
        }

        $user_id = $row['user_id'];
        $user_sql = "SELECT * FROM `test`.`users` WHERE `idusers` = $user_id ";
        $user_result = mysqli_query($conn, $user_sql);
        $user_row = mysqli_fetch_assoc($user_result);
        $user_name = $user_row['first_name'] . ' ' . $user_row['last_name'];

        echo "<tr>";
        echo "<td>$id_counter</td>";
        if ($type == 'Credit'){
            echo "<td><i class=\"fa fa-minus\" style=\"color: red; padding-right: 5px\"></i>Credit</td>";
        } else {
            echo "<td><i class=\"fa fa-plus\" style=\"color: green; padding-right: 5px\"></i>Debit</td>";
        }
        echo "<td>$user_name</td>";
        echo "<td>$place</td>";
        echo "<td> $desc</td>";
        echo "<td>$date</td>";
        echo "<td>$amount</td>";
        if ($receipt == NULL){
            echo "<td><font color=\"red\">No Receipt</font></td>";
        } else {
            echo "<td><a id=\"receipt_link\" href=\"#ModalReceipt\" data-img-url=\"$receipt\" data-toggle=\"modal\">Receipt $id_counter</a></td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
?>
