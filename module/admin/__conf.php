<?php

apply('mainmenu_title',array('index','首页','icon-home',url(R.'admin/')));
apply('mainmenu_title',array('general','基础','icon-cogs'));
apply('mainmenu_title',array('weihu','维护','icon-gift'));
apply('mainmenu_title',array('about','关于','icon-user',url(R.'admin/about/')));


apply('mainmenu_list',array('base','基本信息','general','admin'));
apply('mainmenu_list',array('jifen','积分设置','general','admin'));
apply('mainmenu_list',array('rank','等级控制','general','admin'));
apply('mainmenu_list',array('smtp','SMTP设置','general','admin'));
apply('mainmenu_list',array('zhucexieyi','注册协议内容','general','admin'));
apply('mainmenu_list',array('mimazhaohui','密码找回内容','general','admin'));
apply('mainmenu_list',array('zhuceyanzheng','注册验证内容','general','admin'));


apply('mainmenu_list',array('channel','栏目','weihu','admin'));
apply('mainmenu_list',array('theme','主题','weihu','admin'));
apply('mainmenu_list',array('tab','表单','weihu','admin'));
apply('mainmenu_list',array('module','模型','weihu','admin'));
apply('mainmenu_list',array('user','用户','weihu','admin'));
apply('mainmenu_list',array('team','用户组','weihu','admin'));
apply('mainmenu_list',array('sql','数据库','weihu','admin'));
apply('mainmenu_list',array('advanced','高级','weihu','admin'));



return array('name'=>'管理中心','ver'=>'2.0.0','author'=>'AyaXu','doc'=>'站点后台管理','build'=>'2014-4-20','pvs'=>array())?>