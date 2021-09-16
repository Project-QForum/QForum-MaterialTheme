function register(params,success,failure){
    sendGet("user/register",params,success,failure);
}
function login(params,success,failure){
    sendGet("user/login",params,success,failure);
}
function checkLogin(params,success,failure){
    sendGet("user/checkLogin",params,success,failure);
}
