function listComments(params,success,failure){
    sendGet("comment/list",params,success,failure);
}

function postComment(params,success,failure){
    sendPost("comment/post",params,success,failure);
}