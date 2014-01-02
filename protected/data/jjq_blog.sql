/*
SQLyog v10.2 
MySQL - 5.1.33-community-log : Database - db_jason_blog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_jason_blog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_jason_blog`;

/*Table structure for table `jjq_attachment` */

DROP TABLE IF EXISTS `jjq_attachment`;

CREATE TABLE `jjq_attachment` (
  `id` bigint(32) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `post_id` int(11) unsigned NOT NULL COMMENT '博客序号',
  `filename` varchar(255) NOT NULL COMMENT '附件名称',
  `filesize` int(11) unsigned NOT NULL DEFAULT '0',
  `filepath` varchar(255) NOT NULL COMMENT '附件路径',
  `created` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='附件表';

/*Data for the table `jjq_attachment` */

insert  into `jjq_attachment`(`id`,`post_id`,`filename`,`filesize`,`filepath`,`created`,`updated`) values (1,66,'66',6,'6',0,0);

/*Table structure for table `jjq_category` */

DROP TABLE IF EXISTS `jjq_category`;

CREATE TABLE `jjq_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL COMMENT '别名',
  `position` int(11) unsigned DEFAULT '0' COMMENT '排序序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类表';

/*Data for the table `jjq_category` */

insert  into `jjq_category`(`id`,`pid`,`name`,`alias`,`position`) values (1,0,'yii','yii',0),(2,0,'php','php',0);

/*Table structure for table `jjq_comment` */

DROP TABLE IF EXISTS `jjq_comment`;

CREATE TABLE `jjq_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  `author` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `ip` varchar(128) DEFAULT NULL,
  `post_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

/*Data for the table `jjq_comment` */

insert  into `jjq_comment`(`id`,`content`,`status`,`created`,`author`,`email`,`url`,`ip`,`post_id`) values (1,'<p>This is a test comment.</p>',2,1230952187,'Tester','tester@example.com','','127.0.0.1',2),(4,'新版感觉怎么样呀！',2,1322327794,'winds','windsdeng@hotmail.com','http://www.dlf5.com',NULL,3),(5,'This blog system is developed using Yii. ',2,1322327830,'winds','windsdeng@hotmail.com','http://www.dlf5.com',NULL,1),(7,'磊',2,1333334787,'winds','winds','',NULL,11),(8,'tests',2,1342664286,'winds','winds@dlf5.com','',NULL,18),(9,'aaaaaaaaaaaaa',2,1342670342,'winds','winds@dlf5.com','','14.151.160.139',18),(12,'IP所在地演示',2,1343036021,'winds','winds@dlf5.com','http://dlf5.com','14.151.136.184',1),(13,'teste',2,1343170499,'teste','teste@teste.com','http://teste.com','186.204.167.230',1),(14,'This blog system is developed using Yii.',2,1343180043,'a','a@yahoo.com','','110.139.119.47',1),(15,'laskdjfasdf',2,1343227116,'qwer','qwer@ss.cc','','122.87.148.182',18),(17,'192.168.10.1 Yeah.........',2,1343520946,'melengo','ozan.rock@yahoo.co.id','http://melengo.wordpress.com','103.3.222.228',1),(18,'test',2,1343541617,'preketek','admin@google.co.id','','125.163.104.55',1),(19,'asd',2,1343786964,'123','asd@asd.asd','','211.144.84.242',1),(20,'test',2,1343824371,'test','test@test.com','http://www.test.com','101.109.214.68',1),(21,'asasd',2,1344031521,'sephiroth','plop@gmail.com','','190.201.47.138',1),(24,'test',2,1345530860,'winds','winds@dlf5.com','http://dlf5.com','59.41.95.95',1),(25,'winds',2,1345530897,'winds','winds@dlf5.com','http://dlf5.com','59.41.95.95',1),(26,'to to to ',2,1345530935,'winds','winds@dlf5.com','http://dlf5.com','59.41.95.95',1),(27,'Test',2,1345618336,'mbahsomo','mbahsomo@do-event.com','','111.196.127.133',1),(66,'<p>测试一下</p>',2,1388131816,'小航','christiubousoldes@gmail.com','','127.0.0.1',29),(67,'<p>聚会很不错哦<br/></p>',2,1388475193,'Jason','jason@offer99.com','','127.0.0.1',31),(61,'<p>不错哦，加油！</p><p>图片很好看。</p>',2,1388029448,'小纪','446505626@qq.com','','127.0.0.1',27),(62,'<p>这个很不错哦</p>',2,1388029627,'小红','446505333@qq.com','','127.0.0.1',27),(63,'<p>萨仿盛大</p>',2,1388029930,'小红','446505333@qq.com','www.baidu.com','127.0.0.1',27),(64,'<p>sadfa sadfsa&nbsp;</p>',2,1388030010,'小红','446505333@qq.com','','127.0.0.1',27),(65,'<p>sdfa sdf&nbsp;</p>',2,1388030359,'小红','446505333@qq.com','www.baidu.com','127.0.0.1',27);

/*Table structure for table `jjq_link` */

DROP TABLE IF EXISTS `jjq_link`;

CREATE TABLE `jjq_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `sitename` varchar(128) NOT NULL COMMENT '网站名称',
  `logo` varchar(128) DEFAULT NULL COMMENT '站标地址',
  `siteurl` varchar(255) NOT NULL COMMENT '网站地址',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `target` enum('_blank','_top','_self','_parent') DEFAULT '_blank' COMMENT '打开方式',
  `status` int(11) unsigned NOT NULL,
  `position` int(11) unsigned DEFAULT '0' COMMENT '排序序号',
  `created` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `updated` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jjq_link` */

/*Table structure for table `jjq_lookup` */

DROP TABLE IF EXISTS `jjq_lookup`;

CREATE TABLE `jjq_lookup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` int(11) unsigned NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `jjq_lookup` */

insert  into `jjq_lookup`(`id`,`name`,`code`,`type`,`position`) values (1,'草稿',1,'PostStatus',1),(2,'发布',2,'PostStatus',2),(3,'过期',3,'PostStatus',3),(4,'待审核',1,'CommentStatus',1),(5,'通过审核',2,'CommentStatus',2);

/*Table structure for table `jjq_options` */

DROP TABLE IF EXISTS `jjq_options`;

CREATE TABLE `jjq_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `option_name` varchar(255) NOT NULL COMMENT '选项名称',
  `option_value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`),
  KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='选项设置表';

