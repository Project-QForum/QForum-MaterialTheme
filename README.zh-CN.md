# QForum-MaterialTheme

◀[返回到 QForum 项目索引](https://github.com/JackuXL/QForum)

🌏[English](https://github.com/JackuXL/QForum-MaterialTheme/) | 简体中文

QForum-MaterialTheme 是 [QForum](https://github.com/JackuXL/QForum) 的官方前端主题。

本主题需要配合 [QForum-Core](https://github.com/JackuXL/QForum-Core) 使用。

### 开始使用（实验性）

1. 安装  [QForum-Core](https://github.com/JackuXL/QForum-Core)。

2. 修改 /js/util/NetWorkUtil_v2.js 中的 BASE_URL 为安装 QForum-Core 的地址，THEME_URL 为安装本主题的地址。

3. 可选内容：

   - 修改 /common/appbar.html 中论坛名称

   - 添加伪静态（实现 /thread/TIDXXX 和 /board/BIDXXX），并修改 /js/App_v2.js 中的 PSEUDO_STATIC_CONFIGURED 为 true

     ```nginx
     # Nginx
     # QForum-START
     location ~ "^/thread/TID(.*)$" 
     {
         try_files $uri /thread/?id=$1;
     }
     
     location ~ "^/board/BID(.*)$" 
     {
         try_files $uri /board/?boardId=$1;
     }
     # QForum-END
     ```

### 特点

- 使用 Material Design 设计语言。
- 使用轻量级 CSS 框架 MDUI，极速加载。
