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
$newadminname = $_POST['newadminname'];
$newadmininfo = $_POST['newadmininfo'];
$newadmininfo_2 = $_POST['newadmininfo_2'];
$adminname = $_POST['adminname'];
$admininfo = $_POST['admininfo'];

//数据库信息
$servername = 'localhost';
//For Server side
//$username = '43.142.12.69';
$username = 'DynamicFinishWork';
$password = 'dynamic';
$errorflag = 0;
$admin_salt = base_convert(strlen($admininfo) * strlen($adminname) * 7, 10, 5);
$newad_salt = base_convert(strlen($newadminname) * strlen($newadmininfo) * 7, 10, 5);

//输入数据空检查
if($newadminname == ""
|| $newadmininfo == ""
|| $newadmininfo_2 == ""
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

//新账户检查
if($errorflag == 0){
    if($newadmininfo != $newadmininfo_2){
        $errorflag = 6;//新账户密码不一致
    }
    if(mysqli_num_rows(mysqli_query($conn, "select id, account from adminlist where account = '".$newadminname."'")) != 0){
        $errorflag = 7;//已有此管理员
    }
}

//检查无误，送入数据库
if($errorflag == 0){
    $enc_newadminpasswd = bin2hex(openssl_encrypt($newadmininfo, 'aes-256-ecb', $newad_salt));
    mysqli_query($conn, "use dynamic_wyywwi");
    $input_sql = "Insert into adminlist (account,password) values ('$newadmininfo','$enc_newadminpasswd')";
    mysqli_query($conn, $input_sql);
}
?>

<html>
    <!--定时跳转-->
    <meta http-equiv="Refresh" content="3;url=./adminpage.php">
    <h3>
        <?php
        if($errorflag == 0) echo "修改成功！";
        elseif($errorflag == 1) echo "连接数据库失败！";
        elseif($errorflag == 2) echo "输入信息不全！";
        elseif($errorflag == 3) echo "管理员系统错误！";
        elseif($errorflag == 4) echo "无此管理员！";
        elseif($errorflag == 5) echo "管理员密码错误！";
        elseif($errorflag == 6) echo "新管理员密码输入错误！";
        elseif($errorflag == 7) echo "已有此管理员！";
        else echo "修改失败！";
        ?>
    </h3>
</html>