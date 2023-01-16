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
            <li class="active"><a href="Show-Posts.php">نمایش پست ها</a></li>
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
    <div class="container">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>عنوان پست</th>
                    <th>تصویر پست</th>
                    <th>توضیحات</th>
                    <th>تاریخ درج پست</th>
                    <th>وضعیت</th>
                    <th>حذف</th>
                    <th>فعال | غیر فعال</th>
                </tr>
                <?php
                $conn = mysqli_connect("localhost","root","","shop");
                $sql = "SELECT * FROM blog";
                $query = mysqli_query($conn,$sql);
                $num = 1;
                while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?php echo $num++;?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><img style='width: 50px;height: 50px;' src="<?php echo 'images/'.$row['image'];?>" alt=""></td>
                        <td><div style="overflow: scroll;height: 100px;"><?php echo $row['description'];?></div></td>
                        <td><?php echo $row['ctime'];?></td>
                        <?php if($row['status'] == 0):?>
                            <td><span style="color: red;" class="glyphicon glyphicon-remove"></span></td>
                        <?php endif;?>
                        <?php if($row['status'] == 1):?>
                            <td><span style="color: green;" class="glyphicon glyphicon-ok"></span></td>
                        <?php endif;?>
                        <td>
                            <a href="Delete.php?ppid=<?php echo $row['id'];?>">
                                <button class="glyphicon glyphicon-trash" type="button" value="delete">
                                </button>
                            </a>
                        </td>
                        <?php
                        if($row['status'] == 0):?>
                            <td>
                                <a href="Status-Users.php?ppfid=<?php echo $row['id'];?>"><button class="btn-success"> فعال کردن </button></a>
                            </td>
                        <?php endif;?>
                        <?php
                        if($row['status'] == 1):?>
                            <td>
                                <a href="Status-Users.php?ppdid=<?php echo $row['id'];?>"><button class="btn-danger">غیر فعال کردن </button></a>
                            </td>
                        <?php endif;?>
                    </tr>
                    <?php
                    $_SESSION['id'] = intval($row['id']);
                endwhile;
                ?>
            </table>
        </div>
</body>
</html>