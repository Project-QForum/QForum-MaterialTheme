function postThread(params,success,failure){
    sendPost("thread/post",params,success,failure);
}

function getThreadDetail(params,success,failure){
    sendGet("thread/getThreadDetail",params,success,failure);
}

function listThreads(params, success, failure){
    sendGet("thread/list",params,success,failure);
}