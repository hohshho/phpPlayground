<?php
$read_file = explode("\n", file_get_contents("./hoseo_group_list.txt"));



foreach($read_file as $line){
	$splitLine = explode ("|", $line);
	$line_parent_code = trim($splitLine[3]);
	$sort_order = trim($splitLine[4]);
	$line_department_name = trim($splitLine[1]);
	$line_department_code = trim($splitLine[0]);
	
	$arr[$line_parent_code][]=[ 
		"sort_order" => $sort_order, 
		"line_department_name" => $line_department_name, 
		"line_department_code" => $line_department_code
   	];
//	foreach( $arr[$line_parent_code] as $key => $value ) {
//		$sort[$key] = $value['sort_order'];
//	}
	$sort = array_column($arr[$line_parent_code],'sort_order');
	array_multisort($sort, SORT_ASC, $arr[$line_parent_code]);
}


print_r($arr);
