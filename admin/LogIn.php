<?php
session_start();
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>فروشگاه لپ تاپ مرکزی</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.css"/>
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
                <li class="active"><a href="LogIn.php">ورود</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h3 style="padding: 10px 10px;" class="text-left text-primary bg-info">ورود</h3>
        <form style="padding: 10px 10px;" class="bg-info" method="post" action="LogIn.php">
            <label>ایمیل</label>
            <br />
            <label><input class="form-control" type="email" value="<?php if(isset($_COOKIE['email'])){ echo base64_decode($_COOKIE['email']);}?>" name="email" required/></label>
            <br />
            <label>پسورد</label>
            <br />
            <label><input class="form-control" type="password" name="password" required/></label>
            <br />
            <label><input class="btn-success" type="submit" value="ورود" name="submit"/></label>
            <label><input class="btn-primary" type="reset" value="ریست"/></label>
        </form>
    </div>
    <?php
    error_reporting(0);
    $connection = mysqli_connect("localhost","root","","shop");
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$pass'";
        $query = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0)
        {
            $_SESSION['is-admin'] = 'yes';
            $e = base64_encode($row['email']);
            setcookie("email","$e",time()+3600,'/','localhost',true,true);
            header('Location: index.php');
        }
        else
        {
            echo '<p style="color: red;"> اطلاعات وارد شده صحیح نمی باشد </p>';
        }
    }
    ?>
</body>
</html>