> ⚠Please note that this project is no longer maintained, please use [QForum-Web-MaterialDesign](https://github.com/Project-QForum/QForum-Web-MaterialDesign).
>
> ⚠请注意，此项目已不再维护，请使用 [QForum-Web-MaterialDesign](https://github.com/Project-QForum/QForum-Web-MaterialDesign)。

# QForum-MaterialTheme

◀[Back to the index of the QForum project](https://github.com/JackuXL/QForum)

🌏English | [简体中文](https://github.com/JackuXL/QForum-MaterialTheme/blob/master/README.zh-CN.md)

QForum-MaterialTheme is the Official Front-end Theme of  [QForum](https://github.com/JackuXL/QForum).

This theme needs to be used with [QForum-Core](https://github.com/JackuXL/QForum-Core).

### Start Using (Experimental)

1. Install  [QForum-Core](https://github.com/JackuXL/QForum-Core).

2. Modify BASE_URL in /js/util/NetWorkUtil_v1.js to the address where QForum-Core is installed, and THEME_URL to the address where this theme is installed.

3. Optional content:

   - Modify the forum name in /common/appbar.html

   - Add pseudo-static (implement /thread/TIDXXX and /board/BIDXXX),and modify PSEUDO_STATIC_CONFIGURED in /js/app_v2.js to true

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

### Features

- Use Material Design language.
- Use the lightweight CSS framework MDUI to load extremely fast.
