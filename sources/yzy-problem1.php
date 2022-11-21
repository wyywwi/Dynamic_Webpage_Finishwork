<?php 
  $time = strtotime("2022-08-30T08:00:00.000Z");
  //学期开始时间
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>作业一 - 杨子越 课程设计 U201816816</title>
    <style>
      h1{ color:aqua;
          font-family:"Times New Roman", "宋体";
          text-align: center;
        }
      h2{ color:aqua;
          font-family:"Times New Roman", "宋体";
          text-align: center;
        }
      .plink { font-family:"Times New Roman", "宋体";
          text-align: center;
        }
    </style>
  </head>
  <body>
    <h1>参考文献</h1>
    <br>
    <h2>来源：github ttzztztz</h2>
    <br>
    <p class="plink">
      <a href="https://github.com/ttzztztz/Dynamic-Web-Course-Homework" target="_blank">链接：Dynamic-Web-Course-Homework</a>
    </p>
    <br>
    <br>
    <table border="1" cellspacing="0" style="width: 100%;">
      <tr>
        <th></th>
        <th>星期日</th>
        <th>星期一</th>
        <th>星期二</th>
        <th>星期三</th>
        <th>星期四</th>
        <th>星期五</th>
        <th>星期六</th>
      </tr>
      <?php for ($i = 1; $i <= 20; $i++) { ?>
        <?php $current_week = $time <= time() && time() <= $time + 7 * 24 * 60 * 60;?>
        <!--当前时间（time（））是否在将打印周内？-->
        <tr <?php if ($current_week) echo "style=\"background: #9af1ff;\"" ?>>
        <!--若为，设置颜色-->
          <th>第 <?php echo $i;?> 周</th>
          <?php for ($j = 0; $j < 7; $j++) {?>
            <td <?php if (date("Y-m-d", $time) == date("Y-m-d", time())) { echo "style=\"color:red;\""; } ?> >
            <!--若当前日期为将打印日期，设置颜色-->
              <?php echo date("Y-m-d", $time); $time += 24 * 60 * 60;?>
              <!--打印日期，转到下一周-->
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>