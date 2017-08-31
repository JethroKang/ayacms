<?php
strlen ( $P [0] ) < 1 && $P [0] = 'index';
define ( 'ACTION', $P [0] );
define ( 'RMA', RM . ACTION . '/' );

if (empty ( $BPV [2] ))
	yun_msg ( "warning", '权限不足' );

