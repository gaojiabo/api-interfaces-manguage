# api-interfaces-manguage<br>
api项目接口管理系统<br>
为了解决多人同时开发APP接口时,文档书写、合并以及前端调试接口时的种种不便,<br>
我和一位同事使用YII2框架开发出了这套接口管理系统。<br>
系统运行环境是：PHP7.0 Mysql5.6<br>
在此要特别感谢我旁边的前端妹妹对我们的鼎力相助,虽然她只负责了卖萌。<br>
如有问题，欢迎大家和我们一起交流学习。<br>
开发者:<br>
　许鹏亮 11468804@qq.com<br>
　高建波 419638354@qq.com<br>
	
使用方法：<br>
　克隆项目后只需将根目录下的yilulao.sql导入到mysql,然后修改api/config/main.php下的数据库配置即可。<br>
　'db' => [<br>
　　'class' => 'yii\db\Connection',<br>
　　'dsn' => 'mysql:host=127.0.0.1;dbname=yilulao',<br>
　　'username' => '用户名',<br>
　　'password' => '密码',<br>
　　'charset' => 'utf8',<br>
　　'tablePrefix'=>'hl_',<br>
　]<br>
linux下，当你拉取项目并将数据库配置好之后，将api-interfaces-manguage/api/web/assets这个文件用chmod -r 777 assets 赋予权限。

	
