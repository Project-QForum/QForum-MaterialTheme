BASE_URL = "http://localhost:8080/";
THEME_URL = "https://beta.wearbbs.cn/"

function sendGet(url,params,success,failure){
    $.get(BASE_URL + url + "?" + params, success).fail(failure);
}
function sendPost(url,params,success,failure){
    $.post(BASE_URL + url,params, success).fail(failure);
}



function setCookie(name,value)
{
    const Days = 30;
    const exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString() + ";path=/";
}
//读取cookies
function getCookie(name)
{
    let arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    arr = document.cookie.match(reg);
    return unescape(arr[2])==="null"?null:unescape(arr[2]);
}
//删除cookies
function delCookie(name)
{
    setCookie(name,"null");
}