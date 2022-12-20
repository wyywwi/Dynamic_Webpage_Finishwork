<?php

//来源验证
///rx_problem_2/adminlogin.php
///rx_problem_2/adminadd.php
///rx_problem_2/admindelete.php
///rx_problem_2/postdelete.php
function getreferer(){
    if(isset($_SERVER['HTTP_REFERER'])){
        return $_SERVER['HTTP_REFERER'];
    }
    return 'None';
}
$url = getreferer();
$url_parse = parse_url($url);
if($url_parse["path"] != "/rx_problem_2/adminlogin.php"
&& $url_parse["path"] != "/rx_problem_2/adminadd.php"
&& $url_parse["path"] != "/rx_problem_2/admindelete.php"
&& $url_parse["path"] != "/rx_problem_2/postdelete.php"
    ){
    return;
    //抛出错误，拒绝访问
}


//数据库信息
//$servername = 'localhost';
//For Server side
$username = '43.142.12.69';
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
$output_sql = "select id,account from adminlist";
$all_admin = mysqli_query($conn, $output_sql);
$output_sql = "select id,name,day from guestbook";
$all_posters = mysqli_query($conn, $output_sql);
?>

<html>
<!--
    管理员界面功能：
    1. 增删管理员账户
    2. 删除留言
-->
<head>
    <meta charset="utf-8">
    <title>
        Wyywwi's Adminpage
    </title>
    <link rel="stylesheet" type="text/css" href="../normalize.css">
    <link rel="stylesheet" type="text/css" href="../sakura.css">
    <link rel="stylesheet" type="text/css" href="problem-2.css">
</head>
<body>
    <!--已经验证通过-->
    <h1>Admin Page</h1>
    <h3>所有管理员信息</h3>
    <div id = "OtherAdminList">
        <?php if(mysqli_num_rows($all_admin) > 0){?>
                <div class = "AdminLine">
                    <table>
                        <th>
                            <td>account</td>
                        </th>
                        <?php while($row = mysqli_fetch_assoc($all_admin)){?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["account"]; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
        <?php } ?>
    </div>
    <h3>所有留言信息</h3>
    <div id = "AllPostList">
        <?php if(mysqli_num_rows($all_posters) > 0){?>
                <div class = "AllPostLine">
                    <table>
                        <th>
                            <td>poster-name</td>
                            <td>post-date</td>
                        </th>
                        <?php while($row = mysqli_fetch_assoc($all_posters)){?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["day"]; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
        <?php } ?>
    </div>
    <h3>日留言统计</h3>
    <?php
    $output_sql = "select id,name,day from guestbook";
    $all_posters = mysqli_query($conn, $output_sql);
    ?>
    <?php if(mysqli_num_rows($all_posters) > 0){?>
    <?php
        $lastdate = mysqli_fetch_assoc($all_posters)["day"];
        $count = 1;
        $row_count = 1;
    ?>
        <table>
            <th>
                <td>日期</td>
                <td>留言人数</td>
            </th>
            <?php while($row = mysqli_fetch_assoc($all_posters)){
            $date = $row["day"];
            if ($date == $lastdate)
                $count += 1;
            else{ ?>
            <tr>
                <td><?php echo $row_count; ?></td>
                <td><?php echo $lastdate; ?></td>
                <td><?php echo $count; ?></td>
            </tr>
            <?php
                $row_count += 1;
                $count = 1;
                $lastdate = $date;
            } ?>
            <?php } ?>
            <tr>
                <td><?php echo $row_count; ?></td>
                <td><?php echo $lastdate; ?></td>
                <td><?php echo $count; ?></td>
            </tr>
        </table>
    <?php } ?>
    <h3>增加管理员</h3>
    <form method="post" action="adminadd.php">
        <table>
            <tr>
                <td>新增账号：</td>
                <td><input name="newadminname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>新账号密码：</td>
                <td><input name="newadmininfo" type="password" size="50"></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input name="newadmininfo_2" type="password" size="50"></td>
            </tr>
            <tr>
                <td>操作账号：</td>
                <td><input name="adminname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input name="admininfo" type="password" size="50"></td>
            </tr>
        </table>
        <button>提交增加信息</button>
    </form>
    <h3>删除管理员</h3>
    <form method="post" action="admindelete.php">
        <table>
            <tr>
                <td>账号：</td>
                <td><input name="deladminname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input name="deladmininfo" type="password" size="50"></td>
            </tr>
            <tr>
                <td>操作账号：</td>
                <td><input name="adminname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input name="admininfo" type="password" size="50"></td>
            </tr>
        </table>
        <button>提交删除信息</button>
    </form>
    <h3>删除留言</h3>
    <form method="post" action="postdelete.php">
        <table>
            <tr>
                <td>留言序号：</td>
                <td><input name="delpostid" type="number" size="50"></td>
            </tr>
            <tr>
                <td>留言者：</td>
                <td><input name="delpostname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>操作账号：</td>
                <td><input name="adminname" type="text" size="50"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input name="admininfo" type="password" size="50"></td>
            </tr>
        </table>
        <button>删除</button>
    </form>
    <div class="bottomtab" style="position:relative;">
        <a href="../index.html" style="color:#1d846e; margin-right: 20px;">梧桐叶落</a>
        @wyywwi <a href="https://www.github.com/wyywwi" style="color:#1d846e; margin-left: 20px;">github</a>
    </div>
</body>
</html>
