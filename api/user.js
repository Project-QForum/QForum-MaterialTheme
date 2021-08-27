function register(params,next){
    sendGet("/register",params,next);
}
function login(params,next){
    sendGet("/login",params,next);
}
