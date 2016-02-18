<?php

$ltemp = 10 ; //list的个数
$otemp = 3; //other的个数
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
$pos = array(4,5,10,15,20);

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
	$ad[] = array(
		'newid' => $i,
		'content' => 'AD'.$i,
		'rank' => $pos[$i]
	);
}

// print_r( $ad );
// print_r( $other );
// print_r( $list );

$otherCount = count( $other ) ;
$listCount= count( $list ) ;
$adCount = count( $ad ) ;
$adTemp = array();
$databack = array();

$otherArray = array();
$listArray = array();

$otherTemp = array();
$listTemp = array();

//判断广告位置插入other 或者 list
foreach ( $ad as $k => $v ){

	if( $otherCount > $v['rank'] ){
		$otherTemp[$v['rank'] -1] = $v ;
		++$otherCount;
	}else if( ( $listCount + $otherCount ) > $v['rank'] ){
		$listTemp[$v['rank'] -1] = $v;
		++ $listCount;
	}else{
		$adTemp[] = $v;
	}
}

// print_r( $otherTemp );
// print_r( $listTemp );
// print_r( $list );
//插入other
if( $otherCount > 0 ){

	$ai = 0;
	for( $i = 0; $i < $otherCount ; $i++){
		if( isset( $otherTemp[$i] )){
			$otherArray[] = $otherTemp[$i];
		}else{
			if( isset($other[$ai]) ){
				$otherArray[] = $other[$ai];
				++$ai  ;
			}
		}
	}
}


//插入list
if( $listCount > 0 ){

	$ai = 0;
	for( $i = 0; $i < $listCount ; $i++){
		if( isset( $listTemp[$i + $otherCount  ] )){
			$listArray[] = $listTemp[$i + $otherCount ];
		}else{
			if( isset($list[$ai]) ){
				$listArray[] = $list[$ai];
				$ai ++ ;
			}
		}
	}
}

if( $adTemp ){

	foreach ( $adTemp as $v ){
		if( $list ){
			$listArray[] = $v;
		}else{
			$otherArray[] = $v;
		}
	}
}

$databack['other'] = $otherArray;
$databack['list']= $listArray;
unset( $listTemp );
unset( $otherTemp );
unset( $otherArray );
unset( $listArray );
unset( $other );
unset( $list );

print_r( $databack );

return $databack;



?>