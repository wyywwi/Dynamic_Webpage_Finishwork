<?php 
  //九月开始日期
  $date = 28;
  $flag = 0;
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        二零二二年九月
    </title>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="sakura.css">
    <!--sakura.css, using MIT License-->
    <link rel="stylesheet" type="text/css" href="problem-1.css">
    <!--personal css stylesheet-->
    <script src="problem_1_action.js"></script>
</head>
<body>
    <script id="canvas_9" color="75,76,20" opacity='0.8' zIndex="-2" count="99" src="http://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
    <header>
        <button id="background_switch_button" onclick="ChangeBackground_9()">深色</button>
        <span id="main_header">华中大月历</span>
        <button id="lastmonth_9" onclick="ChangeBackground_9()">上一月</button>
        <button id="nextmonth_9" onclick="ChangeBackground_9()">下一月</button>
    </header>
    <h1 id="monthname_9">九月</h1>
    <p id="quote_9">可怜九月初三夜，露似真珠月似弓</p>
    <table id="monthtable_9">
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
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr>
                    <?php for ($j = 0; $j < 7; $j++) { ?>
                        <td>
                            <!--使用php进行条件判定-->
                            <span <?php if ($flag == 1 && $date >= 1 && $date <= 30) { echo "style=\"color:black;font-weight:bold;\""; }
                                        else { echo "style=\"color:#d9d9d9;font-weight:bold;\""; } ?> >
                            <?php echo "$date"; $date ++;?>
                            <?php if($date == 32 && $flag == 0) {$flag = 1; $date = 1;}
                                  else if($date == 31 && $flag == 1) {$flag = 2; $date = 1;} ?>
                            </span>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php for($i = 0; $i < 100; $i ++) {echo "$i<br>";} ?>
</body>