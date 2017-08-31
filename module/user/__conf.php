<?php
apply ( 'user_menus', array (
		'show',
		'查看资料',
		R . 'user/show/' 
), 10 );
apply ( 'user_menus', array (
		'edit',
		'资料编辑',
		R . 'user/edit/' 
), 10 );
apply ( 'user_menus', array (
		'passedit',
		'密码修改',
		R . 'user/passedit/' 
), 10 );

return array (
		'name' => '用户中心',
		'ver' => '2.0.0',
		'author' => 'AyaXu',
		'doc' => '用户与管理',
		'build' => '2014-5-30' 
)?>