<?php
//通用函数文件
//默认引入代码在bootstrap文件夹下的autoload.php里

//输出测试函数 ，便于查看
//第一个参数为传入的数据，第二个为是否终止(exit)(默认为否fasle)
function debug($arr, $exit=false)
{
	echo "<pre>";
	if(is_array($arr)||is_object($arr)){
		var_dump($arr);
	}else if(empty($arr)){
		echo "NULL";
	}else{
		echo $arr;
	}
	echo "<pre/>";
	echo "<hr />";
	if($exit){
		exit;
	}
}