/*Data for the table `jjq_options` */

insert  into `jjq_options`(`id`,`object_id`,`option_name`,`option_value`) values (1,0,'settings','{\"site_name\":\"windsdeng\'s blog\",\"site_closed\":\"no\",\"close_information\":\"\\u7f51\\u7ad9\\u5728\\u7ef4\\u62a4\\u4e2d\\u3002<br \\/> \\u8bf7\\u7a0d\\u5019\\u8bbf\\u95ee\\u3002\",\"site_url\":\"http:\\/\\/demo.dlf5.net\\/\",\"keywords\":\"\\u9093\\u6797\\u950b\\u7684\\u535a\\u5ba2\",\"description\":\"\\u9093\\u6797\\u950b\\u7684\\u535a\\u5ba2http:\\/\\/www.dlf5.com\",\"copyright\":\"windsdeng\'s blog\",\"author\":\"winds\",\"blogdescription\":\"\\u9093\\u6797\\u950b\\u7684\\u535a\\u5ba2\",\"default_editor\":\"ueditor\",\"theme\":\"classic\",\"email\":\"winds@dlf5.com\",\"rss_output_num\":\"10\",\"rss_output_fulltext\":\"yes\",\"post_num\":\"10\",\"time_zone\":\"\\u4e0a\\u6d77\",\"icp\":\"\",\"footer_info\":\"\",\"rewrite\":\"no\",\"showScriptName\":\"false\",\"urlSuffix\":\".html\"}');

/*Table structure for table `jjq_post` */

DROP TABLE IF EXISTS `jjq_post`;

CREATE TABLE `jjq_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(255) NOT NULL COMMENT '摘要',
  `tags` text,
  `status` int(11) unsigned NOT NULL,
  `created` int(11) unsigned DEFAULT '0',
  `updated` int(11) unsigned DEFAULT '0',
  `author_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned DEFAULT '0' COMMENT '分类ID',
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `jjq_post` */

