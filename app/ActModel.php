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
		  $this->dblink=mysqli_connect($this->dbLocalhost,$this->dbUser,$this->dbPassword) or die("connect false");
		  mysqli_select_db($this->dblink,$this->dbDatabase);
		  mysqli_query($this->dblink,"set names utf8");
	  }

	  public function dbresult($q){//获取执行语句并执行
		  $this->result=mysqli_query($this->dblink,$q);
		  return $this->result;
	  }

	  public function dbrow($result){//获取数据库里面内容的值
		  $this->row=mysqli_fetch_assoc($result);
		  return $this->row;
	  }

	  public function dbrow_num($result){
		  $this->row_num=mysqli_num_rows($result);
		  return $this->row_num;
	  }

	  public function dbclose(){//关闭数据库
		  mysqli_close($this->dblink);
	  }

	  public function dbfree($result){
		  mysqli_free_result($result);
	  }

	  public function dbGetId(){
	  	  $data=mysqli_insert_id($this->dblink);
	  	  return $data;
	  }
}