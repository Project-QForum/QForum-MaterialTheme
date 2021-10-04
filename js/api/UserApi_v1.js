function register(params,success,failure){
    sendGet("user/register",params,success,failure);
}
function login(params,success,failure){
    sendGet("user/login",params,success,failure);
}
function setUserName(params,success,failure){
    sendGet("user/setUserName",params,success,failure);
}
function setPassword(params,success,failure){
    sendGet("user/setPassword",params,success,failure);
}
function setIntroduction(params,success,failure){
    sendGet("user/setIntroduction",params,success,failure);
}
function setAvatarUrl(params,success,failure){
    sendGet("user/setAvatarUrl",params,success,failure);
}
function checkLogin(params,success,failure){
    sendGet("user/checkLogin",params,success,failure);
}
function getProfile(params,success,failure) {
    sendGet("user/getProfile",params,success,failure);
}
