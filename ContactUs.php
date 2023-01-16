<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>فروشگاه اینترنتی تیمیکس</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.css"/>
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
<h1 style="padding: 10px 10px;" class="text-center text-primary bg-info">فروشگاه اینترنتی تیمیکس</h1>
</div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">فروشگاه اینترنتی تیمیکس</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">صفحه اصلی</a></li>
                <li class="active"><a href="ContactUs.php">تماس با ما</a></li>
                <li><a href="AboutUs.php">درباره ما</a></li>
                <li><a href="Blog.php">وبلاگ</a></li>
                <li><a href="SignUp.php">ثبت نام</a></li>
                <li><a href="LogIn.php">ورود</a></li>
            </ul>
        </div>
    </nav>
<div class="section">
<h3 style="padding: 10px 10px;" class="text-left text-primary bg-info">تماس با ما</h3>
	<form style="padding: 10px 10px;" class="bg-info" method="POST" action="ContactUs.php">
		<label>نام و نام خانوادگی</label>
		<br />
		<label><input class="form-control" type="text" name="name"/></label>
		<br />
				<label>شماره تلفن</label>
		<br />
		<label><input class="form-control" type="tel" name="phone"/></label>
		<br />
				<label>ایمیل</label>
		<br />
		<label><input class="form-control" type="text" name="email"/></label>
		<br />
		<label>توضیحات</label>
		<br />
		<label><textarea class="form-control" rows="5" cols="40" name="desc"></textarea></label>
		<br />
		<label><input class="btn-success" type="submit" value="ارسال" name="sub"/></label>
		<label><input class="btn-primary" type="reset" value="ریست"/></label>
	</form>
</div>
</body>
<?php
$connection = mysqli_connect("localhost","root","","shop");
if(isset($_POST['sub']))
{
    $name = htmlentities($_POST['name']);
    $phone = htmlentities($_POST['phone']);
    $email = htmlentities($_POST['email']);
    $desc = htmlentities($_POST['desc']);
    $sql = "INSERT INTO contactus (id,fullname,phone,email,description) VALUES(null,'$name','$phone','$email','$desc')";
    $query = mysqli_query($connection,$sql);
    if(!$query){echo "Connect Error";}
}
?>
</html>