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
    <link rel="stylesheet" type="text/css" href="problem-1.css">
    <script src="problem_1_action.js"></script>
</head>
<body>
    <header>
        <button id="background_switch_button" onclick="ChangeBackground_9()">深色</button>
        <span id="main_header">华中大月历</span>
    </header>
    <h1 class="monthname">九月</h1>
    <p class="quote">可怜九月初三夜，露似真珠月似弓</p>
    <table class="monthtable">
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
</body>