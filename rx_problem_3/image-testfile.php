<?php
//创建画布
$im = imagecreatetruecolor(400,300);

//修改背景为白色
//$white = imagecolorallocate($im,255,255,255);
//imagefill($im,0,0,$white);

//创建颜色
$red = imagecolorallocate($im,255,0,0);
$green = imagecolorallocate($im,0,255,0);
$blue = imagecolorallocate($im,0,0,255);

//图像示例
imagesetpixel($im, 0, 0, $red);
imageline($im,0,0,400,300,$red);
imagerectangle($im,2,2,40,50,$red);
imagefilledrectangle($im,2,2,40,50,$red);

//输出图像
header("content-type:image/png");
imagepng($im);

//销毁图片（释放内存）
imagedestroy($im);
?>