function listBoards(params, success, failure){
    sendGet("board/list",params,success,failure);
}