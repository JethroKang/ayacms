<?php

if(admin::upcache()){
	yun_error('更新成功');
}else{
	yun_error('更新失败');
}
?>