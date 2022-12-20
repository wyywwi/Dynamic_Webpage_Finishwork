<?php

//数据库相关

//数据库变量
//$servername = 'localhost';
//For Server side
$username = '43.142.12.69';
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
    //echo "连接成功";
    //输出图像，是故此处不能输出文字信息
}

//读取数据库信息（sh600000已提前导入）
mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);
mysqli_query($conn, "use dynamic_wyywwi");
//此句仅在第一次运行时使用
//mysqli_query($conn, "load data local infile './sh600000.txt' into table sh600000 fields terminated by ',' lines terminated by '\n' ");
$shdata = mysqli_query($conn,"select * from sh600000 order by date");
$total = mysqli_num_rows($shdata);

//图像相关

//创建画布
$im = imagecreatetruecolor(14000,3200);

//数据参数
$datenum = 680; //数据总量
$y_divide = 1; //y轴分量
$y_unit = 200; //y轴单位长度
$y_max = 15; //y轴最大值
$x_divide = 1; //x轴分量
$x_unit = 16; //x轴单位长度
$x_sub_unit = 4;//x轴间隔长度
$x_max = 680; //x轴最大值

// x 方向：681 * 10px = 6810 px
// y 方向：15 * 100px = 1500px

//创建颜色
$red = imagecolorallocate($im,255,0,0);
$green = imagecolorallocate($im,0,255,0);
$blue = imagecolorallocate($im,0,0,255);
$gray = imagecolorallocate($im,120,120,120);
$white = imagecolorallocate($im,255,255,255);
//作图
//坐标变量
$count = 0;
$base_x = 100;
$base_y = 3200;
$rec_lb_x = 0;
$rec_lb_y = 3200;
$line_x = 0;
$line_yh = 0;
$line_yb = 3200;

//数据变量（十日均线）
$endp_all = range(0, mysqli_num_rows($shdata));

//坐标线绘制
for ($i = 0; $i < 70; $i++){
    imageline($im,$base_x + ($i * 10 + 0.5) * ($x_sub_unit + $x_unit), $base_y, $base_x + ($i * 10 + 0.5) * ($x_sub_unit + $x_unit), $base_y - $y_unit * $y_max, $gray);
}
for ($i = 0; $i <= 15; $i++){
    imageline($im,$base_x + 0.5 * ($x_sub_unit + $x_unit), $base_y - $y_unit * $i, $base_x + 690.5 * ($x_sub_unit + $x_unit), $base_y - $y_unit * $i, $white);
}

//循环
while ($row = mysqli_fetch_assoc($shdata)) {
    //变量获取
    $date = $row["date"];
    $startp = $row["startp"];
    $maxp = $row["maxp"];
    $minp = $row["minp"];
    $endp = $row["endp"];
    $volume = $row["volume"];
    $amount = $row["amount"];
    //十日均线数据
    $endp_all[$count] = $row["endp"];
    //基座图像
    if($startp > $endp){
        imageline($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y, $base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - 50, $green);
    }
    else{
        imageline($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y, $base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - 50, $red);
    }
    //日最高/最低
    if($startp > $endp){
        imageline($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($minp * $y_unit), $base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($maxp * $y_unit), $green);
    }
    else{
        imageline($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($minp * $y_unit), $base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($maxp * $y_unit), $red);
    }
    //日开盘/收盘
    if($startp > $endp){
        imagefilledrectangle($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * $x_sub_unit, $base_y - ($startp * $y_unit), $base_x + $count * ($x_sub_unit + $x_unit) + $x_unit + 0.5 * $x_sub_unit, $base_y - ($endp * $y_unit), $green);
    }
    else{
        imagefilledrectangle($im,$base_x + $count * ($x_sub_unit + $x_unit) + 0.5 * $x_sub_unit, $base_y - ($startp * $y_unit), $base_x + $count * ($x_sub_unit + $x_unit) + $x_unit + 0.5 * $x_sub_unit, $base_y - ($endp * $y_unit), $red);
    }
    $count += 1;
}

//十日均线绘制
for ($i = 11; $i < $total; $i++){
    $average_1 = 0;
    for($j = 1; $j < 11; $j++){
        $average_1 += $endp_all[$i - $j];
    }
    $average_1 = $average_1 / 10;

    $average_2 = 0;
    for($j = 1; $j < 11; $j++){
        $average_2 += $endp_all[$i + 1 - $j];
    }
    $average_2 = $average_2 / 10;

    imageline($im, $base_x + ($i - 0.5) * ($x_sub_unit + $x_unit), $base_y - ($average_1 * $y_unit), $base_x + $i * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($average_2 * $y_unit), $red);
    //加粗
    imageline($im, $base_x + ($i - 0.5) * ($x_sub_unit + $x_unit), $base_y - ($average_1 * $y_unit) + 1, $base_x + $i * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($average_2 * $y_unit) + 1, $red);
    imageline($im, $base_x + ($i - 0.5) * ($x_sub_unit + $x_unit), $base_y - ($average_1 * $y_unit) - 1, $base_x + $i * ($x_sub_unit + $x_unit) + 0.5 * ($x_sub_unit + $x_unit), $base_y - ($average_2 * $y_unit) - 1, $red);
}

//输出图像
Header("Content-Type: image/png");
imagepng($im);

//销毁图片（释放内存）
imagedestroy($im);
?>