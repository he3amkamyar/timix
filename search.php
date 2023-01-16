<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <title> فروشگاه اینترنتی تیمیکس </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.css"/>
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['is-admin'])):?>
    <b style="margin-right: 12px;" class="text-info"><?php echo ' مدیریت محترم ' . ' خوش امدید '?> </b>
<?php endif;?>
<?php if(isset($_SESSION['name']) && !isset($_SESSION['is-admin'])):?>
    <b style="color: black;margin-right: 20px;"><?php echo $_SESSION['name'].' خوش امدید '?> </b>
    <p><a href="backet.php">مشاهده سبد خرید</a></p>
    <p><a href="delete-session.php">خروج</a></p>
<?php endif;?>
<?php
if(!isset($_SESSION['name']) && !isset($_SESSION['is-admin'])):?>
    <b style="color: black;"><?php echo ' کاربر گرامی '.' خوش امدید '?> </b>
<?php endif;?>
<div class="row">
    <h1 style="padding: 10px 10px;" class="text-center text-primary bg-info">فروشگاه اینترنتی تیمیکس</h1>
</div>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">فروشگاه اینترنتی تیمیکس</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">صفحه اصلی</a></li>
            <li><a href="ContactUs.php">تماس با ما</a></li>
            <li><a href="AboutUs.php">درباره ما</a></li>
            <li><a href="Blog.php">وبلاگ</a></li>
            <li><a href="SignUp.php">ثبت نام</a></li>
            <li><a href="LogIn.php">ورود</a></li>
        </ul>
    </div>
</nav>
<h3 style="padding: 10px 10px;" class="text-center bg-info text-primary">
    محصولات
</h3>
<h5 style="padding: 10px 10px;" class="text-center bg-info text-primary">
    <?php
	error_reporting(0);
        @$s = htmlentities($_GET['search']);
		// htmlentities for patch bug Cross Site Scripting (XSS) 
    echo ' نتایج جستجو برای ' . '`'.$s.'`';
    ?>
</h5>
<?php
$conn = mysqli_connect("localhost","root","","shop");
$sql = "SELECT * FROM product WHERE `title` LIKE '%$s%'";
$query_search = mysqli_query($conn,$sql);
while($res = mysqli_fetch_array($query_search)):
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3 table-bordered">
            <?php if ($res['status'] == 1):?>
                <a href="post.php?id=<?php echo $res['id'];?>">
                    <img style="height: 200px;width: 280px;margin-top: 3pt;" class="img-responsive img-thumbnail" src="admin/images/<?php echo $res['image'];?>" alt="image-product" id="image-product"/>
                </a>
            <?php endif;?>
            <?php if ($res['status'] == 0):?>
                <a href="index.php">
                    <img style="height: 200px;width: 280px;margin-top: 3pt;" class="img-responsive img-thumbnail" src="admin/images/<?php echo $res['image'];?>" alt="image-product" id="image-product"/>
                    <img style="position: absolute;top: 55px;left:80px;" src="images/dan.png" alt="">
                </a>
            <?php endif;?>
            <br />
            <h4 style="padding: 3px 3px;" class="text-primary bg-info"><?php echo ' نام محصول :  ' . $res['title'];?></h4>
            <p style="padding: 3px 3px;" class="text-primary bg-info"><?php echo ' قیمت :  ' . number_format($res['price']).' تومان ';?></p>
            <br />
            <?php if ($res['status'] == 1):?>
                <a href="post.php?id=<?php echo $res['id'];?>"><button style="margin-right: 85px;" class="btn-success" type="submit" id="btn-submit-product" name="buy">توضیحات و خرید</button></a>
            <?php endif;?>
            <?php if ($res['status'] == 0):?>
                <a>
                    <button style="margin-right: 100px;" class="btn-danger" onclick="alert('این کالا موجود نمی باشد , لطفا از دیگر محصولات ما دیدن کنید');" type="submit" id="btn-submit-product" name="buy">
                        موجود نیست
                    </button>
                </a>
            <?php endif;?>
        </div>
        <?php
        endwhile;
        ?>
    </div>
</div>
<div class="row">
    <h3 style="padding: 10px 10px;" class="text-center text-primary bg-info">All Rights Reserved &copy; <?php echo date('Y');?></h3>
</div>
</body>
</html>