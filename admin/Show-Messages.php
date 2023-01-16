<?php
session_start();
if(!isset($_SESSION['is-admin']))
{
    header('Location: LogIn.php');
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <title>فروشگاه لپ تاپ مرکزی</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.css"/>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <style>
    *
    {
        font-family: yekan;
    }
</style>
    <style>
        th,tr,td
        {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            padding: 10px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="Show-Users.php">پنل مدیریت - نمایش محصولات</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">پیشخوان</a></li>
            <li><a href="../Blog.php">مشاهده وبلاگ</a></li>
            <li><a href="Add-Product.php">افزودن محصول</a></li>
            <li><a href="Add-Post.php">افزودن پست</a></li>
            <li><a href="Show-Products.php">نمایش محصولات</a></li>
            <li><a href="Show-Posts.php">نمایش پست ها</a></li>
            <li><a href="Show-Users.php">نمایش کاربران</a></li>
            <li><a href="Show-ContactUs.php">پیام ها</a></li>
            <li class="active"><a href="Show-Messages.php">نظرات</a></li>
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
<div class="container">
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>ردیف</th>
            <th>نام کاربر</th>
            <th>متن نظر</th>
            <th>برای محصول</th>
            <th>تاریخ ثبت</th>
            <th>وضعیت</th>
            <th>حذف</th>
            <th>فعال | غیر فعال</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost","root","","shop");
        $sql = "SELECT * FROM messages ORDER BY id DESC";
        $query = mysqli_query($conn,$sql);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)):
            $i = $row['pid'];
        ?>
        <tr>
            <?php
            if(($row['status'] == 1)):
                ?>
                <td><?php echo $num++;?></td>
            <?php endif;?>
            <?php
                if(($row['status'] == 0)):
            ?>
            <td><?php echo '<b style="color: red;"> ̌ </b>'.$num++;?></td>
        <?php endif;?>
                <td><?php echo $row['fullname'];?></td>
                <td><?php echo $row['message'];?></td>
                <?php
                $sql1 = "SELECT * FROM product WHERE id = '$i'";
                $query1 = mysqli_query($conn,$sql1);
                $r = mysqli_fetch_array($query1);
                ?>
                <td><?php echo $r['title'];?></td>
                <td><?php echo $row['ctime'];?></td>
                <?php if($row['status'] == 0):?>
                    <td><span style="color: red;" class="glyphicon glyphicon-remove"></span></td>
                <?php endif;?>
                <?php if($row['status'] == 1):?>
                    <td><span style="color: green;" class="glyphicon glyphicon-ok"></span></td>
                <?php endif;?>
                <td><button class="glyphicon glyphicon-trash"  onclick="func()" type="button" value="delete">  </button></td>
                <?php
                if($row['status'] == 0):?>
                    <td>
                        <a href="Status-Users.php?maid=<?php echo $row['id'];?>"><button class="btn-success"> فعال کردن </button></a>
                    </td>
                <?php endif;?>
                <?php
                if($row['status'] == 1):?>
                    <td>
                        <a href="Status-Users.php?mdid=<?php echo $row['id'];?>"><button class="btn-danger">غیر فعال کردن </button></a>
                    </td>
                    </tr>
                <?php endif;?>
            <?php
            $_SESSION['id'] = $row['id'];
        endwhile;
        ?>
    </table>
</div>
<script>
    function func() {
        const box = window.confirm(" آیا این نظر حذف شود؟ ");
        if (box.valueOf() === true)
        {
            location.href = ("Delete.php?mid=<?php echo $_SESSION['id'];?>");
        }
        else
        {
            location.href = ("Show-Messages.php");
        }
    }
</script>
</body>
</html>