# api-interfaces-manguage
api项目接口管理系统
为了解决多人同时开发APP接口时,文档书写、合并以及前端调试接口时的种种不便,
我和一位同事使用YII2框架开发出了这套接口管理系统。
系统运行环境是：PHP7.0 Mysql5.6
在此要特别感谢我旁边的前端妹妹对我们的鼎力相助,虽然她只负责了卖萌。
如有问题，欢迎大家和我们一起交流学习。
开发者:
	许鹏亮 11468804@qq.com
	高建波 419638354@qq.com
	
使用方法：
	克隆项目后只需将根目录下的yilulao.sql导入到mysql,然后修改api/config/main.php下的数据库配置即可。
	 'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yilulao',
            'username' => '用户名',
            'password' => '密码',
            'charset' => 'utf8',
            'tablePrefix'=>'hl_',
        ],
	
