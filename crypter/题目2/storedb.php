<?php
$getname = $_POST['getname'];
$getplace = $_POST['getplace'];
$getphonenumber = $_POST['getphonenumber'];
$getemail = $_POST['getemail'];
$gethobby = $_POST['gethobby'];
$getsomething = $_POST['getsomething'];
if(($getname=="")||($getplace=="")||($getphonenumber=="")||($getemail=="")||($gethobby=="")||($getsomething==""))
	{$Output = "信息不完整，请重新填写";}
else{
	$conn = mysqli_connect("localhost",'DynamicFinishWork','dynamic');
	$nowday = date("Y-m-d");
	$nowtime = date("H:i:s");
    mysqli_query($conn,"use dynamic_zfy");
	$sql = "Insert into mytable (name,day,settime,phonenumber,place,email,hobby,something) values ('$getname','$nowday','$nowtime','$getphonenumber','$getplace','$getemail','$gethobby','$getsomething')";
	mysqli_query($conn,$sql);
	$Output = "已经成功进行留言";
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<h2 align="center">
	<?php echo $Output;?>
</h2>
	<hr>
	<p align="center">
		<a href="adminlogin.php">查看信息</a>
		</p>
</body>
</html>