insert  into `jjq_post`(`id`,`title`,`content`,`summary`,`tags`,`status`,`created`,`updated`,`author_id`,`category_id`) values (1,'Welcome!','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\n\nFeel free to try this system by writing new posts and posting comments.','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.','yii,blog',2,1230952187,1230952187,1,0),(2,'A Test Post','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ','test',2,1230952187,1230952187,1,0),(3,'我的博客','最新更新我的博客，新版感觉怎么样呀！','最新更新我的博客，新版感觉怎么样呀！','',2,1322064648,1322064686,1,0),(8,'Your title here','break-all','Your title here','yii',2,1322580959,1342664214,1,1),(24,'新增文章归档功能','<p>新增文章归档功能<br /></p><p><span style=\"color:#ffffff;font-family:&#39;helvetica neue&#39;, helvetica, arial, sans-serif;font-size:18px;font-weight:bold;line-height:18px;background-color:#1187dc;\">Archives</span><br /></p>','新增文章归档功能','Archives,文章归档',2,1347253302,1347253302,1,1),(30,'第四篇文章','<p>阿迪萨仿盛大水电费</p>','第四篇文章','',3,1388392245,0,1,0),(31,'第五篇文章','<p><img src=\"http://localhost/yii/jjq_blog20131226/ueditor/php/upload1//20131219/13874369527769.jpg\"/></p>','第五篇文章','',2,1388392581,1388392581,1,0),(32,'第六篇文章','<img src=\"/yii/jjq_blog20131226/kindeditor/php/../../upload/post/image/20131231/20131231072052_71872.jpg\" alt=\"\" />','第六篇文章','',2,1388474499,1388474499,1,0),(11,'标题 cannot be blank. ','Your title here...\r\n==================\r\nYour title here...\r\n------------------\r\n### Your title here...\r\n#### Your title here...\r\n##### Your title here...\r\n###### Your title here...\r\n\r\n','','',2,1323705679,1323705679,1,0),(12,'这在测试中','<p id=\"initContent\">这在测试中</p><p id=\"initContent\">这在测试中<br /></p><ol style=\"list-style-type:decimal;\"><li><p id=\"initContent\">这在测试中</p></li><li><p id=\"initContent\">这在测试中</p></li><li><p id=\"initContent\">这在测试中</p></li><li><p id=\"initContent\"><span>这在测试中</span><br /></p></li></ol>','test\r\n','test',2,1342540719,1342593593,1,1),(13,'我要做测试','<p id=\"initContent\">我要做测试<br /></p><p><strong>我要做测试</strong><br /></p><ol style=\"list-style-type:decimal;\"><li><p><strong>我要做测试</strong></p></li><li><p><strong>我要做测试</strong></p></li><li><p><strong>我要做测试</strong></p></li><li><p><strong>我要做测试<br /></strong></p></li></ol><p><br /></p>','test','test',2,1342540786,1342593609,1,1),(14,'ueditor-for-yii ','<p>it is code </p><p><span style=\"color:#222222;font-family:arial, sans-serif;font-size:13px;font-style:italic;line-height:19px;background-color:#ffffff;\">Ueditor是由百度web前端研发部开发的所见即所得富文本web编辑器，开源基于BSD协议。</span><br /></p><pre class=\"brush:php;toolbar:false;\">&lt;?php\r\n    $this-&gt;widget(\'ext.ueditor.Ueditor\',\r\n            array(\r\n                \'getId\'=&gt;\'Post_content\',\r\n                \'UEDITOR_HOME_URL\'=&gt;\"/\",\r\n                \'options\'=&gt;\'toolbars:[[\"fontfamily\",\"fontsize\",\"forecolor\",\"bold\",\"italic\",\"strikethrough\",\"|\",\r\n\"insertunorderedlist\",\"insertorderedlist\",\"blockquote\",\"|\",\r\n\"link\",\"unlink\",\"highlightcode\",\"|\",\"undo\",\"redo\",\"source\"]],\r\n                    wordCount:false,\r\n                    elementPathEnabled:false,\r\n                    imagePath:\"/attachment/ueditor/\",\r\n                    \',\r\n            ));\r\n?&gt;</pre><p><br /></p>','Ueditor是由百度web前端研发部开发的所见即所得富文本web编辑器，开源基于BSD协议。','php',2,1342541883,1342606184,1,1),(17,'php递归实现99乘法表','<p>代码如下：</p><p><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\"></span></p><pre class=\"brush:php;toolbar:false;\">&lt;?php\r\nfunction _99 ($n) {\r\nfor ($i=1;$i&lt;=$n;$i++) {\r\necho $i.’*’.$n.’=’.$n*$i.’&amp;nbsp;’;\r\n}\r\necho ‘&lt;br/&gt;’;\r\n$pre = $n – 1;\r\nif ($pre &lt; $n &amp;&amp; $pre &gt; 0) {\r\n_99 ($pre);\r\n}   \r\n}\r\n_99 (9);  \r\n?&gt;</pre><p><span style=\"color:#333333;font-family:georgia, bitstream charter, serif;\"><span style=\"line-height:24px;\"><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">结果如下：</span><br /></span></span></p><p><span style=\"color:#333333;font-family:georgia, bitstream charter, serif;\"><span style=\"line-height:24px;\"><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\"><br /></span></span></span></p><blockquote><p><span style=\"color:#333333;font-family:georgia, bitstream charter, serif;\"><span style=\"line-height:24px;\"><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\"><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">1*9=9 2*9=18 3*9=27 4*9=36 5*9=45 6*9=54 7*9=63 8*9=72 9*9=81</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">1*8=8 2*8=16 3*8=24 4*8=32 5*8=40 6*8=48 7*8=56 8*8=64</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">1*7=7 2*7=14 3*7=21 4*7=28 5</span><br /></span></span></span></p></blockquote><p><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\"><br /></span></p>','代码如下：','php',2,1342606433,1342606475,1,2),(18,'Yii在Nginx下的rewrite配置','<p><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">1. Nginx配置</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">在nginx.conf的server {段添加类似如下代码：</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">Nginx.conf代码:</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><font color=\"#333333\" face=\"monaco, consolas, andale mono, dejavu sans mono, monospace\" size=\"2\"><span style=\"line-height:24px;\"></span></font></p><pre class=\"brush:bash;toolbar:false;\">location / {\r\nif (!-e $request_filename){\r\nrewrite ^/(.*) /index.php last;\r\n}\r\n}</pre><p><font color=\"#333333\" face=\"monaco, consolas, andale mono, dejavu sans mono, monospace\" size=\"2\"><span style=\"line-height:24px;\"><br style=\"background-color:#FFFFFF;\" /></span></font><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">2. 在Yii的protected/conf/main.php去掉如下的注释</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><span style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\">Php代码:</span><br style=\"color:#333333;font-family:georgia, &#39;bitstream charter&#39;, serif;line-height:24px;background-color:#ffffff;\" /><font color=\"#333333\" face=\"monaco, consolas, andale mono, dejavu sans mono, monospace\" size=\"2\"><span style=\"line-height:24px;\"></span></font></p><pre class=\"brush:php;toolbar:false;\">\'urlManager\'=&gt;array(\r\n\'urlFormat\'=&gt;\'path\',\r\n\'rules\'=&gt;array(\r\n\'/\'=&gt;\'/view\',\r\n\'//\'=&gt;\'/\',\r\n\'/\'=&gt;\'/\',\r\n),\r\n),</pre><p><font color=\"#333333\" face=\"monaco, consolas, andale mono, dejavu sans mono, monospace\" size=\"2\"><span style=\"line-height:24px;\"><br /></span></font></p>','Nginx配置','yii',2,1342606936,1342606936,1,1),(25,'钓鱼岛是中国的','<h2 style=\"margin:0px;color:#555555;font-family:arial, helvetica, sans-serif;background-color:#ffffff;padding-bottom:12px;\">钓鱼岛是中国的</h2><h2 style=\"margin:0px;color:#555555;font-family:arial, helvetica, sans-serif;background-color:#ffffff;padding-bottom:12px;\">钓鱼岛是中国的</h2><h2 style=\"margin:0px;color:#555555;font-family:arial, helvetica, sans-serif;background-color:#ffffff;padding-bottom:12px;\">钓鱼岛是中国的</h2><h2 style=\"margin:0px;color:#555555;font-family:arial, helvetica, sans-serif;background-color:#ffffff;padding-bottom:12px;\">钓鱼岛是中国的</h2><p><br /><br /></p><p><br /></p>','钓鱼岛是中国的','钓鱼岛',2,1347357597,1347357597,1,1),(26,'新增皮肤功能','<p>新增皮肤功能</p><p>修改<br />在config/main.php</p><pre class=\"brush:php;toolbar:false;\">\'theme\'=&gt;\'classic\',     //皮肤配置 default为默认或注释掉</pre><p>欢迎大家下载学习。</p><p><a href=\"https://github.com/windsdeng/dlfblog\">https://github.com/windsdeng/dlfblog</a></p><p><br /></p><h2><a name=\"qq交流群\" class=\"anchor\" href=\"https://github.com/windsdeng/dlfblog#qq%E4%BA%A4%E6%B5%81%E7%BE%A4\"></a>QQ交流群</h2><p><code>1、185207750</code></p><p><br /></p><p>有什么建议可以提出来</p><p>所有功能都先是架起一个大至的框架，到时慢慢细致。<br /></p>','新增皮肤功能\r\n有什么建议可以提出来','classic,theme',2,1348392308,1348398138,1,1),(27,'第一篇文章','<p>这是我第一次写的博客，谢谢大家关注！<img style=\"width: 128px; height: 111px;\" title=\"\" src=\"http://localhost/yii/jjq_blog20131220/ueditor/php/upload1//20131219/13874369526461.jpg\" height=\"53\" hspace=\"0\" border=\"0\" vspace=\"0\" width=\"40\"/></p>','这是我第一次写博客','博客,第一次',2,1387440480,1387875969,1,0),(28,'第二篇文章','<p>第二篇文章，希望大家喜欢12221<img src=\"http://localhost/yii/jjq_blog20131220/ueditor/php/upload1//20131219/13874369529617.jpg\" style=\"width: 71px; height: 97px;\"/></p>','这是我写的第二篇文章','文章,生活',2,1387442150,1387875924,1,0),(29,'第三篇文章','<p>测试内容是不需要htmlspecialchars()进行转换html-&gt;str<img src=\"http://localhost/yii/jjq_blog20131220/ueditor/php/upload1//20131219/13874369525105.jpg\"/></p>','测试内容是不需要htmlspecialchars()进行转换html->str','yii',2,1387443194,1387875944,1,0);

