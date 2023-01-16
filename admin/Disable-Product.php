<?php

$en = $_GET['en'];
$di = $_GET['di'];

$connection = mysqli_connect("localhost","root","","shop");


if(isset($en) && $en > 0)
{
    $sql = "UPDATE product SET status = '1' WHERE id = '$en'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Products.php');
}
if(isset($di) && $di > 0)
{
    $sql = "UPDATE product SET status = '0' WHERE id = '$di'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Products.php');
}