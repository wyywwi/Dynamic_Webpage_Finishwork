document.addEventListener('visibilitychange', function () {
    // 页面变为不可见时触发 
    if (document.visibilityState == 'hidden') {
      document.title = '华中大月历';
    }
    // 页面变为可见时触发 
    if (document.visibilityState == 'visible') {
      document.title = '秋九月';
    }
});

function ChangeBackground_9(){
    let chbutton = document.getElementById("background_switch_button");
    let chmonthname = document.getElementById("monthname_9");
    if(chbutton.innerHTML == "深色")
        {chbutton.innerHTML = "浅色"}
    else
        {chbutton.innerHTML = "深色"};
    if(document.body.style.backgroundColor != "rgb(94, 102, 91)"){
        document.body.style.backgroundColor = "rgb(94, 102, 91)";
        chmonthname.style.color = "#d9d9d9";
        chbutton.innerHTML = document.body.style.backgroundColor;//置于最后，测试阶段代码正确性检测器
    }
    else
        {document.body.style.backgroundColor = "#f9f9f9"}
}