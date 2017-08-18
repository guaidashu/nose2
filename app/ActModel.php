<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActModel extends Model
{
	protected $connection = 'mysql_center';
    protected $table = "ip";
    //关闭自动维护时间戳(不关闭的话会自动加上数据的时间，维护时间戳)
	public $timestamps=false;
}