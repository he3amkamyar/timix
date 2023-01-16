<?php
session_start();
if(!isset($_SESSION['is-admin']))
{
    header('Location: LogIn.php');
}
?>
<!DOCTYPE html>
<html dir="rtl">
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
            <li class="active"><a href="Add-Product.php">افزودن محصول</a></li>
            <li><a href="Add-Post.php">افزودن پست</a></li>
            <li><a href="Show-Products.php">نمایش محصولات</a></li>
            <li><a href="Show-Posts.php">نمایش پست ها</a></li>
            <li><a href="Show-Users.php">نمایش کاربران</a></li>
            <li><a href="Show-ContactUs.php">پیام ها</a></li>
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
        <h3 style="padding: 10px 10px;" class="text-success text-center bg-info">افزودن محصول</h3>
        <br />
        <form style="padding: 10px 10px;" class="bg-primary" method="post" action="Add-Product.php" enctype="multipart/form-data">
            <label>نام محصول</label>
            <br />
            <label><input class="form-control" type="text" name="title"/></label>
            <br />
            <label>عکس محصول</label>
            <br />
            <label><input class="form-control" type="file" name="image"/></label>
            <br />
            <label>توضیحات محصول</label>
            <br />
            <label><textarea class="form-control" rows="5" cols="40" name="desc"></textarea></label>
            <br />
            <label>قیمت محصول</label>
            <br />
            <label><input class="form-control" type="text" name="price"/></label>
            <label><input class="btn-danger" type="button" value=" تومان " disabled/></label>
            <br />
            <label><input class="form-control btn-success" type="submit" value="افزودن" name="submit"/></label>
            <label><input class="form-control btn-info" type="reset" value="ریست"/></label>
        </form>
    </div>
</body>
</html>
<?php
$connection = mysqli_connect("localhost","root","","shop");
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $target = "images/".basename($_FILES['image']['name']);
    $image_type = strtolower(pathinfo($target , PATHINFO_EXTENSION));
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "INSERT INTO product (id,title,image,description,price) VALUES (null,'$title','$image','$desc','$price')";
        $query = mysqli_query($connection ,$sql);
}
?>
