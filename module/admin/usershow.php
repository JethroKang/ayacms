<?php
$id=(int)$_GET['id'];
$u=get_user($id);

if($u['id']<1) yun_error('用户不存在');

