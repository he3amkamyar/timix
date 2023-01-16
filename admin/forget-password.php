<?php
session_start();
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>فروشگاه لپ تاپ مرکزی</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.css"/>
    <meta charset="utf-8"/>
    <style>
    *
    {
        font-family: yekan;
    }
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 style="padding: 10px 10px;" class="text-center text-primary bg-info">فروشگاه لپ تاپ مرکزی</h1>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">فروشگاه لپ تاپ مرکزی</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">صفحه اصلی</a></li>
                <li><a href="ContactUs.php">تماس با ما</a></li>
                <li><a href="AboutUs.php">درباره ما</a></li>
                <li><a href="Blog.php">وبلاگ</a></li>
                <li><a href="SignUp.php">ثبت نام</a></li>
                <li><a href="LogIn.php">ورود</a></li>
            </ul>
        </div>
    </nav>
    <div style="padding: 10px 10px;" class="container">
        <h3 style="padding: 10px 10px;" class="text-left text-primary bg-info">فراموشی رمز عبور</h3>
        <form style="padding: 10px 10px;" class="bg-info" method="post" action="LogIn.php">
            <label>ایمیل</label>
            <br />
            <label><input class="form-control" type="email" name="email" placeholder="ایمیل خود را وارد کنید" required/></label>
            <br />
            <b class="text-warning">رمز عبور جدید شما به ایمیلتان ارسال می شود.</b>
            <br />
            <label><input class="btn-success" type="submit" value="تغییر رمز" name="submit"/></label>
            <label><input class="btn-primary" type="reset" value="ریست"/></label>
        </form>
    </div>
    <?php
    $connection = mysqli_connect("localhost","root","","shop");
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $status = 1;
        $p = rand(140108,509480);
        $sql = "UPDATE users SET password = '$p' WHERE email = '$email'";
        $query = mysqli_query($connection,$sql);
        $sql1 = "SELECT * FROM users WHERE email = '$email'";
        $query1 = mysqli_query($connection,$sql1);
        $row = mysqli_fetch_array($query1);
        $em = $row['email'];
        if($query)
        {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            $from = "hesamkamyar161@gmail.com";
            $to = "$email";
            $subject = " رمز عبور جدید شما ";
            $message = "($em)";
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);
            echo "The email message was sent : " . $to;
        }
        else
        {
            echo "<p style='color: red;'> مشکلی پیش آمد. </p>";
        }
    }
    ?>
</body>
</html>