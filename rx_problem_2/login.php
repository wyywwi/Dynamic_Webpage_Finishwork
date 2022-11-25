<?php
$servername = "localhost";
$username = "root";
$password = "zfyang";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

echo "<br>";

// 创建数据库
$sql = "use myDB";
if ($conn->query($sql) === TRUE) {
    echo "数据库进入成功";
} else {
    echo "Error creating database: " . $conn->error;
}
$sql = "insert into mytable values ('qr','2012-01-02','qr','qr','qr')";
mysqli_query($conn,$sql);
?>