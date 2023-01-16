<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
<title>   فروشگاه اینترنتی تیمیکس</title>
    <a class="navbar-brand" href="index.php"></a>

<link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.css"/>
    <script src="bootstrap/js/bootstrap.js"></script>
    <style>
    *
    {
        font-family: yekan;
    }
</style>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['is-admin'])):?>
    <b style="margin-right: 12px;" class="text-info"><?php echo ' مدیریت محترم ' . ' خوش امدید '?> </b>
<?php endif;?>
<?php if(isset($_SESSION['name']) && !isset($_SESSION['is-admin'])):?>
    <b style="color: black;margin-right: 20px;"><?php echo $_SESSION['name'].' خوش امدید '?> </b>
    <p>
        <a href="backet.php"><img src="images/backet.png" style="width: 25px;height: 25px;" alt="">مشاهده سبد خرید</a>
    </p>
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
                <?php if(isset($_SESSION['name'])):?>
                    <li><a href="admin/profile.php">پروفایل</a></li>
                <?php endif;?>
            </ul>
            <form class="navbar-form navbar-left" action="search.php" method="get">
      <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="کلمه مورد نظر + اینتر">
      </div>
      <button type="submit" class="btn btn-default">جستجو</button>
    </form>
        </div>
    </nav>
<style>
    #search-box
    {
        background-image : url('images/g.jpg');
        background-size: 29px;
        background-repeat: no-repeat;
        background-position: left;
        border: 1px solid darkblue;
    }
</style>
<br />
<div class="row">
    <form action="filter.php" method="get">
        <b style="margin-right: 30px;"> قیمت از</b>
        <select style="width: 400px;margin-right: 30px;" name="n1" id="" class="form-control">
            <option value="100000">100,000 تومان</option>
            <option value="300000">300,000 تومان</option>
            <option value="800000">800,000 تومان</option>
            <option value="1000000">1,000,000 تومان</option>
            <option value="1500000">1,500,000 تومان</option>
        </select>
        <b style="margin-right: 30px;">تا</b>
        <select style="width: 400px;margin-right: 30px;" name="n2" id="" class="form-control">
            <option value="1000000">1,000,000 تومان</option>
            <option value="1500000">1,500,000 تومان</option>
            <option value="2000000">2,000,000 تومان</option>
            <option value="3000000">3,000,000 تومان</option>
            <option value="3500000">3,500,000 تومان</option>
        </select>
        <input class="btn btn-success" style="margin-right: 40px;" type="submit" name="sub1" value="جستجو">
    </form>
</div>
</div>
    <style>
        th,td
        {
            text-align: center;
        }
    </style>
<div class="row">
    <h3 style="padding: 10px 10px;" class="text-center bg-info text-primary">
        محصولات
    </h3>
    <?php
    $conn = mysqli_connect("localhost","root","","shop");
    $sql = "SELECT * FROM product";
    $query = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_array($query)):
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 table-bordered">
        <?php if ($row['status'] == 1):?>
        <a href="post.php?id=<?php echo $row['id'];?>">
            <img style="height: 200px;width: 280px;margin-top: 3pt;" class="img-responsive" src="admin/images/<?php echo $row['image'];?>" alt="image-product" id="image-product"/>
        </a>
        <?php endif;?>
        <?php if ($row['status'] == 0):?>
            <a href="index.php">
                <img style="height: 200px;width: 280px;margin-top: 3pt;" class="img-responsive" src="admin/images/<?php echo $row['image'];?>" alt="image-product" id="image-product"/>
                <img style="position: absolute;top: 55px;left:80px;" src="images/dan.png" alt="">
            </a>
        <?php endif;?>
        <br />
        <h4 style="padding: 3px 3px;" class="text-primary bg-info"><?php echo ' نام محصول :  ' . $row['title'];?></h4>
        <p style="padding: 3px 3px;" class="text-primary bg-info"><?php echo ' قیمت :  ' . number_format($row['price']).' تومان ';?></p>
        <br />
        <?php if ($row['status'] == 1):?>
        <a href="post.php?id=<?php echo $row['id'];?>"><button style="margin-right: 85px;" class="btn-success" type="submit" id="btn-submit-product" name="buy">توضیحات و خرید</button></a>
        <?php endif;?>
        <?php if ($row['status'] == 0):?>
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
</div>
<div class="row">
    <h3 style="padding: 10px 10px;" class="text-center text-primary bg-info">All Rights Reserved &copy; <?php echo date('Y');?></h3>
</div>
</body>
</html>