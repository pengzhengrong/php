<?php

$ltemp = 0 ; //list的个数
$otemp = 7; //other的个数
$adTemp = 5; //ad的个数
//广告插入位置控制,分别对应广告的个数
/*
 * itemp  otemp  adtemp  result    pos 2,5,10,15,18
 *   20   0  5  
  ok
 *    0   20 5   ok
 *    5   5   5   ok
 * itemp  otemp  adtemp  result    pos 1,5,10,15,20
 * 
 * 怎么优化？
 */
$pos = array(1,5,10,15,20);

$list = array();

for( $i = 0; $i < $ltemp ; $i++){
	$list[] = array(
		'newid' => $i,
		'content' => 'List'.$i
	);
} 

$other = array();
for( $i = 0; $i <$otemp ; $i++){
	$other[] = array(
		'newid' => $i,
		'content' => 'Other'.$i
	);
}

$ad = array();
for( $i = 0; $i < $adTemp; $i++){
// 	$pos = rand(0,20);
	$pos = $i * 2 + 5 ;
	$ad[] = array(
		'newid' => $i,
		'content' => 'AD'.$i,
		'position' => $pos[$i]
	);
}

// print_r( $ad );
// print_r( $other );
// print_r( $list );

$otherCount = count( $other ) ;
$listCount= count( $list ) ;
$adCount = count( $ad ) ; 
$posM = $ad[$adCount-1]['position'];
// $remainder = 0;
$adTemp = array();
$databack = array();

if( $otherCount > 0 ){

		if( ( $otherCount + $adCount ) >= $posM ){
			foreach ( $ad as $adK => $adV ){
				$temp = array();
				$temp[] = $adV;
				$position = $adV['position'] -1 ;
				array_splice( $other , $position , 0 ,  $temp );
				unset( $temp );
			}  
		//	print_r( $other );
		}else{
			foreach ( $ad as $adK => $adV ){
				if($otherCount  >= $adV['position']){
					echo "in the other \n";
					$temp = array();
					$temp[] = $adV;
					$position = $adV['position'] -1;
					array_splice( $other , $position , 0 ,  $temp );  
					unset( $temp );
					++$otherCount ;
				}else if( ( $otherCount + $listCount ) >= $adV['position'] ){
					$temp = array();
					$temp[] = $adV;
					$position = $adV['position'] - count( $other ) - 1;
					array_splice( $list , $position , 0 ,  $temp );
					unset( $temp );
					++$listCount ;
				}else if(  ( $otherCount + $listCount ) < $adV['position']  ){
					echo $adK ."in the ad \n";
					$adTemp = array_slice( $ad , $adK );
					break;
				}
		}
	//   print_r( $other );
	//   print_r( $list );
	//   print_r( $adTemp );
	}

}else{

//全部在list中找到下标
foreach ( $ad as $adK => $adV){

	if( $listCount >= $adV['position'] ){
		$temp = array();
		$temp[] = $adV;
		$position = $adV['position'] -1 ;
		array_splice( $list , $position , 0 ,  $temp );  
		unset( $temp );
		++ $listCount ;
	}else{
		$adTemp = array_slice( $ad , $adK );
		break;
	}

 
}
}


if($adTemp){
	$databack[] = $adTemp;
	//   print_r( $adTemp );
	if( $list ){
		array_splice( $list , count($list) , 0 ,  $adTemp );
	}else{
		array_splice( $other , count($other) , 0 ,  $adTemp );
	}
}
$databack['other'] = $other;
$databack['list'] = $list;
print_r( $databack );




/* $databack = array(

$list ,  
 
$other ,

$today 
);

$listN = count( $listN );
$otherN = count( $other );
$adCount = count( $ad ) ;
$posM = 0; //插入位置的下标
if( $otherN > 0  ){

//可以插入$other 列表中

if(  $adCount + $otherN >= 20 ){

//广告位置可以按照预先的设想插入位置

}else if(  $adCount + $otherN < 20 ){ //广告位可能部分插入$other 也可能部分插入$list ，取决于广告位的最大值 

//(1) 

if(  $adCount + $otherN >= $posM ){

//可以完全插入$other

}

//(2)

else{

// 可能部分插入$other,部分插入$list. 如果$list 为空，那么就无需插入$list

if( $listN == 0 ){

//多出的找不到下标的广告，忽视插入的位置，都插入到$other的后面。

}else{

//在$list列表中继续查询下标符合的位置插入即可

}

}

}
}else if(  $otherN ==0  ){ //$other 列表完全不存在，那么广告位只能插入$list中

//完全插入$list列表中

if( $listN + $adCount >= 20 ){

//可以完全按照预想设动的位置插入

}else{

if( $listN + $adCount >= $posM  ){ //如果最大的插入位置在列表下标内

//还是可以按照预想的位置插入

}else{

//多出的广告找不到下标的位置，忽视插入的位置，全部放在$list后面

}

}
} */


?>