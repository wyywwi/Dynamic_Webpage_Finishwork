<?php


//登录信息
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

//读取数据库中内容(更新前)
mysqli_query($conn, "use dynamic_wyywwi");
$output_sql = "select * from guestbook";
$other_posts = mysqli_query($conn, $output_sql);

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
<!--显示界面-->
    <h3>其他访客留言</h3>
    <div style="margin-top:50px; margin-bottom:25px;">
        <a href="./index.html">
            <button>返回写一份</button>
        </a>
    </div>
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
    <div class="bottomtab" style="position:relative;">
        <a href="../index.html" style="color:#1d846e; margin-right: 20px;">梧桐叶落</a>
        @wyywwi <a href="https://www.github.com/wyywwi" style="color:#1d846e; margin-left: 20px;">github</a>
    </div>
</html>