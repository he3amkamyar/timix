<?php
$pid = $_GET['pid'];
$cid = $_GET['cid'];
$uid = $_GET['uid'];
$mid = $_GET['mid'];
$ppid = $_GET['ppid'];
$connection = mysqli_connect("localhost","root","","shop");

if(isset($pid) && $pid > 0)
{
    $sql = "SELECT * FROM product WHERE id = '$pid'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);
    $sql1 = "DELETE from product WHERE id = '$pid'";
    $query1 = mysqli_query($connection, $sql1);
    $image = $row['image'];
    unlink('images/'.$image);
    header('Location: Show-Products.php');
}
if(isset($mid) && $mid > 0)
{
    $sql = "SELECT * FROM messages WHERE id = '$mid'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);
    $sql1 = "DELETE from messages WHERE id = '$mid'";
    $query1 = mysqli_query($connection, $sql1);
    header('Location: Show-Messages.php');
}
if(isset($cid) && $cid > 0)
{
    $sql = "DELETE from contactus WHERE id = '$cid'";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-ContactUs.php');
}
if(isset($uid) && $uid > 0)
{
    $sql = "DELETE from users WHERE id = '$uid'";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Users.php');
}
if(isset($ppid) && $ppid > 0)
{
    $sql = "DELETE from blog WHERE id = '$ppid'";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Posts.php');
}