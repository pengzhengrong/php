<?php

/**
 * 代理接口
 * @author pzr
 */
interface IProxy{
	public function handle();
}
/**
 * 主题  实际需要实例化的对象
 * @author pzr
 */
class subject implements IProxy{
	
	public function __construct(){
		// 模拟实例化的速度很慢
		sleep(3);
	}
	
	public function handle(){
		return "\n真实主题,启动至少需要等待1s";
	} 
}

/**
 * 代理真实主题的方法
 * 代理类 也实现了代理的接口 那么实现起来和真实主题的区别在于？
 * 如果真实主题内可能还需要实例化其他的对象，而且很慢，那么代理的作用就显而易见了。
 * 用处：在主题对象实例化费时间的时候，可以先考虑代理。
 * 既然实例化太久，需要使用代理，那么在不需要初始化对象的时候，就可以避免了啊？那么还需要代理干嘛
 * @author pzr
 */
class proxySubject implements IProxy{
	
	public $real = null;
	
	public function handle() {
		if( $this->real == null ){
			$this->real = new subject();	
		}
		return $this->real;
	}
	
	public function test(){
		echo "\n这是代理类,直接使用代理的时候，可能是并不需要主题的一些方法实现。";
	}
}

$proxy = new proxySubject();
$proxy->test();
// echo $proxy->handle()->handle();
echo "\n------------------------------------";
//主题方法可以在用的时候在实例化啊，不用的时候我也没必要实例化。那么代理作用何在？
// $sub = new subject();
// echo $sub->handle();




?>