<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>فروشگاه اینترنتی تیمیکس</title>
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
    <div class="container">
        <h2 style="padding: 10px 10px;" class="text-primary text-center bg-info">وبلاگ</h2>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">فروشگاه اینترنتی تیمیکس</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">صفحه اصلی</a></li>
                    <li><a href="ContactUs.php">تماس با ما</a></li>
                    <li><a href="AboutUs.php">درباره ما</a></li>
                    <li class="active"><a href="Blog.php">وبلاگ</a></li>
                    <li><a href="SignUp.php">ثبت نام</a></li>
                    <li><a href="LogIn.php">ورود</a></li>
                </ul>
            </div>
        </nav>
        <?php
        $conn = mysqli_connect("localhost","root","","shop");
        $sql = "SELECT * FROM blog WHERE status = '1'";
        $query = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_array($query)):
        ?>
        <div class="row">
        <div class="table-bordered">
            <h3 class="text-center text-info"><?php echo $row['title'];?></h3>
            <?php $s=1; ?>
            <img id="img-post" class="img-responsive img-thumbnail" style="margin-right: 370px;height: 250px;" src="admin/images/<?php echo $row['image'];?>"/>
            <h3 style="padding: 10px;color:black !important;" class="text-left text-primary"><?php echo $row['description'];?></h3>
            <p class="text-left text-nowrap"><?php echo ' نوشته شده در تاریخ   ' . substr($row['ctime'],0,10) . ' ساعت ' . substr($row['ctime'],11,19). ' توسط حسام کامیار ';?></p>
        </div>
        </div>
        <?php endwhile; ?>
    </div>
    <style>
        #img-post:active
        {
            transform : scale(3.5);
        }
    </style>
    <?php
    if(!isset($s))
    {
        echo "<h3 style='padding:10px 10px;' class='bg-danger text-danger text-center'>هنوز پستی ایجاد نشده است</h3>";
    }
    ?>
<style>
    .post
    {
        width: 500px;
        padding: 25px 25px;
        border: 2px solid white;
        border-radius: 5px;
        margin: 0 auto 0 auto;
    }
</style>
</body>
</html>