/*Table structure for table `jjq_tag` */

DROP TABLE IF EXISTS `jjq_tag`;

CREATE TABLE `jjq_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `jjq_tag` */

insert  into `jjq_tag`(`id`,`name`,`frequency`) values (1,'yii',3),(2,'blog',1),(3,'test',3),(6,'UEditor',1),(7,'php',2),(14,'classic',1),(11,'Archives',1),(12,'文章归档',1),(13,'钓鱼岛',1),(15,'theme',1);

/*Table structure for table `jjq_user` */

DROP TABLE IF EXISTS `jjq_user`;

CREATE TABLE `jjq_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `password` varchar(128) NOT NULL,
  `avatar` varchar(128) NOT NULL COMMENT '头像',
  `salt` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile` text,
  `counts` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `created` int(11) unsigned NOT NULL DEFAULT '0',
  `updated` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `jjq_user` */

insert  into `jjq_user`(`id`,`username`,`nickname`,`password`,`avatar`,`salt`,`email`,`profile`,`counts`,`created`,`updated`) values (1,'admin','超级管理员','9401b8c7297832c567ae922cc596a4dd','','28b206548469ce62182048fd9cf91760','webmaster@example.com','',113,0,1348395537),(2,'demo','演示','2e5c7db760a33498023813489cfadc0b','','28b206548469ce62182048fd9cf91760','jijianqoap2011@qq.com',NULL,1,0,1384006932),(3,'jason','小纪','34fe874d40dc8f86c11696e78a380ccd','','jijianqiao','446505626',NULL,0,0,0),(4,'jason1','jason','34fe874d40dc8f86c11696e78a380ccd','','jijianqiao','44@qq.com',NULL,0,1387336100,0),(5,'jason2','小纪2','34fe874d40dc8f86c11696e78a380ccd','','jijianqiao','444@qq.com',NULL,0,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
