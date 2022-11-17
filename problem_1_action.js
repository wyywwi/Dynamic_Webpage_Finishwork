function ChangeBackground_9(){
    let chbutton = document.getElementById("background_switch_button");
    let chmonthname = document.getElementsByClassName("monthname");
    if(chbutton.innerHTML == "深色")
        {chbutton.innerHTML = "浅色"}
    else
        {chbutton.innerHTML = "深色"};
    if(document.body.style.backgroundColor != "rgb(74, 74, 74)"){
        document.body.style.backgroundColor = "rgb(74, 74, 74)";
        chmonthname.style.color = "#d9d9d9";//此处改变不了颜色，存疑待解
    }
    else
        {document.body.style.backgroundColor = "#f9f9f9"}
}