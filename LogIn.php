    <?php
    session_start();
	?>
<!DOCTYPE html>
<html dir="rtl">
<head>
<title>فروشگاه اینترنتی تیمیکس</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.css"/>
<meta charset="utf-8"/>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 style="padding: 10px 10px;font-family:yekan;" class="text-center text-primary bg-info">فروشگاه اینترنتی تیمیکس</h1>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php>         <a class="navbar-brand" href="index.php">                <a class="navbar-brand" href="index.php"></a>
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li style="font-family: yekan;"><a href="index.php">صفحه اصلی</a></li>
                <li style="font-family: yekan;"><a href="ContactUs.php">تماس با ما</a></li>
                <li style="font-family: yekan;"><a href="AboutUs.php">درباره ما</a></li>
                <li style="font-family: yekan;"><a href="Blog.php">وبلاگ</a></li>
                <li style="font-family: yekan;"><a href="SignUp.php">ثبت نام</a></li>
                <li style="font-family: yekan;" class="active"><a href="LogIn.php">ورود</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
<h3 style="padding: 10px 10px;font-family:yekan;" class="text-left text-primary bg-info">ورود</h3>
	<form style="padding: 10px 10px;" class="bg-info" method="post" action="LogIn.php">
		<label style="font-family: yekan;" >ایمیل</label>
		<br />
            <label><input class="form-control" type="text" name="email" required/></label>
		<br />
				<label style="font-family: yekan;" >پسورد</label>
		<br />
		<label><input class="form-control" type="password" name="password" required/></label>
		<br />
        <a style="color: darkred;font-family:yekan;" href="SignUp.php">هنوز ثبت نام نکرده ام؟</a><br /><br />
        <a style="color: darkred;font-family:yekan;" href="admin/forget-password.php">رمز عبور خود را فراموش کرده اید ؟</a><br /><br />
		<label><input style="font-family: yekan;" class="btn-success" type="submit" value="ورود" name="submit"/></label>
		<label><input style="font-family: yekan;" class="btn-primary" type="reset" value="ریست"/></label>
	</form>
</div>
    <?php
    $connection = mysqli_connect("localhost","root","","shop");
        if(isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $status = 1;
            $sql = "SELECT email,password,fullname,id FROM users WHERE email = '$email' AND password = '$pass' AND status = '1'";
            $query = mysqli_query($connection,$sql);
            $row = mysqli_fetch_array($query);
            if($query)
            {
                $_SESSION['name'] = $row['fullname'];
                $_SESSION['id'] = $row['id'];
                if(isset($_SESSION['is-admin']))
                {
                    unset($_SESSION['is-admin']);
                }
                else if(isset($_SESSION['name']))
				{
					header('Location: index.php');
				}
			}
				else
				{
					echo "<p style='color: red;'> وضعیت شما در حالت غیر فعال قرار دارد ، و یا چنین کاربری وجود ندارد </p>";
				}
            }
    ?>
</body>
</html>