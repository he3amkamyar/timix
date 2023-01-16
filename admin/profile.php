<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../LogIn.php');
    }
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ناحیه کاربری</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <style>
    *
    {
        font-family: yekan;
    }
</style>
</head>
<body>
<?php
    $id = $_SESSION['id'];
        $conn = mysqli_connect("localhost","root","","shop") or die("Connection to Database Established!");
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $query = mysqli_query($conn,$sql) or die("Selected not Success");
        $row = mysqli_fetch_array($query);
    ?>
    <div class="container">
        <div class="row">
            <h3 style="padding: 10px;" class="text-center bg-primary">پروفایل</h3>
            <table id="tbl" class="table table-responsive">
                <thead>
                    <tr>
                        <th>نام کاربر</th>
                        <th>شماره تلفن</th>
                        <th>ایمیل</th>
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['fullname'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <?php if($row['status'] == 1):?>
                        <td><?php echo "<p style='color:green;'>فعال</p>";?></td>
                        <?php endif;?>
                        <?php if($row['status'] == 0):?>
                        <td><?php echo "<p style='color:green;'>غیر فعال</p>";?></td>
                        <?php endif;?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <form action="" method="post">
            <h3 style="padding: 10px;" class="text-center bg-primary">تغییر رمز عبور</h3>
                <label>رمز عبور فعلی</label>
                <br />
                <input type="password" name="carent-password" required/>
                <br />
                <label>رمز عبور جدید</label>
                <br />
                <input type="password" name="new-password" requered/>
                <br />
                <input style="margin-top: 5px;" type="submit" class="btn-success" value="تغییر رمز" name="btn-submit"/>
                <input type="reset" class="btn-danger" value="ریست"/>
            </form>
        </div>
        <div class="row">
            <h2><a href="../index.php">برگشت به صفحه اصلی</a></h2>
        </div>
        <?php
        if(isset($_POST['btn-submit']))
        {
            $carent_pass = $_POST['carent-password'];
            $new_pass = $_POST['new-password'];
            $sql = "UPDATE users SET `password` = '$new_pass' WHERE id = '$id'";
            if($carent_pass == $row['password'])
            {
            $query = mysqli_query($conn,$sql);
            echo "<p style='color:green;'>تغییر رمز با موفقیت انجام شد</p>";
            }
        }
        ?>
    </div>
    <style>
        *
        {
            font-family: tahoma;
            font-weight: bold;
        }
        #tbl,td,th,tr
        {
            border: 1px solid black;
            text-align: center;
            padding: 10px;
        }
    </style>
</body>
</html>