<?php
    session_start();
    error_reporting(0);
    $ud = $_SESSION['uid'];
    $name= $_SESSION['name'];
    $conn = mysqli_connect("localhost","root","","shop");
    $sq = "SELECT * FROM users WHERE fullname = '$name'";
    $q = mysqli_query($conn,$sq);
    $r = mysqli_fetch_array($q);
    $uid = $r['id'];
    $_SESSION['uid'] = $uid;
?>
<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo ' سبد خرید : ' . $_SESSION['name'];?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.css"/>
</head>
<body style="background: darkgray !important;">
<h2 style="padding: 10px;" class="bg-info text-primary text-center">سبد خرید
    <img src="images/backet.png" alt="">
</h2>
<?php
$uid = $_SESSION['uid'];
$conn = mysqli_connect("localhost","root","","shop");
$sql = "SELECT product.*,backet.* FROM product,backet WHERE product.id = backet.pid and backet.uid = '$uid'";
$query = mysqli_query($conn,$sql);
?>
<div class="container">
    <table class="table table-bordered table-responsive bg-primary">
        <tr>
            <th>ردیف</th>
            <th>نام محصول</th>
            <th>تصویر محصول</th>
            <th>توضیحات</th>
            <th>قیمت</th>
            <th>حذف</th>
        </tr>
        <?php
        $num = 1;
        $n = 1;
        while($row = mysqli_fetch_array($query)):
        ?>
        <tr>
            <td><?php echo $num++;?></td>
            <td>
                <a style="color: black;" href="post.php?id=<?php echo $row['pid']; ?>"><?php echo $row['title'];?></a>
            </td>
            <td>
                <a href="admin/images/<?php echo $row['image'];?>">
                    <img class="img img-circle img-responsive" title="برای دیدن کامل تصویر روی آن کلیک کنید" style="width: 50px;height: 50px;" src="admin/images/<?php echo $row['image'];?>" >
                </a>
            </td>
            <td><?php echo $row['description'];?></td>
            <td><?php echo number_format($row['price']) . ' تومان ';?></td>
            <td style="text-align: center;font-size: 18px;">
                <a style="color: darkorange;" href="admin/del-backet.php?pid=<?php echo $row['pid'];?>&uid=<?php echo $uid;?>">حذف</a>
            </td>
        </tr>
        <?php
		endwhile;?>
        <tr>
            <td>مبلغ قابل پرداخت</td>
            <td></td>
            <td></td>
            <td></td>
            <?php
                $sql_avg = "SELECT SUM(price) FROM product,backet WHERE product.id = backet.pid and backet.uid = '$uid';";
                $query_avg = mysqli_query($conn,$sql_avg);
                $sum = mysqli_fetch_array($query_avg);
                if($sum[0] <= 0)
                {
                    echo "<p style='color: brown;font-size: 18px;'>سبد خرید شما خالی است</p>";
                }
            ?>
            <td><?php echo ' مبلغ قابل پرداخت  ' . number_format($sum[0]) .' تومان ';?></td>

            <td><a href="https://idpay.ir/hesamkamyar/<?php echo $sum[0].'0';?>"><button type="button">پرداخت نهایی</button></a></td>
        </tr>
    </table>
    <h2 style="padding: 10px;" class="text-primary text-center"><a href="index.php">برگشت به فروشگاه = ></a></h2>
    <?php if(isset($_GET['del']) && $_GET['del'] == 'ok'):?>
        <script>window.alert("محصول با موفقیت از سبد خرید حذف شد");</script>
    <?php endif;?>
    <?php if(isset($_GET['del']) && $_GET['del'] != 'ok'):?>
        <h3 style="color: red;">مشکلی پیش امد و محصول مورد نظر شما حذف نشد</h3>
    <?php endif;?>
</div>
</body>
</html>