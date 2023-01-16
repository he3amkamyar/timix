<?php
$pid = $_GET['pid'];
$uid = $_GET['uid'];

$conn = mysqli_connect("localhost","root","","shop");
$sql = "DELETE FROM backet WHERE pid = '$pid' AND uid = '$uid'";
$query = mysqli_query($conn, $sql);

if($query)
{
    header('Location:../backet.php?del=ok');
}