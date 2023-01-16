<?php
session_start();
if(isset($_SESSION['name']))
{
    $uid = $_SESSION['uid'];
    $conn = mysqli_connect("localhost", "root", "", "shop");
    echo $i = $_GET['id'];
    $sql = "INSERT INTO backet (id,pid,uid,ctime) VALUES (NULL,'$i','$uid',current_timestamp )";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location:index.php');
    }
}
else
{
    header('Location:index.php');
}