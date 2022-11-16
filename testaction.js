document.addEventListener('visibilitychange', function () {
    // 页面变为不可见时触发 
    if (document.visibilityState == 'hidden') {
      document.title = '春江花月夜';
    }
    // 页面变为可见时触发 
    if (document.visibilityState == 'visible') {
      document.title = '登录页';
    }
});

function pswdvisible(){
    let pswd = document.getElementById("pswdinput")
    if(pswd.type === "password"){
        pswd.type = "text";
    }
    else{
        pswd.type = "password";
    }
    let chbutton = document.getElementById("pswdvis")
    if(chbutton.innerHTML === "不可见"){
        chbutton.innerHTML = "可&nbsp;&nbsp;见";
    }
    else{
        chbutton.innerHTML = "不可见";
    }
}