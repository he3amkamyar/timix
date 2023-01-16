<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['is-admin']))
    {
        header('Location:LogIn.php');
    }
    include_once '../jdf.php';
?>
<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سفارشات</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.css"/>
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
            <a class="navbar-brand" href="Show-Users.php">پنل مدیریت - سفارشات</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">پیشخوان</a></li>
            <li><a href="../Blog.php">مشاهده وبلاگ</a></li>
            <li><a href="Add-Product.php">افزودن محصول</a></li>
            <li><a href="Add-Post.php">افزودن پست</a></li>
            <li><a href="Show-Products.php">نمایش محصولات</a></li>
            <li><a href="Show-Users.php">نمایش کاربران</a></li>
            <li><a href="Show-ContactUs.php">پیام ها</a></li>
            <li><a href="Show-Messages.php">نظرات</a></li>
            <li class="active"><a href="order.php">سفارشات</a></li>
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
<h2 style="padding: 10px;" class="bg-info text-primary text-center">سفارشات کاربران</h2>
<?php
$conn = mysqli_connect("localhost","root","","shop");
$sql = "SELECT product.*,backet.* FROM product,backet WHERE product.id = backet.pid ORDER BY backet.id DESC";
$query = mysqli_query($conn,$sql);
?>
<div class="container">
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ردیف</th>
            <th>نام محصول</th>
            <th>تصویر محصول</th>
            <th>توضیحات</th>
            <th>قیمت</th>
            <th>تاریخ و زمان ثبت</th>
            <th>نام سفارش دهنده</th>
            <th>تلفن سفارش دهنده</th>
        </tr>
        <?php
        $num = 1;
        while($row = mysqli_fetch_array($query)):
        ?>
        <tr>
            <td><?php echo $num++;?></td>
            <td>
                <a title="جهت مشاهده محصول کلیک کنید" style="color: black;" href="../post.php?id=<?php echo $row['pid']; ?>"><?php echo $row['title'];?></a>
            </td>
            <td>
                <a href="images/<?php echo $row['image'];?>">
                    <img title="برای دیدن کامل تصویر روی آن کلیک کنید" style="width: 50px;height: 50px;background: red;" src="images/<?php echo $row['image'];?>"/>
                </a>
            </td>
                    <?php
                    $e = substr($row['ctime'],0,11);
                    $l = substr($row['ctime'],11,19);
                    $f = explode('-',$e);
                    $g = (gregorian_to_jalali($f[0],$f[1],$f[2]));
                    ?>
            <td><?php echo $row['description'];?></td>
            <?php
            $op = $row['uid'];
            $sql1 = "SELECT * FROM users WHERE id = '$op'";
            $query1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_array($query1);
            ?>
            <td><?php echo number_format($row['price']) . ' تومان ';?></td>
            <td>
                <?php
                echo $g[0];
                echo '-';
                echo $g[1];
                echo '-';
                echo $g[2];
                echo '&nbsp;|&nbsp;';
                echo $l;
                ?>
            </td>
            <td><?php echo $row1['fullname'];?></td>
            <td><a title="جهت تماس کلیک کنید" href="tel:<?php echo $row1['phone'];?>"><?php echo $row1['phone'];?></a></td>
        </tr>
        <?php endwhile;?>
    </table>
</div>
</body>
</html>