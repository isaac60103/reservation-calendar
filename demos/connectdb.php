<?php
header('Content-Type: text/html; charset=utf-8');


$conn = @mysqli_connect("localhost", "root", "isaac60103", "calendardb");

if(mysqli_connect_errno($conn))
    die("can not connect to db");

mysqli_set_charset($conn, "utf8");



if($result=mysqli_query($conn, "SELECT * FROM eventtable")){

   // printf("finish");
    $row=mysqli_fetch_array($result);
    echo "$row[0]";


}




//echo "t1234";

?>
