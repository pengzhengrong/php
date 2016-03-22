<?php

class singleton{
	
	private static $instance = null;
	
	private function __construct(){
		echo "init";
	}
	
	public static function getInstance(){
		if( self::$instance == null ){
			self::$instance = new singleton();
		}
		return self::$instance;
	}
	
	public  function test(){
		echo '   test';
	} 
	
	public static  function test2(){
		echo '   test';
	}
	
}

/*
 * 很明显的区分了 $this 和 self 的用法 
 * self 主要用来调用 静态属性 和 静态方法
 * $this 代表的是未实例化之前的对象本身
 * 
 * 这里使用$this 不合适
 */
/* class singleton2{
	private $instance = null;
	
	private function __construct(){}
	
	public static function getInstance(){
		
		if( $this->instance == null ){
			$this->instance = new singleton2();
		}
		return $this->instance;
		
	}
	
	public function test(){
		echo 'test';
	}
	
} */


class singleton3{
	//不能用new初始化对象  java中是可以的
	private   $instance =  null;
	
	private function __construct(){}
	
	public static function getInstance(){
		return self::$instance;
	}
	
	public static function test(){
		echo 'test';
	}
	
	public  function test2(){
		echo 'test';
	}
	
}


$single = singleton3::getInstance();
// $single2 = singleton::getInstance();
// echo $single==$single2;  //1
// echo $single===$single2; //1
$single->test();
// singleton::test2();

?>