
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Crypeter's Login</title>
	<link rel="stylesheet" type="text/css" href="../../normalize.css">
    <link rel="stylesheet" type="text/css" href="../../sakura.css">
</head>
<body>
<center><h2>管理员寻人寻物信息表</h2></center>
<a href="summary.php">进入统计页面</a><br>
<?php
$loginname = $_POST['loginname'];
$password = $_POST['password'];
$ErrorOut = "账号密码错误";
$conn = mysqli_connect("localhost",'DynamicFinishWork','dynamic');
mysqli_query($conn,"use dynamic_zfy");
$password1 = mysqli_fetch_array(mysqli_query($conn,"select password from logintable where name='$loginname'"));
if(strcmp($password,$password1['password'])!=0){
    echo $ErrorOut;
}
else{
    $whatin = mysqli_query($conn,"select * from mytable order by id");
    while($arraynow = mysqli_fetch_array($whatin)){
        echo "--------------------------------------<br>";
        echo "发布时间：".$arraynow["day"]." ".$arraynow["settime"]."<br>";
        echo "发布者姓名：".$arraynow["name"]."<br>";
        echo "发布者地址：".$arraynow["place"]."<br>";
        echo "发布者email：".$arraynow["email"]."<br>";
        echo "发布者电话：".$arraynow["phonenumber"]."<br>";
        echo "发布者留言：".$arraynow["something"]."<br>";
    }
}
?>
</body>
