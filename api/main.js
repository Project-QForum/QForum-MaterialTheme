BASE_URL = "https://api.wearbbs.cn/user";
function sendGet(path,params,next){
    let result = undefined;
    $.get(BASE_URL + path + "?" + params, function (data) {
        if (JSON.stringify(data).indexOf("code") !== -1) {
            result =  "成功";
            location.href = next;
        }
        else{
            result =  "未知错误";
        }
        mdui.snackbar(result);
    }).fail(function (data) {
        result = analysisError(JSON.parse(data["responseText"])["error"]);
        mdui.snackbar(result);
    });
}
function analysisError(error){
    switch (error){
        case "username_already_exists":
            return "用户名已存在";
        case "email_already_exists":
            return "邮箱已被占用";
        case "no_such_user":
            return "用户不存在";
        case "password_mismatch":
            return "密码错误";
        default:
            return "未知错误";
    }
}