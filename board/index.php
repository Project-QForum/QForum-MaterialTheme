<!doctype html>
<html lang="zh-cmn-Hans"><!-- 简体中文（大陆）现代标准 -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- MDUI CSS -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
            integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
            crossorigin="anonymous"
    />

    <!-- Title -->
    <title>板块 | QForum</title>
    <link rel="shortcut icon" href="../img/favicon.png">
</head>
<body class="mdui-theme-primary-blue mdui-theme-accent-blue mdui-drawer-body-left mdui-appbar-with-toolbar">


<div id="appbar"></div>
<div id="drawer"></div>

<ul id="threads" class="mdui-list">
</ul>
<!-- MDUI JavaScript -->
<script
        src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
        integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
        crossorigin="anonymous"
></script>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script src="../js/util/NetWorkUtil_v1.js"></script>
<script src="../js/app_v1.js"></script>
<script src="../js/api/thread_v1.js"></script>

<!-- 配合伪静态 -->
<?php
echo "<script>let bid=".$_GET["boardId"]."</script>";
?>

<script>
    $("#appbar").load("../../common/appbar.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#title").text("板块");
        }
    });
    $("#drawer").load("../../common/drawer.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#main").attr("href","../");

            $("#postThread").show();
        }
    });
    function isLogin() {
        return getCookie("sessionId")!=null;
    }

    function onPostThreadButtonClick() {
        if (isLogin()) {
            location.href = "../thread/post/?boardId="+bid;
        } else {
            location.href = "../user/login"
        }
    }
    $(function () {
        let msg = getQueryStringByName("msg");
        if(msg){
            mdui.snackbar(msg);
        }
        listThreads("boardId="+bid,function (data) {
            $("#loading").hide();
            let item = [
                '<a href="%link%"><li class="mdui-list-item mdui-ripple">',
                '<div class="mdui-list-item-avatar"><i class="mdui-icon material-icons">assignment</i></div>',
                '<div class="mdui-list-item-content">',
                '<div class="mdui-list-item-title">%title%</div>',
                '<div class="mdui-list-item-text mdui-list-item-one-line">%subtitle%</div>',
                '</div>',
                '</li></a>',
            ].join("\n");
            for(let i = data["size"]-1;i>=0;i--){
                let link = "../thread/?id=" + data["threadList"][i]["id"];
                if(PSEUDO_STATIC_CONFIGURED){
                    link = "../thread/TID" + data["threadList"][i]["id"];
                }
                $("#threads")
                    .append(item.replace("%title%",data["threadList"][i]["title"])
                        .replace("%subtitle%",data["threadList"][i]["publisher"]["userName"])
                        .replace("%link%",link));
                if(i!==data["size"]-1){
                    $("#threads").append('<li class="mdui-divider-inset mdui-m-y-0"></li>');
                }
            }
        },function () {
            mdui.snackbar("加载失败");
        });
    });
</script>

</body>
</html>
