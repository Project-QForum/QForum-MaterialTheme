let PSEUDO_STATIC_CONFIGURED = false;

//根据参数名获取参数值
function getQueryStringByName(name){
     var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));
     if(result == null || result.length < 1){
         return "";
     }
     if (result[1].indexOf("%")!==-1) {
         result[1] = decodeURIComponent(result[1]);
     }
     return result[1];
}
function getUrlValue(){
    let url = location.href;
    //获取最后一个/的位置
    let site = url.lastIndexOf("\/");
    //截取最后一个/后的值
    return url.substring(site + 1, url.length);
}
function before_time(dateTimeStamp) {
    var minute = 1000 * 60; //把分，时，天，周，半个月，一个月用毫秒表示
    var hour = minute * 60;
    var day = hour * 24;
    var week = day * 7;
    var halfamonth = day * 15;
    var month = day * 30;
    var year = day * 365;
    var now = new Date().getTime(); //获取当前时间毫秒
    var diffValue = now - dateTimeStamp; //时间差

    if (diffValue < 0) {
        return;
    }
    var minC = diffValue / minute; //计算时间差的分，时，天，周，月
    var hourC = diffValue / hour;
    var dayC = diffValue / day;
    var weekC = diffValue / week;
    var monthC = diffValue / month;
    var yearC = diffValue / year;
    var result;
    if (yearC >= 1) {
        result = " " + parseInt(yearC) + "年前";
    } else if (monthC >= 1 && monthC <= 12) {
        result = " " + parseInt(monthC) + "月前";
    } else if (weekC >= 1 && weekC <= 4) {
        result = " " + parseInt(weekC) + "周前";
    } else if (dayC >= 1 && dayC <= 7) {
        result = " " + parseInt(dayC) + "天前";
    } else if (hourC >= 1 && hourC <= 24) {
        result = " " + parseInt(hourC) + "小时前";
    } else if (minC >= 1 && minC <= 60) {
        result = " " + parseInt(minC) + "分钟前";
    } else if (diffValue >= 0 && diffValue <= minute) {
        result = "刚刚";
    } else {
        var datetime = new Date();
        datetime.setTime(dateTimeStamp);
        var Nyear = datetime.getFullYear();
        var Nmonth =
            datetime.getMonth() + 1 < 10
                ? "0" + (datetime.getMonth() + 1)
                : datetime.getMonth() + 1;
        var Ndate =
            datetime.getDate() < 10
                ? "0" + datetime.getDate()
                : datetime.getDate();
        var Nhour =
            datetime.getHours() < 10
                ? "0" + datetime.getHours()
                : datetime.getHours();
        var Nminute =
            datetime.getMinutes() < 10
                ? "0" + datetime.getMinutes()
                : datetime.getMinutes();
        var Nsecond =
            datetime.getSeconds() < 10
                ? "0" + datetime.getSeconds()
                : datetime.getSeconds();
        result = Nyear + "-" + Nmonth + "-" + Ndate;
    }
    return result;
}

function analysisError(error){
    switch (error){
        case "username_already_exists":
            return "用户名已存在";
        case "email_already_exists":
            return "邮箱已被占用";
        case "no_such_user":
            return "用户不存在";
        case "no_such_board":
            return "板块不存在";
        case "no_such_thread":
            return "帖子不存在";
        case "password_mismatch":
            return "密码错误";
        case "bad_parameter":
            return "表单不完整";
        case "title_cannot_be_empty":
            return "标题不能为空";
        default:
            return "未知错误";
    }
}
function isLogin() {
    return getCookie("sessionId")!=null;
}