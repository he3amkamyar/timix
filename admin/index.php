<?php
session_start();
if(!isset($_SESSION['is-admin']))
    {
        header('Location: LogIn.php');
    }
?>
<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پیشخوان</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.css"/>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <style>
    *
    {
        font-family: yekan;
    }
</style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="">پنل مدیریت - پیشخوان</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">پیشخوان</a></li>
            <li><a href="../Blog.php">مشاهده وبلاگ</a></li>
            <li><a href="Add-Product.php">افزودن محصول</a></li>
            <li><a href="Add-Post.php">افزودن پست</a></li>
            <li><a href="Show-Products.php">نمایش محصولات</a></li>
            <li><a href="Show-Posts.php">نمایش پست ها</a></li>
            <li><a href="Show-Users.php">نمایش کاربران</a></li>
            <li><a href="Show-ContactUs.php">پیام ها</a></li>
            <li><a href="Show-Messages.php">نظرات</a></li>
            <li><a href="order.php">سفارشات</a></li>
            <li class="bg-danger"><a href="../delete-session.php">خروج</a></li>
        </ul>
    </div>
</nav>
<style>
    th,td
    {
        text-align: center;
    }
</style>
<?php
$conn = mysqli_connect("localhost","root","","shop");

$sql1 = "SELECT count(*) FROM users WHERE status = '1'";
$query1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($query1);
$users1 = array_shift($row1);

$sql1 = "SELECT count(*) FROM users WHERE status = '0'";
$query1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($query1);
$users2 = array_shift($row1);

$sql2 = "SELECT count(*) FROM product WHERE status = '1'";
$query2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($query2);
$products1 = array_shift($row2);

$sql2 = "SELECT count(*) FROM product WHERE status = '0'";
$query2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($query2);
$products2 = array_shift($row2);

$sql3 = "SELECT count(*) FROM contactus";
$query3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_array($query3);
$messages = array_shift($row3);

$ip = $_SERVER['REMOTE_ADDR'];

$browser = $_SERVER['HTTP_USER_AGENT'];
echo ' browser :  '. substr($browser,0,7);
if($ip != '127.0.0.1')
{
    echo "Error";
}

$sql4 = "SELECT count(*) FROM messages WHERE status = '0'";
$query4 = mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_array($query4);
$mess = array_shift($row4);

$sql5 = "SELECT count(*) FROM messages WHERE status = '1'";
$query5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_array($query5);
$mes = array_shift($row5);

$sql6 = "SELECT COUNT(*) FROM product,backet WHERE product.id = backet.pid";
$query6 = mysqli_query($conn,$sql6);
$row6 = mysqli_fetch_array($query6);
$mes1 = array_shift($row6);
?>
<div class="container">
    <h3 class="text-info text-left bg-success"> ایپی شما :  <?php echo $ip;?></h3>
    <h3 class="text-info text-left bg-success"> کاربران فعال : <?php echo $users1 . ' نفر ';?></h3>
    <h3 class="text-info text-left bg-danger"> کاربران غیر فعال :  <?php echo $users2 .' نفر ';?></h3>
    <h3 class="text-info text-left bg-success"> محصولات فعال :  <?php echo $products1 . ' عدد ';?></h3>
    <h3 class="text-info text-left bg-danger"> محصولات غیر فعال :   <?php echo $products2 . ' عدد ';?></h3>
    <h3 class="text-info text-left bg-success"> نظرات تایید شده:  <?php echo $mes . ' عدد ';?></h3>
    <h3 class="text-info text-left bg-danger"> نظرات تایید نشده:   <?php echo $mess . ' عدد ';?></h3>
    <h3 class="text-info text-left bg-success"> پیام های دریافتی :  <?php echo $messages . ' عدد ';?></h3>
    <h3 class="text-info text-left bg-success">سفارشات کاربران :  <?php echo $mes1 . ' عدد ';?></h3>
</div>
<style>
    h3
    {
        padding: 10px 10px;
        border: 1px solid grey;
    }
</style>
</body>
</html>