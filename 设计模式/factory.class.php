<?php

/**
 * 工厂类
 */

class factory{
	
	
	static public function getInstance( $config ){
		if( $config['type'] == 'mysql'){
			return new mysql();
		}else{
			return new mysqli();
		}
	}
	
}