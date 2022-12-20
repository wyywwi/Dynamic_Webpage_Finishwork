<?php

//POST信息
$name = $_POST['guestname'];
$contact = $_POST['guestinfo'];
$content = $_POST['guesttext'];

//其他信息
$day = date("Y-m-d");
$time = date("H:i:s");
$servername = 'localhost';
//For Server side
//$servername = '43.142.12.69';
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

if ($name == '' && $contact == '' && $content == '')
    $errorflag = 2;

//数据处理
if ($name == '')
    $name = 'Anonymous';
if ($contact == '')
    $contact = 'Unknown@not.exist';
if ($content == '')
    $content = 'nothing...';

//读取数据库中内容(更新前)
mysqli_query($conn, "use dynamic_wyywwi");
$output_sql = "select * from guestbook";
$other_posts = mysqli_query($conn, $output_sql);

//送入数据库
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $input_sql = "Insert into guestbook (name,day,time,contact,content) values ('$name','$day','$time','$contact','$content')";
    mysqli_query($conn, $input_sql);
}

?>

<html>
<!--清除ErrorLog界面，开始写入显示内容-->
    <script>
        document.body.innerHTML = '';
    </script>
<!--显示设置-->
    <link rel="stylesheet" type="text/css" href="../normalize.css">
    <link rel="stylesheet" type="text/css" href="../sakura.css">
    <link rel="stylesheet" type="text/css" href="problem-2.css">
    <link rel="stylesheet" type="text/css" href="../rx_problem_1/problem-1.css">
<!--显示界面-->
    <h3>
        <?php
        if ($errorflag == 2)
            echo "留言成功！（空留言）";
            //空留言不被记载入数据库
        else
            echo "留言成功！";
        ?>
    </h3>
    <div id = "CurrentPost">
        <table class = "PostLine">
            <tr>
                <td class = "shorter_td">时间</td>
                <td><?php echo $day."    ".$time; ?></td>
            </tr>
            <tr>
                <td class = "shorter_td">留言人</td>
                <td class = "longer_td"><?php echo $name; ?></td>
            </tr>
            <tr>
                <td class = "shorter_td">联系方式</td>
                <td class = "longer_td"><?php echo $contact; ?></td>
            </tr>
            <tr>
                <td class = "shorter_td">留言内容</td>
                <td class = "longer_td"><?php echo $content; ?></td>
            </tr>
        </table>
    </div>
    <h5>其他访客留言</h5>
    <div id = "FormerPosts">
        <?php
        if(mysqli_num_rows($other_posts) > 0){
            while($row = mysqli_fetch_assoc($other_posts)){?>
                <div class = "PostLine">
                    <table>
                        <tr>
                            <td class = "shorter_td">时间</td>
                            <td class = "longer_td"><?php echo $row["day"]."    ".$row["time"]; ?></td>
                        </tr>
                        <tr>
                            <td class = "shorter_td">留言人</td>
                            <td class = "longer_td"><?php echo $row["name"]; ?></td>
                        </tr>
                        <tr>
                            <td class = "shorter_td">联系方式</td>
                            <td class = "longer_td"><?php echo $row["contact"]; ?></td>
                        </tr>
                        <tr>
                            <td class = "shorter_td">留言内容</td>
                            <td class = "longer_td"><?php echo $row["content"]; ?></td>
                        </tr>
                    </table>
                </div>
            <?php
            }
        }
        ?>
    </div>
    <a href="index.html">
        <button>返回</button>
    </a>
    <div class="bottomtab" style="position:relative">
        <a href="../index.html" style="color:#1d846e; margin-right: 20px; margin-left: 10px;">梧桐叶落</a>
        @wyywwi <a href="https://www.github.com/wyywwi" style="color:#1d846e; margin-left: 20px; margin-bottom: 20px;">github</a>
        <div style="width:300px; margin:0 0; padding:0 0;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=36072702000161" style="display:inline-block;height:20px;line-height:20px;"><img src="../sources/备案图标.png" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px;color:#939393;">赣公网安备 36072702000161号  </p></a>
        </div>
    </div>
</html>
