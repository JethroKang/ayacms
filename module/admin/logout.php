<?php

$U['id']<1&&yun_msg('','已经退出');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
setcookie(PF.'yun_user','',-86400*365,ROOTPATH);
yun_msg('success','已经退出',url(R.'admin/login/'));
?>