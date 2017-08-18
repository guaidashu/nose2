<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActModel extends Model
{
	var $dbLocalhost;
	  var $dbDatabase;
	  var $dbUser;
	  var $dbPassword;
	  var $dblink;
	  var $result;
	  var $row_num;
	  var $row;
	  public function dbconnect(){//链接数据库
		  $this->dblink=mysql_connect($this->dbLocalhost,$this->dbUser,$this->dbPassword) or die("connect false");
		  mysql_select_db($this->dbDatabase,$this->dblink);
		  mysql_query($this->dblink,"set names utf8");
	  }

	  public function dbresult($q){//获取执行语句并执行
		  $this->result=mysql_query($q);
		  return $this->result;
	  }

	  public function dbrow($result){//获取数据库里面内容的值
		  $this->row=mysql_fetch_assoc($result);
		  return $this->row;
	  }

	  public function dbrow_num($result){
		  $this->row_num=mysql_num_rows($result);
		  return $this->row_num;
	  }

	  public function dbclose(){//关闭数据库
		  mysql_close($this->dblink);
	  }

	  public function dbfree($result){
		  mysql_free_result($result);
	  }

	  public function dbGetId(){
	  	  $data=mysql_insert_id($this->dblink);
	  	  return $data;
	  }
}