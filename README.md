# cmf-blog
本博客应用免费开源供大家学习交流和使用，为保护本博客作者和ThinkCMF的劳动成果，请勿更改版权。



以下为安装步骤：



1.先安装好ThinkCMF，必须确保ThinkCMF可以正常使用（*）



2.将blog/应用/blog  放入ThinkCMF下的app目录下，作为独立应用；



3.将blog/前台模板/blog 放入ThinkCMF下的public/themes/simpleboot3目录（如果你有新的前台模板，请放入新模板中）作为博客展示模板；



4.将blog/后台模板/blog 放入ThinkCMF下的public/themes/admin_simpleboot3（如果你有新

的前台模板，请放入新模板中） 目录下作为后台管理模板；



5.导入blog下的cmf_blog.sql文件到数据库，以创建本博客应用需要用到的数据表；



6.为了便于blog应用的路由管理，采用的是独立于其它应用的路由，请在ThinkCMF目录的app目录下修改route.php为：

 $runtimeRoutes = include CMF_ROOT . "data/conf/route.php";



 $blogRoutes = include CMF_ROOT."/app/blog/route.php";



 $runtimeRoutes = array_merge($runtimeRoutes,$blogRoutes);



7.以上文件导入完毕之后,请以调试模式进入管理后台，点击左上角菜单图标：后台菜单->所有菜单->导入新菜单。然后等待菜单导入即可；



8.默认打开域名指向portai应用，如果想以博客应用作为网站默认应用，修改app/config.php文件，查找 默认模块名 ，修改default_module 为blog即可。



常见安装问题：

  1.权限不足。出现此情况，请给与ThinkCMF下的data目录和public/upload目录 777权限。如：chmod 777 -R 目录

  2.安装ThinkCMF的时候会自动弹出检测机制，按照系统提示自动修改。如开启php fileinfo扩展等

  3.安装ThinkCMF的信息一定要填写正确且切记，一般默认的选项不用修改即可（当然，大佬除外）

效果可查看我的博客，如果你有疑问或者更好的建议欢迎，请在我的博客留下你的想法。

个人网站:http://www.kavience.com
博客：http://blog.kavience.com

（完）
