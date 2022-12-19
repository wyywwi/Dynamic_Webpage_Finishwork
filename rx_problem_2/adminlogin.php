<?php

//POST信息
$account = $_POST['adminname'];
$passwd = $_POST['admininfo'];
$salt = base_convert(strlen($passwd) * strlen($account) * 7, 10, 5);

//其他信息
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

if ($account == '' || $passwd == '')
    $errorflag = 2;

//比对账户
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $output_sql = "select id, account, password from adminlist where account = '".$account."'";
    $asked_admin = mysqli_query($conn, $output_sql);
    if ($asked_admin == null)
        $errorflag = 3;
    elseif (mysqli_num_rows($asked_admin) != 1)
        $errorflag = 4;
    else{
        $row = mysqli_fetch_assoc($asked_admin);
        $enc_password = $row["password"];
        if (bin2hex(openssl_encrypt($passwd, 'aes-256-ecb', $salt)) == $enc_password)
            $errorflag = 0;
        else
            $errorflag = 5;
    }
}
?>

<html>
<head>
<!--清除ErrorLog界面，开始写入显示内容-->
    <script>
        document.body.innerHTML = '';
    </script>
<!--显示设置-->
    <link rel="stylesheet" type="text/css" href="../normalize.css">
    <link rel="stylesheet" type="text/css" href="../sakura.css">
    <link rel="stylesheet" type="text/css" href="problem-2.css">
    <script src="problem-2-action.js"></script>
<!--5秒后跳转回主页面-->
</head>
<!--显示界面-->
    <h2>
        <?php
            if($errorflag == 0)
                echo "登录成功！";
            else
                echo "登录失败！";
        ?>
    </h2>
    <h5 id="AdminRelocate" ></h5>
    <?php if($errorflag == 0){ ?>
    <script>
        let rel = document.getElementById("AdminRelocate");
        var timer = 2;
        setInterval(function () {
            if (timer == 0) {
                location.href = 'adminpage.php';
            }
            else {
                rel.innerHTML = '' + timer + '秒后跳转至管理页面. . .';
                timer--;
            }
        }, 1000)
    </script>
    <?php } else { ?>
    <script>
        let rel = document.getElementById("AdminRelocate");
        var timer = 5;
        setInterval(function () {
            if (timer == 0) {
                location.href = 'admin.html';
            }
            else {
                rel.innerHTML = '' + timer + '秒后跳转回登录页面. . .';
                timer--;
            }
        }, 1000)
    </script>
    <?php } ?>
    <div class="bottomtab">
        <a href="../index.html" style="color:#1d846e; margin-right: 20px;">梧桐叶落</a>
        @wyywwi <a href="https://www.github.com/wyywwi" style="color:#1d846e; margin-left: 20px;">github</a>
    </div>
</html>