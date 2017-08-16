<?php 
include "connection.php";

if (isset($_POST['done'])) {
    $name = mysql_escape_string($_POST['username']);
    $comment = mysql_escape_string($_POST['comment']);

    //insert into database
    
    mysql_query("INSERT INTO comments(name, comment) VALUES('{$name}', '{$comment}')");
    exit();
}
    
?>