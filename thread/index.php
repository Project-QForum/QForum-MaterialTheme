<!DOCTYPE html>
<html lang="zh-cmn-Hans"><!-- 简体中文（大陆）现代标准 -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>帖子 | WearBBS</title>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
            integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="mdui-theme-primary-blue mdui-theme-accent-blue mdui-drawer-body-left mdui-appbar-with-toolbar">
<div id="drawer"></div>
<div id="appbar"></div>


<div class="thread mdui-typo">
    <h1 id="thread_title" class="mdui-text-color-theme" style="font-size: xxx-large"><div class="mdui-spinner mdui-spinner-colorful"></div></h1>
    <div class="thread_publisher">
        <a id="thread_publisher_userName" class="user-popover-trigger mdui-text-color-theme-text"></a>
        <i id="admin" class="mdui-icon material-icons" style="display: none;margin-bottom: 10px">check_circle</i>
        <span id="thread_time" class="time mdui-text-color-theme-secondary"></span>
    </div>
    <div class="mdui-card mdui-card-shadow question">
        <div id="thread_content"><div class="mdui-progress"><div class="mdui-progress-indeterminate"></div></div></div>

        <div class="mc-loading mdui-hidden">
            <div class="mdui-spinner">
                <div class="mdui-spinner-layer ">
                    <div class="mdui-spinner-circle-clipper mdui-spinner-left">
                        <div class="mdui-spinner-circle"></div>
                    </div>
                    <div class="mdui-spinner-gap-patch">
                        <div class="mdui-spinner-circle"></div>
                    </div>
                    <div class="mdui-spinner-circle-clipper mdui-spinner-right">
                        <div class="mdui-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="comments_box" class="mdui-card mdui-card-shadow question" style="margin-top: 20px">
        <div style="font-size: x-large;margin-top: 20px;margin-bottom: 20px">
            评论
        </div>

        <div id="comments"></div>
        <div id="new_comment" class="mdui-textfield new-comment mdui-textfield-floating-label" style="margin-left: -25px;margin-right: -25px;padding-bottom: 0">
            <input id="input_comment" class="mdui-textfield-input" type="text" placeholder="发一条友善的评论" style="width: 95%"/>
            <button id="btn_submit" onclick="commit()" class="mdui-btn mdui-btn-raised mdui-color-theme-600" style="width: 5%;margin-left: 20px">发布</button>
        </div>
    </div>
</div>

<style>

    .mdui-card {
        position: relative;
        box-sizing: border-box;
        border: 1px solid rgba(0,0,0,.12);
        border-radius: 8px;
        padding: 2%;
    }
    .thread {
        margin:5%;
    }
    .thread_publisher{
        margin-bottom: 20px;
        margin-top: 10px;
        font-size: 20px;
    }
</style>
<script
        src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
        integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
        crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../js/util/NetWorkUtil.js"></script>
<script src="../js/api/Thread.js"></script>
<script src="../js/api/Comment.js"></script>
<script src="../js/App.js"></script>

<!-- 配合伪静态 -->
<?php
echo "<script>let tid=".$_GET["id"]."</script>";
?>

<script>
    $("#appbar").load("../../common/appbar.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#title").text("帖子");
        }
    });
    $("#drawer").load("../../common/drawer.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#main").attr("href","../");
        }
    });
    function commit() {
        let params = {};
        params.sessionId = getCookie("sessionId");
        params.threadId = getQueryStringByName("id");
        params.content = $("#input_comment").val();
        params = $.param(params);
        postComment(params,function () {
            mdui.snackbar("发送成功，请刷新")
        },function (data) {
            mdui.snackbar(analysisError(data["error"]));
        });
    }
    $(function () {
        let msg = getQueryStringByName("msg");
        console.log(location.href);
        if (msg) {
            mdui.snackbar(msg);
        }
        getThreadDetail("id=" + tid, function (data) {
            $("#thread_title").text(data["title"]);
            $("#thread_time").text(before_time(data["postTime"]));
            $("#thread_content").html(data["content"]);
            $("#thread_publisher_userName").text(data["publisher"]["userName"]);
            if(data["publisher"]["admin"]){
                $("#admin").show();
            }
        }, function (data) {
            $("#thread_title").text("加载失败");
            $("#thread_time").text("加载失败");
            $("#thread_content").html("加载失败");
            $("#thread_publisher_userName").text("加载失败");
            mdui.snackbar(analysisError(data["error"]));
        });
        if(!isLogin()){
            $("#new_comment").hide()
        }
        $("#comments").append('<div id="loading_comments" class="mdui-spinner mdui-spinner-colorful"></div>');
        listComments("threadId="+tid,function (data) {
            let item = [
                '<li class="mdui-list-item mdui-ripple">',
                '<div class="mdui-list-item-avatar"><i class="mdui-icon material-icons">account_circle</i></div>',
                '<div class="mdui-list-item-content">',
                '<div class="mdui-list-item-title">%title%</div>',
                '<div class="mdui-list-item-text">%subtitle%</div>',
                '</div>',
                '</li>',
            ].join("\n");
            if(data["size"]<=0){
                $("#comments").append('<p class="hint">什么都没有哦</p>');
            }
            else{
                for(let i = 0;i<data["size"];i++){
                    $("#comments").append(item.replace("%title%",data["commentList"][i]["publisher"]["userName"]).replace("%subtitle%",data["commentList"][i]["content"]).replace("<script>","<pre>").replace("<//script>","<//pre>"));
                    if(data["size"]-i!==1){
                        $("#comments").append('<li class="mdui-divider-inset mdui-m-y-0" style="list-style: none"></li>');
                    }
                }
            }
            $("#loading_comments").hide()

        },function () {
            mdui.snackbar("加载失败");
        });
    });

</script>
</body>
</html>