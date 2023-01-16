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
                <li><a href="ContactUs.php">تماس با ما</a></li>
                <li><a href="AboutUs.php">درباره ما</a></li>
                <li><a href="Blog.php">وبلاگ</a></li>
                <li class="active"><a href="SignUp.php">ثبت نام</a></li>
                <li><a href="LogIn.php">ورود</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
<h3 style="padding: 10px 10px;" class="text-left text-primary bg-info">ثبت نام</h3>
	<form style="padding: 10px 10px;" class="bg-info" method="post" action="SignUp.php">
		<label>نام و نام خانوادگی</label>
		<br />
		<label><input class="form-control" type="text" name="name" required/></label>
		<br />
				<label>شماره تلفن</label>
		<br />
		<label><input class="form-control" type="text" name="phone" required/></label>
		<br />
				<label>ایمیل</label>
		<br />
		<label><input class="form-control" type="text" name="email" required/></label>
		<br />
		<label>پسورد</label>
		<br />
		<label><input class="form-control" type="text" name="password" required/></label>
		<br />
		<label>تکرار پسورد</label>
		<br />
		<label><input class="form-control" type="text" name="re-password" required/></label>
		<br />
		<label><input class="btn-success" type="submit" value="ثبت نام" name="submit"/></label>
		<label><input class="btn-primary" type="reset" value="ریست"/></label>
	</form>
</div>
    <?php
    $connection = mysqli_connect("localhost","root","","shop");
    if(isset($_POST['submit']))
    {
        $name = htmlentities($_POST['name']);
        $phone = htmlentities($_POST['phone']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $re_password = $_POST['re-password'];
        $sql = "INSERT INTO users (id,fullname,phone,email,password,status) VALUES(null,'$name','$phone','$email','$password',1)";
        if($password == $re_password)
        {
            $query = mysqli_query($connection,$sql);
            if(!$query)
            {
                echo "Connect Error";
            }
        }
    }
    ?>
</body>
</html>