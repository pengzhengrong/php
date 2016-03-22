<?php

/**
 * 接口
 * 接口的好处，在于松耦合。
 * 如果使用的是接口，那么传递的对象可以是以接口的形式传递
 * @author pzr
 */
interface IDector{
	public function handle( $param ) ;
}

/**
 * 抽象类
 * 对统一对象的抽象，把公共的属性抽象出来
 * 子类继承的时候，可以扩展自己的属性
 * 此处的$instance 是指的接口IDector,这样就用到了接口传递的好处了。
 * 任何对象的属性，都可以使用注入(getter setter)的方式传递。
 */
abstract class abs_dector implements IDector{
	public $instance;
	public function __construct( $instance){
		$this->instance = $instance;
	}
}

/**
 * 被装饰者的本体，最基本的内容
 * 可以通过各种封装而丰富对象
 */
class body implements IDector{
	public function handle($param) {
// 		echo $param;
		return $param;
	}
}
/**
 * 继承抽象类abs_dector
 * 那么也继承了抽象类的各种属性
 * @author pzr
 *
 */
class html extends abs_dector{
	public function __construct($instance) {
		parent::__construct( $instance );
	}
	
	/**
	 * 实现接口的方法
	 * $this->instance 指的父类的初始化的对象
	 */
	public function handle( $param ) {
		$content = $this->instance->handle( $param );
		$html = '  <html >'.$content.'</html >   ';
		return $this->removeNbsp( $html );
	}
	
	/**
	 * 当然，继承父类的好处，在于能够扩展子类
	 * 而且，可以按照个性化扩展
	 * @param unknown $param
	 */
	public function removeNbsp( $param ) {
		return trim($param);
	}
	
}
/**
 * 把body 作为处理参数
 * 那么如果不使用抽象类实现呢？
 * @var unknown
 */
$html = new html( new body() );
echo $html->handle( 'body' );

?>