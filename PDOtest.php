<?php
$dsn  =  'mysql:dbname=test;host=127.0.0.1' ;
$user  =  'root' ;
$password  =  '' ;

try {
	$dbh  = new  PDO ( $dsn ,  $user ,  $password );
} catch ( PDOException $e ) {
	echo  'Connection failed: '  .  $e -> getMessage ();
}

$sql = 'select * from mytest';
// $insert = 'insert into mytest(`id`,`name`) values(2,2)';
// PDO::exec() 不会从一条 SELECT 语句中返回结果 可以处理插入和删除返回的影响的行数
// $count = $dbh->exec($insert);
echo "执行了{$count}记录\n";
$arr =  $dbh->query($sql);
// print_r( $arr );
// echo $arr;
foreach ( $arr as $v ){
	echo $v['id']." ".$v['name']." ";
}

?>