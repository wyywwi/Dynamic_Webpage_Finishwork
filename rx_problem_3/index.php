<?php
//数据库相关

//数据库变量
$servername = 'localhost';
//For Server side
//$username = '43.142.12.69';
$username = 'DynamicFinishWork';
$password = 'dynamic';
$errorflag = 0;

//创建连接
$conn = new mysqli($servername, $username, $password);

//异常判断
if ($conn->connect_error) {
    $errorflag = 1;
    die("连接失败: " . $conn->connect_error);
} 
else {
    echo "连接成功";
}

//读取数据库信息（sh600000已提前导入）
mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);
mysqli_query($conn, "use dynamic_wyywwi");
$shdata = mysqli_query($conn,"select * from sh600000 order by date");
$total = mysqli_num_rows($shdata);

//变量设置
$date = range(0, $total);
$startp = range(0, $total);
$maxp = range(0, $total);
$maxp20_line = range(0, $total / 20);
$minp = range(0, $total);
$endp = range(0, $total);
$volume = range(0, $total);
$amount = range(0, $total);

//循环
$count = 0;

while ($row = mysqli_fetch_assoc($shdata)) {
    //变量获取
    $date[$count] = $row["date"];
    $startp[$count] = $row["startp"];
    $maxp[$count] = $row["maxp"];
    $minp[$count] = $row["minp"];
    $endp[$count] = $row["endp"];
    $volume[$count] = $row["volume"];
    $amount[$count] = $row["amount"];
    $count += 1;
}

//20日最高价 函数
function maxp_in_20($endday, $maxp)
{
    $maxp_in_20 = 0;
    for ($j = 20; $j > 0; $j--) {
        if ($maxp[$endday - $j] >= $maxp_in_20)
            $maxp_in_20 = $maxp[$endday - $j];
    }
    echo $maxp_in_20;
}    
?>

<html>
    <!--清除ErrorLog界面，开始写入显示内容-->
    <script>
        document.body.innerHTML = '';
    </script>
    <head>
        <meta charset="utf-8">
        <title>日线图分析</title>
        <link rel="stylesheet" type="text/css" href="../normalize.css">
        <link rel="stylesheet" type="text/css" href="../sakura.css">
    </head>
    <body>
        <h1>sh600000</h1>
        <button style="margin-top:50px;margin-bottom:50px;" onclick="location.href=('./k-line-image.php')">k线及十日均线图像</button>
        <h2>20日最高价概览</h2>
        <table>
            <tr>
                <td>开始日</td>
                <td>结束日</td>
                <td>最高价</td>
            </tr>
            <?php for($i = 20; $i < $total; $i += 20){ ?>
            <tr>
                <td><?php echo $date[$i - 20]?></td>
                <td><?php echo $date[$i - 1]?></td>
                <td><?php maxp_in_20($i, $maxp)?></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>