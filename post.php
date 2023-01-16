<?php
session_start();
$_SESSION['proid'] = $_GET['id'];
require 'jdf.php';
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
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
<?php
error_reporting(0);
if(isset($_SESSION['id']))
{
    $uid = $_SESSION['id'];
}

if(isset($_SESSION['is-admin'])):?>
    <b style="margin-right: 12px;" class="text-info"><?php echo ' مدیریت محترم ' . ' خوش امدید '?> </b>
<?php endif;?>
<?php if(isset($_SESSION['name']) && !isset($_SESSION['is-admin'])):
    ?>
    <p><?php echo $_SESSION['name'].' خوش امدید '?> </p>
    <b><a href="backet.php">مشاهده سبد خرید</a></b>
    <p><a href="delete-session.php">خروج</a></p>
<?php endif;?>
<?php
if(!isset($_SESSION['name']) && !isset($_SESSION['is-admin'])):?>
    <p><?php echo ' کاربر گرامی '.' خوش امدید '?> </p>
<?php endif;?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">فروشگاه اینترنتی تیمیکس</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">صفحه اصلی</a></li>
            <li><a href="ContactUs.php">تماس با ما</a></li>
            <li><a href="AboutUs.php">درباره ما</a></li>
            <li><a href="">تبلیغات</a></li>
            <li><a href="Blog.php">وبلاگ</a></li>
            <li><a href="SignUp.php">ثبت نام</a></li>
            <li><a href="LogIn.php">ورود</a></li>
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
        <h2 style="padding: 10px 10px;" class="text-center text-success bg-info">اطلاعات محصول</h2>
        <?php
        $id = intval($_GET['id']);
		// intval for patch bug sql injection
        $conn = mysqli_connect("localhost","root","","shop");
        $sql = "(SELECT * FROM product WHERE id = '$id')";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($query);
        $pr = str_replace(',','',$row['price']);
                ?>
                <div class="row">
                <div class="col-sm-6 table-bordered">
                    <img id="img-product" style="margin-top: 3pt;border-radius: 20px;" class="img-responsive" src="admin/images/<?php echo $row['image'];?>" alt="img-pro" id="img-pro"/>
                    <h4 style="padding: 10px 10px;" class="text-center bg-info text-primary"><?php echo ' نام محصول :  ' . $row['title'];?></h4>
                    <p style="padding: 10px 10px;" class="text-center bg-info text-primary"><?php echo $row['description'];?></p>
                    <p style="padding: 10px 10px;" class="text-center bg-info text-primary"><?php echo ' قیمت :  ' . number_format($row['price']).' تومان ';?></p>
                    <a href="https://idpay.ir/hesamkamyar?amount=<?php echo $pr.'0';?>">
                        <?php if(isset($_SESSION['name'])):
                            $name= $_SESSION['name'];
                                $sq = "SELECT * FROM users WHERE fullname = '$name'";
                                $q = mysqli_query($conn,$sq);
                                $r = mysqli_fetch_array($q);
                                $uid = $r['id'];
                                 $_SESSION['uid'] = $uid;
                            ?>
                            <a href="insert.php?id=<?php echo $id;?>&uid=<?php echo $_SESSION['uid']?>">
                                <button id="add" onclick="myf()" style="margin-right: 250px;" class="btn-success" type="submit" name="buy">
                                    افزودن به سبد خرید
                                </button>
                            </a>
                        <?php endif;?>
                        <style>
                            #img-product:active
                            {
                                /*transform : scale(3.5);*/
                                zoom: normal;
                            }
                        </style>
                        <?php if(!isset($_SESSION['name'])):?>
                        <a href="LogIn.php">
                                <button style="margin-right: 230px;"  class="btn-primary" type="submit" name="buy">
                                    جهت خرید وارد شوید!
                                </button>
                            </a>
                        <?php endif;?>
                    </a>
                </div>
    </div>
    </div>
<h3 style="padding: 10px 10px;margin-right: 100px;" class="text-left text-primary bg-info">نظرات</h3>
    <div style="border: 2px solid black;width: 1500px;margin-right: 40px;" class="row bg-warning">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "shop");
        $sql = "SELECT * FROM messages WHERE pid = '$id' AND status = '1' ORDER BY id DESC;";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($query)):
        ?>
        <h4 style="padding: 10px 10px;margin-right: 100px;" class="text-left text-primary">
            <img src="admin/images/user.jpg" style="width: 32px;height: 32px;border-radius: 50%;" alt="">
            <?php echo $row['fullname'].' گفت: ';
            ?>
        </h4>
        <p style="padding: 10px 10px;margin-right: 100px;" class="text-left text-primary"><?php echo $row['message'];?></p>
        <b style="padding: 10px 10px;margin-right: 100px;" class="text-left text-primary">
            <?php
            $day = jdate('d-m-y');
            ?>
            <?php echo ' نوشته شده در  : '.$row['ctime'].'<br />';?>
            <?php echo "<b style='margin-right:350px;'>تعداد لایک : </b>".$row['count_like'].'<br />';?>
            <?php echo "<b style='margin-right:350px;'>تعداد دیس لایک : </b>".$row['count_dislike'].'<br />';?>
            <a style="margin-right:50px;" href="like.php?id=<?php echo $row['id'];?>"><img id="like" src="images/like.png"/></a>
            <a style="margin-right:50px;" href="dislike.php?id=<?php echo $row['id'];?>"><img src="images/dislike.png"/></a>
        </b>
            <hr />
        <?php endwhile;?>
    </div>
	<br />
<?php if(isset($_SESSION['name'])):?>
    <div class="row">
        <div class="container">
            <form style="padding: 10px 10px;" class="bg-info" method="post" action="post.php?id=<?php echo $id;?>">
                <label>نام</label>
                <br />
                <label><input class="form-control" type="text" name="name" disabled value="<?php echo $_SESSION['name'];?>" required/></label>
                <br />
                <label>نظر شما</label>
                <br />
                <label><textarea class="form-control" name="message"  cols="50" rows="5"></textarea></label>
                <br />
                <label><input class="btn-success" type="submit" value="ثبت نظر" name="submit"/></label>
                <label><input class="btn-primary" type="reset" value="ریست"/></label>
            </form>
        </div>
    </div>
<?php endif;?>
<?php if(!isset($_SESSION['name'])):?>
<p style="margin-right: 30px;">برای نظر دادن باید وارد شوید</p>
<b style="margin-right: 30px;"><a href="LogIn.php">جهت وارد شدن کلیک کنید</a></b>
<?php endif;?>
<?php
    if(isset($_POST['submit']) && isset($_SESSION['name']))
    {
        $name = $_SESSION['name'];
        $message = $_POST['message'];
        $i = $_GET['id'];
        $date = jdate('H:i:s');

        $connection = mysqli_connect("localhost", "root", "", "shop");
        $sql = "INSERT INTO messages (id,pid,fullname,message,ctime,count_like,count_dislike,status) VALUES (null,'$i','$name','$message','$date','0','0','0');";
        $query = mysqli_query($conn, $sql);
    }
?>
<div class="row">
    <h3 style="padding: 10px 10px;" class="text-center text-primary bg-info">All Rights Reserved &copy; <?php echo date('Y');?></h3>
</div>
</body>
</html>