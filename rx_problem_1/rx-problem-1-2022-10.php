<?php 
  //十月开始日期
  $date = 25;
  $flag = 0;
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        二零二二年十月
    </title>
    <link rel="stylesheet" type="text/css" href="../normalize.css">
    <link rel="stylesheet" type="text/css" href="../sakura.css">
    <!--sakura.css, using MIT License-->
    <link rel="stylesheet" type="text/css" href="problem-1.css">
    <!--personal css stylesheet-->
    <script src="problem_1_action.js"></script>
</head>
<body>
    <script id="canvas_9" color="94,102,91" opacity='0.8' zIndex="-2" count="99" src="http://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
    <header>
        <button id="background_switch_button_10" onclick="ChangeBackground_10()">深色</button>
        <span id="main_header_10">华中大秋历</span>
        <button id="nextmonth_10" onclick='location.href=("rx-problem-1-2022-8.php")'>下一月</button>        
        <button id="lastmonth_10" onclick='location.href=("rx-problem-1-2022-9.php")'>上一月</button>
    </header>
    <h1 id="monthname_10">十月</h1>
    <p id="quote_10">直北五更闻玉笛，江南十月老梅花</p>
    <table id="monthtable_10">
        <thead>
            <tr>
                <th>星期一</th>
                <th>星期二</th>
                <th>星期三</th>
                <th>星期四</th>
                <th>星期五</th>
                <th>星期六</th>
                <th>星期日</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 6; $i++) { ?>
                <tr>
                    <?php for ($j = 0; $j < 7; $j++) { ?>
                        <td>
                            <!--使用php进行条件判定-->
                            <span <?php if ($flag == 1 && $date >= 1 && $date <= 31) { echo "style=\"color:#202020;font-weight:bold;\""; }
                                        else { echo "style=\"color:#b9b9b9;font-weight:bold;\""; } ?> >
                            <?php echo "$date"; $date ++;?>
                            <?php if($date == 31 && $flag == 0) {$flag = 1; $date = 1;}
                                  else if($date == 32 && $flag == 1) {$flag = 2; $date = 1;} ?>
                            </span>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="bottomtab">
        <a href="../index.html" style="color:#1d846e; margin-right: 20px; margin-left: 10px;">梧桐叶落</a>
        @wyywwi <a href="https://www.github.com/wyywwi" style="color:#1d846e; margin-left: 20px; margin-bottom: 20px;">github</a>
        <div style="width:300px; margin:20 0; padding:0 0;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=36072702000161" style="display:inline-block;height:20px;line-height:20px;"><img src="../sources/备案图标.png" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px;color:#939393;">赣公网安备 36072702000161号  </p></a>
        </div>
    </div>
</body>