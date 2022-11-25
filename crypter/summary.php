<html>
<head>
	<meta charset="utf-8">
	<title>Crypeter's Summary</title>
	<link rel="stylesheet" type="text/css" href="../normalize.css">
    <link rel="stylesheet" type="text/css" href="../sakura.css">
</head>
<body>
<center><h2>每日留言人数统计表</h2></center>
<?php
$conn = mysqli_connect('localhost','root','zfyang');
mysqli_query($conn,"use mydb");
$sum=mysqli_query($conn,"SELECT day,count(day) from mytable GROUP by day HAVING COUNT(day) order by day");
while($sumnow = mysqli_fetch_array($sum)){
    echo $sumnow['day'];
    echo "的留言人数为：";
    echo $sumnow['count(day)'];
    echo "<br>";
}
?>
</body>
</html>