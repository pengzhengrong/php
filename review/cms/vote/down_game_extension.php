<?php
/**
 * 
 * 自动下线脚本 如果游戏推广的时间已经过期，那么就自动的下线
 * 
 */
set_time_limit(0);
include( dirname( dirname(__FILE__) ) . '/config.inc.php' );
include(__SYS_LIB_PATH__.'XINHUA.class.php');

$time = strtotime( date('Y-m-d') ) - 24*3600;
$now = time();
$sql = "update `cms`.`game_extension` set `status`=2,`update_time`=$now where `status`=1 and endtime<=$time";
XINHUA::mysql('w','cms')->query( $sql );

?>