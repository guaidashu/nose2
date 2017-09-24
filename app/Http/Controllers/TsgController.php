<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class TsgController extends Controller
{
	public function __construct()
	{
		session_start();
	}

	public function scarchsend(){
		$ReaderLogin = curl_init('http://lib.suse.edu.cn:82/CombinationScarch.aspx');
		curl_setopt($ReaderLogin,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ReaderLogin,CURLOPT_NOBODY, 0);
		$ReaderLoginres=curl_exec($ReaderLogin);
		if (curl_errno($ReaderLogin)) {
		return false;
		}
		curl_close($ReaderLogin);
		$pattern = '/<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" \/>/is';
		preg_match($pattern, $ReaderLoginres, $matches);
		$viewstate = $matches[1];
		$pattern = '/<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" \/>/is';
		preg_match($pattern, $ReaderLoginres, $matches);
		$eventvalidation = $matches[1];

		//正式登陆
		$post['ScriptManager1']='UpdatePanel1|ImageButton1';
		$post['__EVENTTARGET']='';
		$post['__EVENTARGUMENT']='';
		$post['__LASTFOCUS']='';
		$post['__VIEWSTATE']=$viewstate;
		$post['__EVENTVALIDATION']=$eventvalidation;
		$post['DropScarchKay1']='馆藏书目库';
		$post['txtKay1']=input('post.content');
		$post['Drop1']='中间一致';
		$post['DropTJ1']='并且';
		$post['DropScarchKay2']='检索责任者库';
		$post['txtKay2']='';
		$post['Drop2']='中间一致';
		$post['DropTJ2']='并且';
		$post['DropScarchKay3']='馆藏典藏库';
		$post['txtKay3']='';
		$post['Drop3']='中间一致';
		$post['DropDB']='1';
		$post['DropSort']='入藏日期';
		$post['DropLanguage']='不限';
		$post['RadioButtonList1']='正序';
		$post['hidtext1']='题名';
		$post['hidValue1']='馆藏书目库';
		$post['hidtext2']='责任者';
		$post['hidValue2']='检索责任者库';
		$post['hidtext3']='馆藏地址';
		$post['hidValue3']='馆藏典藏库';
		//$post['__ASYNCPOST']='true';
		$post['ImageButton1.x']='30';
		$post['ImageButton1.y']='26';


		$ch = curl_init('http://lib.suse.edu.cn:82/CombinationScarch.aspx');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $post); 
		$content = curl_exec($ch);
		curl_close($ch);

		if(stripos($content,'here') or stripos($content,'ScarchList')){
		$Cookie=substr(strstr($content,'Set-Cookie'),12,42);
		session('scarchcookie',$Cookie);

		$content=curl_request('http://lib.suse.edu.cn:82/ScarchList.aspx',$Cookie,'',false);

		if (stripos($content,'没有检索到任何图书')) {
		  $res['status']=1;
		  $res['pages']=0;
		}else{
		  //概况
		  preg_match_all('/<span id="LblpageInfor"[\w\W]*?>([\w\W]*?)<\/span>/', $content, $gkmatches);
		  $gk = $this->trimall($gkmatches[1][0]);
		  preg_match_all('/<span id="LblPage" style="display:inline-block;width:100%;">共([\w\W]*?)页/', $content, $gkmatches);
		  $pages= $this->trimall($gkmatches[1][0]);

		  $res['status']=1;
		  $res['gk']=$gk;
		  $res['pages']=$pages;
		  $res['scarchcookie']=$Cookie;
		}
		}else{
		$res['status']=0;
		}
		return json($res);
	}


	public function scarchList(){
		$pages=input('post.pages');
		$cookie=input('?post.scarchcookie') ? input('post.scarchcookie') : session('scarchcookie');
		$content=curl_request('http://lib.suse.edu.cn:82/ScarchList.aspx?Page='.$pages,$cookie,'',false);
		preg_match_all('/<table width="100%" border="0">([\w\W]*?)<\/table>/',$content,$matches);
		if (count($matches)<=0) {
		$res['status']=0;
		return json($res);
		exit;
		}
		$table=array();
		foreach ($matches[1] as $key => $value) {
		if ($key<10) {
		  $num='0'.$key;
		}else{
		  $num=$key;
		}
		//书名
		preg_match('/<span id="Repeater1_ctl'.$num.'_LabeBookName">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['sm']=$this->gctstrimall($matchesres[1]);
		//
		preg_match('/<span id="Repeater1_ctl'.$num.'_lblcaono">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['ssh']=str_replace("图书馆:","",$this->gctstrimall($matchesres[1]));
		//出版社
		preg_match('/<span id="Repeater1_ctl'.$num.'_Label1">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['cbs']=$this->gctstrimall($matchesres[1]);
		//年份
		preg_match('/<span id="Repeater1_ctl'.$num.'_Label3">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['nf']=$this->gctstrimall($matchesres[1]);
		//简介
		preg_match('/<span id="Repeater1_ctl'.$num.'_Lbelinfor">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['jj']=$this->gctstrimall($matchesres[1]);
		//作者
		preg_match('/<span id="Repeater1_ctl'.$num.'_LblZrz">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['zz']=$this->gctstrimall($matchesres[1]);
		//可借数量
		preg_match('/<span id="Repeater1_ctl'.$num.'_LblCanBorroyCount">([\w\W]*?)<\/span>/',$value,$matchesres);
		$table[$key]['sl']=$this->gctstrimall($matchesres[1]);
		}
		$res['status']=1;
		$res['data']=$table;
		return json($res);
	}

	private function get_td_array($table) { 
		$pattern = '/<table[\w\W]*?>([\w\W]*?)<\/table>/';
		preg_match($pattern, $table, $matches);
		$table = $matches[1];
		//去掉空白字符      
		$table = preg_replace("'([rn])[s]+'","",$table);
		$table = str_replace(" ","",$table);
		$table = str_replace("\t","",$table);
		$table = str_replace("\n","",$table);
		$table = str_replace("\r","",$table);
		$table = str_replace("\r\n","",$table);
		//进行分隔定位
		$table = str_replace("</tr><tr><td>","{tr}",$table);
		$table = str_replace("</tr><tr>","{tr}",$table);
		$table = str_replace("</td><td>","{td}",$table); 
		$table = str_replace("</tr>","{tr}",$table);    
		$table = str_replace("</td>","{td}",$table);     
		//打撒为数组
		$table = explode('{tr}', $table);
		//删除顶部表头
		array_shift($table);
		//删除底部不知道为什么产生的空白数组
		array_pop($table);
		foreach ($table as $key=>$tr) {    
		    $td = explode('{td}', $tr);    
		    array_pop($td);
		    $td_array[] = $td;     
		}    
		return $td_array;    
	}
	//删除空格
	private function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    $hou=array("","","","","");
	    return str_replace($qian,$hou,$str);    
	}

	//馆藏图书查询专用
    private function gctstrimall($str){
        $str=strip_tags($str);
        $qian=array(" ","　","\t","\n","\r","&nbsp;","&nbsp","[点击查看详细信息]");
        $hou=array("","","","","");
        return str_replace($qian,$hou,$str);    
    }
}