<?php
strlen ( $P [0] ) < 1 && $P [0] = 'index';
define ( 'ACTION', $P [0] );

switch (ACTION) {
	case 'login' :
		if ($U ['id'] > 0) {
			yun_msg ( 'warning', '您已经登陆','f' );
		}
		break;
	case 'reg' :
		if ($U ['id'] > 1) {
			yun_msg ( 'warning', '请先退出' );
		}
		break;
	case 'logout' :
	case 'show' :
	case 'yz' :
	case 'pass' :
		break;
	default :
		if ($U ['id'] < 1) {
			yun_msg ( 'warning', '请先登陆', url ( R . 'user/login/' ) );
		}
}

define ( 'RMA', RM . ACTION . '/' );
set_val ( 'theme_file', 'user.php' );
