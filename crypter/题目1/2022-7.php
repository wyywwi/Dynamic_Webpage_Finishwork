
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>七月月历.php</title>
    <style type="text/css">
        table{
            margin: 20px auto；
            width:500px;
            border:0px;
        }
        th,td{
            width:50px;
            height:40px;
            text-align:center;
        }
    </style>
</head>
<body background="七月背景图.jpeg">
<font color="#f0ffff">
<a href = "./2022-1.php">一月月历</a>
<b>------------------------------------------</b>
<a href = "./2022-12.php">十二月日历</a>
<br>
<?php
$h=date_default_timezone_set("PRC");
header("Content-Type:text/html;charset=UTF-8");
$year=2022;
$month=7;
$firstDay=strtotime("$year-$month-1");
$w=date('w',$firstDay);
switch ($month){
    case 2:$days=($year%400==0)||($year%4&&$year%100!=0)?29:28;
        break;
    case 4:
    case 6:
    case 9:
    case 11:
        $days=30;
        break;
    default:
        $days=31;
        break;
}
echo '<table>';
echo "<caption>$year 年$month 月的月历</caption>";
echo '<tr>';
echo '<th>星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th><th>星期六</th></tr>';
echo '<tr>';
for ($i=0;$i<$w;$i++){
    echo '<td></td>';
}
for ($i=1;$i<=$days;$i++){
    if (($i+$w-1)%7==0){
        echo '</tr><tr>';
    }
    if ($i==date('j'))
    {
        echo "<td class=aa >$i"."</td>";
    }
    else 	{echo "<td>$i"."</td>";
    }
}
echo '</table>';
?>
</font>
</body>
</html>
