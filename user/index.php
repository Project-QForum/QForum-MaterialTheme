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
    <title>用户中心 | QForum</title>
    <link rel="shortcut icon" href="../img/favicon.png">
</head>
<body class="mdui-theme-primary-blue mdui-theme-accent-blue mdui-drawer-body-left mdui-appbar-with-toolbar">


<div id="appbar"></div>
<div id="drawer"></div>
<div class="mdui-container">

<div class="mdui-card mdui-shadow-5">

    <div class="mdui-card-media">
      <img class="mdui-img-fluid mdui-img-rounded" src="../img/card.jpg"/>
    </div>
    
    <div class="mdui-card-primary">
      <div id="userName" class="mdui-card-primary-title">UserName</div>
      <div id="email" class="mdui-card-primary-subtitle">UserInfo</div>
      <!-- TODO——用户头衔等信息 -->
      <div class="mdui-card-content">个人简介</div>
    </div>
  
    <!-- TODO——文章列表 -->
  
    <div class="mdui-card-actions">
      <button class="mdui-btn mdui-ripple">action 1</button>
      <button class="mdui-btn mdui-ripple">action 2</button>
      <button class="mdui-btn mdui-btn-icon mdui-float-right"><i class="mdui-icon material-icons">more_vert</i></button>
    </div>
  
  </div>
  <br>
  <!-- 个人信息的显示&修改（登录身份为本人） -->
  <div class="mdui-card mdui-shadow-5">
    
    <div class="mdui-card-primary">

        <div class="mdui-card-primary-subtitle">个人设置</div>

        <div class="mdui-panel" mdui-panel>

            <div class="mdui-panel-item">
              <div class="mdui-panel-item-header">First</div>
              <div class="mdui-panel-item-body">
                <p>First content</p>
                <p>First content</p>
                <p>First content</p>
                <p>First content</p>
                <p>First content</p>
                <p>First content</p>
              </div>
            </div>
          
            <div class="mdui-panel-item">
              <div class="mdui-panel-item-header">Second</div>
              <div class="mdui-panel-item-body">
                <p>Second content</p>
                <p>Second content</p>
                <p>Second content</p>
                <p>Second content</p>
                <p>Second content</p>
                <p>Second content</p>
              </div>
            </div>
          
            <div class="mdui-panel-item">
              <div class="mdui-panel-item-header">Third</div>
              <div class="mdui-panel-item-body">
                <p>Third content</p>
                <p>Third content</p>
                <p>Third content</p>
                <p>Third content</p>
                <p>Third content</p>
                <p>Third content</p>
              </div>
            </div>
          
          </div>    </div>
  
  
  </div>
</div>
  <!-- MDUI JavaScript -->
<script
        src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
        integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
        crossorigin="anonymous"
></script>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script src="../js/util/NetWorkUtil_v1.js"></script>
<script src="../js/app_v1.js"></script>
<script src="../js/api/user_v2.js"></script>
<?php
    if(array_key_exists("uid",$_GET)){
        echo "<script>let uid=".$_GET["uid"]."</script>";
    }
    else{
        echo "<script>let uid=".$_COOKIE["uid"]."</script>";
    }
?>
<script>
    $("#appbar").load("../common/appbar.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#title").text("用户中心");
        }
    });
    $("#drawer").load("../common/drawer.html", function (responseTxt, statusTxt) {
        if (statusTxt === "success") {
            $("#main").attr("href","../");
        }
    });
    $(function () {
        let msg = getQueryStringByName("msg");
        if(msg){
            mdui.snackbar(msg);
        }
        getProfile(uid,function (data) {
            $("#userName").text(data["profile"]["userName"]);
            $("#email").text(data["profile"]["email"]);
        });
    });
</script>

</body>
</html>