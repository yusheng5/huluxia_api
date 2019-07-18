# huluxia_api
移动端抓包获取的葫芦侠三楼接口整合php
# 注意事项
项目根目录下.env文件
* MAIL_HOST 邮箱服务器地址
* MAIL_PORT 端口
* MAIL_USERNAME 用户
* MAIL_PASSWORD 密码
* MAIL_ENCRYPTION 是否SSL
* HuLuXia_user_id 葫芦侠用户ID (此需要手动抓包获取)
# 相关文件
* /extend/Gourd.php 葫芦侠相关操作
* /extend/Requests.php curl常用操作
## 其他
* sql文件丢失，请自行脑补 *-*
* 模拟葫芦侠登录 在\app\Http\Controllers\Index\Index.php@login内已说明
### 本程序参考的api接口文章稍后补充...
