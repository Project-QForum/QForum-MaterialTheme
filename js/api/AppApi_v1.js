function listApps(params, success, failure){
    sendGet("app/list",params,success,failure);
}

function getAppDetail(params,success,failure){
    sendGet("app/getAppDetail",params,success,failure);
}

function postApp(params,success,failure){
    sendPost("app/post",params,success,failure);
}