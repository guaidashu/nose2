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

// 将内容转化为json变量并返回 ，参数content为主要内容，id为数据库操作返回id，用时可加
// reply为评论回复id ，用时可加，另外id和reply可酌情使用，看情况
function js_arr($content, $id=0, $reply=0)
{
	$arr=array(
		"text"=>$content,
		"id"=>$id,
		"reply"=>$reply
		);
	return json_encode($arr);
}

// 邮箱判断函数，检查是否为一个正确的邮箱
function emailCheck($email)
{
	$pattern="/^\S([a-zA-Z0-9]*)(@)\S([0-9a-z]*)(\.com)$/";
	if(!preg_match($pattern, $email)){
		return false;
	}else{
		return true;
	}
}

// 电话号码判断函数，检查是否是1开头的十一位电话号码，可酌情修改
function phoneCheck($phone)
{
	$pattern="/^1([0-9]){10}$/";
	if(!preg_match($pattern, $phone)){
		return false;
	}else{
		return true;
	}
}

// 判断入学年份 是否为一个四位的纯数字
function yearCheck($year)
{
	$pattern="/^([0-9]){4}$/";
	if(!preg_match($pattern, $year)){
		return false;
	}else{
		return true;
	}
}

// 判断是否为纯数字，在文章主键和其他一些传递的时候可以用来过滤，安全性更高
function numCheck($num)
{
	$pattern="/^([0-9]*)$/";
	if(!preg_match($pattern, $num)){
		return false;
	}else{
		return true;
	}
}