function listApps(params, success, failure){
    sendGet("app/list",params,success,failure);
}

function getAppDetail(params,success,failure){
    sendGet("app/getAppDetail",params,success,failure);
}