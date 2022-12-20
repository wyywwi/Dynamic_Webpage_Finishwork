<?php

//来源验证
///rx_problem_2/adminpage.php
function getreferer(){
    if(isset($_SERVER['HTTP_REFERER'])){
        return $_SERVER['HTTP_REFERER'];
    }
    return 'None';
}
$url = getreferer();
$url_parse = parse_url($url);
if($url_parse["path"] != "/rx_problem_2/adminpage.php"){
    return;
    //抛出错误，拒绝访问
}

//POST信息
$deladminname = $_POST['deladminname'];
$deladmininfo = $_POST['deladmininfo'];
$adminname = $_POST['adminname'];
$admininfo = $_POST['admininfo'];

//数据库信息
//$servername = 'localhost';
//For Server side
$username = '43.142.12.69';
$username = 'DynamicFinishWork';
$password = 'dynamic';
$errorflag = 0;
$admin_salt = base_convert(strlen($admininfo) * strlen($adminname) * 7, 10, 5);
$delad_salt = base_convert(strlen($deladminname) * strlen($deladmininfo) * 7, 10, 5);

//输入数据空检查
if($deladminname == ""
|| $deladmininfo == ""
|| $adminname == ""
|| $admininfo == ""
    ){
    $errorflag = 2;//信息输入不全
}

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

//操作账户检查
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $output_sql = "select id, account, password from adminlist where account = '".$adminname."'";
    $asked_admin = mysqli_query($conn, $output_sql);
    if ($asked_admin == null) {
        $errorflag = 3; //系统错误
    }
    elseif (mysqli_num_rows($asked_admin) != 1) {
        $errorflag = 4; //无此管理员
    }
    else{
        $row = mysqli_fetch_assoc($asked_admin);
        $enc_password = $row["password"];
        if (bin2hex(openssl_encrypt($admininfo, 'aes-256-ecb', $admin_salt)) == $enc_password)
            $errorflag = 0;
        else
            $errorflag = 5;//管理员密码不正确
    }
}

//待删除账户检查
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $output_sql = "select id, account, password from adminlist where account = '".$deladminname."'";
    $asked_admin = mysqli_query($conn, $output_sql);
    if ($asked_admin == null) {
        $errorflag = 6; //系统错误
    }
    elseif (mysqli_num_rows($asked_admin) != 1) {
        echo mysqli_num_rows($asked_admin);
        $errorflag = 7; //待删除管理员不存在
    }
    else{
        $row = mysqli_fetch_assoc($asked_admin);
        $enc_password = $row["password"];
        if (bin2hex(openssl_encrypt($deladmininfo, 'aes-256-ecb', $delad_salt)) == $enc_password)
            $errorflag = 0;
        else
            $errorflag = 8;//待删除管理员密码不正确
    }
}

//账户比对检查
if($errorflag == 0){
    if($deladminname == $adminname){
        $errorflag = 9;//删除自身限制
    }
    elseif($deladminname == "admin_1"){
        $errorflag = 10;//根管理员
    }
}

//检查无误，修改数据库
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $input_sql = "delete from adminlist where account = '".$deladminname."'";
    mysqli_query($conn, $input_sql);
}
?>

<html>
    <!--定时跳转-->
    <meta http-equiv="Refresh" content="3;url=./adminpage.php">
    <h3>
        <?php
        if($errorflag == 0) echo "删除成功！";
        elseif($errorflag == 1) echo "连接数据库失败！";
        elseif($errorflag == 2) echo "输入信息不全！";
        elseif($errorflag == 3) echo "管理员账户错误！";
        elseif($errorflag == 4) echo "无此管理员！";
        elseif($errorflag == 5) echo "管理员密码错误！";
        elseif($errorflag == 6) echo "待删除管理员账户错误！";
        elseif($errorflag == 7) echo "待删除管理员不存在！";
        elseif($errorflag == 8) echo "待删除管理员密码不正确！";
        elseif($errorflag == 9) echo "管理员不可删除自身！";
        elseif($errorflag == 10) echo "超级管理员不可删除！";
        else echo "删除失败！";
        ?>
    </h3>
</html>