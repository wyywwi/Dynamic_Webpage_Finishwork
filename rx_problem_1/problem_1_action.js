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

//rgb(94, 102, 91) 八月 绿渐失
//rgb(94, 92, 71)  九月 叶始褐
//rgb(90, 82, 61)  十月 零落四散尘泥中

function ChangeBackground_8(){
    let chbutton = document.getElementById("background_switch_button_8");
    let chmonthname = document.getElementById("monthname_8");
    let chquote = document.getElementById("quote_8");
    let chmonthtable = document.getElementById("monthtable_8");
    let chmainheader = document.getElementById("main_header_8");
    if(chbutton.innerHTML == "深色")
        {chbutton.innerHTML = "浅色"}
    else
        {chbutton.innerHTML = "深色"};
    if(document.body.style.backgroundColor != "rgb(94, 102, 91)"){
        document.body.style.backgroundColor = "rgb(94, 102, 91)";
        chmonthname.style.color = "#c9c9c9";
        chquote.style.color = "#c9c9c9";
        chmonthtable.style.color = "#c9c9c9";
        chmainheader.style.color = "#c9c9c9";
        //chbutton.innerHTML = document.body.style.backgroundColor;//置于最后，测试阶段代码正确性检测器
    }
    else{
        document.body.style.backgroundColor = "#f9f9f9";
        chmonthname.style.color = "#4a4a4a";
        chquote.style.color = "#4a4a4a";
        chmonthtable.style.color = "#4a4a4a";
        chmainheader.style.color = "#4a4a4a";
    }
}

function ChangeBackground_9(){
    let chbutton = document.getElementById("background_switch_button_9");
    let chmonthname = document.getElementById("monthname_9");
    let chquote = document.getElementById("quote_9");
    let chmonthtable = document.getElementById("monthtable_9");
    let chmainheader = document.getElementById("main_header_9");
    if(chbutton.innerHTML == "深色")
        {chbutton.innerHTML = "浅色"}
    else
        {chbutton.innerHTML = "深色"};
    if(document.body.style.backgroundColor != "rgb(94, 92, 71)"){
        document.body.style.backgroundColor = "rgb(94, 92, 71)";
        chmonthname.style.color = "#c9c9c9";
        chquote.style.color = "#c9c9c9";
        chmonthtable.style.color = "#c9c9c9";
        chmainheader.style.color = "#c9c9c9";
        //chbutton.innerHTML = document.body.style.backgroundColor;//置于最后，测试阶段代码正确性检测器
    }
    else{
        document.body.style.backgroundColor = "#f9f9f9";
        chmonthname.style.color = "#4a4a4a";
        chquote.style.color = "#4a4a4a";
        chmonthtable.style.color = "#4a4a4a";
        chmainheader.style.color = "#4a4a4a";
    }
}

function ChangeBackground_10(){
    let chbutton = document.getElementById("background_switch_button_10");
    let chmonthname = document.getElementById("monthname_10");
    let chquote = document.getElementById("quote_10");
    let chmonthtable = document.getElementById("monthtable_10");
    let chmainheader = document.getElementById("main_header_10");
    if(chbutton.innerHTML == "深色")
        {chbutton.innerHTML = "浅色"}
    else
        {chbutton.innerHTML = "深色"};
    if(document.body.style.backgroundColor != "rgb(90, 82, 61)"){
        document.body.style.backgroundColor = "rgb(90, 82, 61)";
        chmonthname.style.color = "#c9c9c9";
        chquote.style.color = "#c9c9c9";
        chmonthtable.style.color = "#c9c9c9";
        chmainheader.style.color = "#c9c9c9";
        //chbutton.innerHTML = document.body.style.backgroundColor;//置于最后，测试阶段代码正确性检测器
    }
    else{
        document.body.style.backgroundColor = "#f9f9f9";
        chmonthname.style.color = "#4a4a4a";
        chquote.style.color = "#4a4a4a";
        chmonthtable.style.color = "#4a4a4a";
        chmainheader.style.color = "#4a4a4a";
    }
}