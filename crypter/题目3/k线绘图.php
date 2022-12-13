<?php
$conn = mysqli_connect("localhost",'DynamicFinishWork','dynamic');
mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);
$com = mysqli_query($conn,"use dynamic_zfy");
$com2 = mysqli_query($conn,"load data local infile 'sh600000.txt' into table sh600000 fields terminated by ',' lines terminated by '\n' ;");
$stdata = mysqli_query($conn,"select * from sh600000 order by dt");
$total = mysqli_num_rows($stdata);
$i = 0;
while($array_now = mysqli_fetch_array($stdata)){
    $op[$i] = $array_now["pop"];
    $h[$i] = $array_now["ph"];
    $l[$i] = $array_now['pl'];
    $cl[$i] = $array_now["pcl"];
    $vol[$i] = $array_now["vm"];
    $i++;
}

//Ѱ��10�������
function Find_Max_10_Days($day,&$h){
    $count = 5;
    $max = 0;
    while($count > 0 && $day > 0){
        if($h[$day-$count] > $max)$max = $h[$day-$count];
        $count--;
    }
    $count = 4;
    while( $day < 682 && $count >=0){
        if($h[$day + $count] > $max)$max = $h[$day-$count];
        $count--;
    }
    return $max;
}
$imgwidth =8800;
$imgheight = 500;
$upperpart = 400;

$wide=10;
$gap=10;
$band=$imgwidth/($wide+$gap);
$startpt=$total-$band;
if($startpt<0) $startpt=0;

$mvalue=$h[0];
for($k=0;$k<$total; $k++)
    if( $h[$k+1]>$mvalue) $mvalue=$h[$k+1];
$highest=$mvalue;

$mv=$l[$total-1];
for($k=$total-1;$k>=0; $k--)
    if( $l[$k] < $mv) $mv=$l[$k];
$belowest=$mv;

$mvalue=$vol[0];
for($k=0;$k<$total; $k++)
    if( $vol[$k+1]>$mvalue) $mvalue=$vol[$k+1];
$volmax=$mvalue;

$ky=$upperpart/($highest-$belowest);

for($i=$startpt; $i<$total; $i++)
{

    $yop[$i]=intval($upperpart-$ky*($op[$i]-$belowest));
    $ycl[$i]=intval($upperpart-$ky*($cl[$i]-$belowest));
    $yh[$i]=intval($upperpart-$ky*( $h[$i]-$belowest));
    $yl[$i]=intval($upperpart-$ky*( $l[$i]-$belowest));
    $yv[$i]=intval($imgheight - 100* $vol[$i]/$volmax);
}


Header("Content-Type: image/gif");
$p=imagecreate($imgwidth,$imgheight);
$red =imagecolorallocate($p, 255,0,0);
$blue =imagecolorallocate($p, 0,0,255);
$white=imagecolorallocate($p, 255,255,255);
imagefilledrectangle($p, 0,0,$imgwidth,$imgheight, $white);


for($i=$startpt;$i<$total; $i++)
{
    $x[$i]=($wide+$gap)*($i-$startpt);
    $left=$x[$i];
    $right=$x[$i]+$wide;
    if($cl[$i]>=$op[$i])
    {
        $top=$ycl[$i];
        $bottom=$yop[$i];
        $topv=$yv[$i];
        $bottomv=$imgheight;
        imagefilledrectangle($p, $left,$top, $right,$bottom, $red);
        imagefilledrectangle($p, $left,$topv, $right,$bottomv, $red);
        imageline($p, $left+$wide/2, $yh[$i], $left+$wide/2, $yl[$i], $red);
    }
    if($cl[$i]< $op[$i])
    {
        $top=$yop[$i];
        $bottom=$ycl[$i];
        $topv=$yv[$i];
        $bottomv=$imgheight;
        imagefilledrectangle($p, $left,$top, $right,$bottom, $blue);
        imagefilledrectangle($p, $left,$topv, $right,$bottomv, $blue);
        imageline($p, $left+$wide/2, $yh[$i], $left+$wide/2, $yl[$i], $blue);
    }
}
imagegif($p);
imagedestroy($p);
?>