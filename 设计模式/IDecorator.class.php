<?php


interface  IDecorator{
	public function handle();
}


abstract class Decorator implements IDecorator{

	public $component;
	public function __construct( $component ){
		$this->component = $component;
	}

}

class decoratorBody implements IDecorator{
	public function handle( ) {
// 		echo 'base handle';
		return 'hello2world';
	}
}


class htmlBody extends Decorator{
	function __construct( $component ) {
		parent::__construct( $component );
	}
	
	public function handle(){
		echo 'html';
		echo $this->component->handle();
	}
	
}

$decorator = new htmlBody( new decoratorBody() );
$decorator->handle();

// $body = new decoratorBody();
// $body->handle();

?>