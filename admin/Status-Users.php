<?php
    error_reporting(0);
    $active_id = $_GET['aid'];
    $inactive_id = $_GET['bid'];
    $act_id = $_GET['cid'];
    $in_act_id = $_GET['did'];
    $maid = $_GET['maid'];
    $mdid = $_GET['mdid'];
    $ppfid = $_GET['ppfid'];
    $ppdid = $_GET['ppdid'];
    $connection = mysqli_connect("localhost","root","","shop");


if(isset($active_id) && $active_id > 0)
{
    $sql = "UPDATE users SET status = '1' WHERE id = '$active_id'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Users.php');
}
if(isset($inactive_id) && $inactive_id > 0)
{
    $sql = "UPDATE users SET status = '0' WHERE id = '$inactive_id'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Users.php');
}
if(isset($maid) && $maid > 0)
{
    $sql = "UPDATE messages SET status = '1' WHERE id = '$maid'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Messages.php');
}
if(isset($mdid) && $mdid > 0)
{
    $sql = "UPDATE messages SET status = '0' WHERE id = '$mdid'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Messages.php');
}

if(isset($act_id) && $act_id > 0)
{
    $sql = "UPDATE contactus SET status = '1' WHERE id = '$act_id'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-ContactUs.php');
}
if(isset($in_act_id) && $in_act_id > 0)
{
    $sql = "UPDATE contactus SET status = '0' WHERE id = '$in_act_id'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-ContactUs.php');
}
if(isset($ppfid) && $ppfid > 0)
{
    $sql = "UPDATE blog SET status = '1' WHERE id = '$ppfid'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Posts.php');
}
if(isset($ppdid) && $ppdid > 0)
{
    $sql = "UPDATE blog SET status = '0' WHERE id = '$ppdid'; ";
    $query = mysqli_query($connection, $sql);
    header('Location: Show-Posts.php');
}