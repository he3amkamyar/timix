<?php
session_start();
if(!isset($_SESSION['is-admin']))
{
    header('Location: LogIn.php');
}
$id = $_GET['id'];
$connection = mysqli_connect("localhost","root","","shop");
$query = mysqli_query($connection, "SELECT * FROM product WHERE id='$id'");
$row = mysqli_fetch_array($query);
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
            <a class="navbar-brand" href="Show-Users.php">پنل مدیریت - مشاهده کاربران</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">پیشخوان</a></li>
            <li><a href="../Blog.php">مشاهده وبلاگ</a></li>
            <li><a href="Add-Product.php">افزودن محصول</a></li>
            <li><a href="Add-Post.php">افزودن پست</a></li>
            <li><a href="Show-Products.php">نمایش محصولات</a></li>
            <li><a href="Show-Posts.php">نمایش پست ها</a></li>
            <li class="active"><a href="Show-Users.php">نمایش کاربران</a></li>
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
        <h3 style="padding: 10px 10px;" class="text-center bg-info">ویرایش محصول</h3>
        <br />
        <form style="padding: 10px 10px;" class="bg-primary" method="post" action="" enctype="multipart/form-data">
            <label>نام محصول</label>
            <br />
            <label><input class="form-control" type="text" name="title" value="<?php echo $row['title'];?>"/></label>
            <br />
            <label>عکس قبلی محصول</label>
            <br />
            <label><img style="width: 50px;height: 50px;border: 2px solid black;" src="<?php echo 'images/' . $row['image'];?>"/></label>
            <br />
            <label>عکس جدید محصول</label>
            <br />
            <label><input class="form-control" type="file" name="image"/></label>
            <br />
            <label>توضیحات محصول</label>
            <br />
            <label><textarea class="form-control" rows="5" cols="40" name="desc"><?php echo $row['description'];?></textarea></label>
            <br />
            <label>قیمت محصول</label>
            <br />
            <label><input class="form-control" type="text" name="price" value="<?php echo $row['price'];?>"/></label>
            <label><input style="width: 40px;" type="text" value=" تومان " disabled/></label>
            <br />
            <label><input  class="form-control btn-success" type="submit" value="افزودن" name="submit"/></label>
            <label><input  class="form-control btn-danger" type="reset" value="ریست"/></label>
        </form>
    </div>
</body>
</html>
<?php
$connection = mysqli_connect("localhost","root","","shop");
if(isset($_POST['submit'])){

    $delete_image_query = mysqli_query($connection , "SELECT * FROM product WHERE id='$id'");
    $row1 = mysqli_fetch_array($delete_image_query);
    $image =  $row1['image'];
    $delete_image = unlink('images/'.$image);

system.out.println("hello");
echo "hello";

    $title = $_POST['title'];
    $edit_image = $_FILES['image']['name'];
    $target = "images/".basename($_FILES['image']['name']);
    $image_type = strtolower(pathinfo($target , PATHINFO_EXTENSION));
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    if (file_exists($target)){
        echo 'عکس قبلا وجود داشته لطفا نام آن را تغیرر دهید';
    }
    else{
        $query = mysqli_query($connection , "UPDATE product SET title='$title' , image='$edit_image' , description='$desc' , price='$price' WHERE id='$id'");
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($query){
            header('Location: Show-Products.php?edit=ok');
        }if(!$query)
        {
            echo 'افزودن انجام نشد';
        }
    }
}
