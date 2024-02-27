<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/* 后台设置 */
function themeConfig($form) {
	 $db = Typecho_Db::get();
	//版本检查
	$version=file_get_contents('https://www.tongleer.com/api/interface/tongleer.php?action=update&version=10');
	echo '<small>感谢使用 WeiboForTypecho 主题，版本检查：'.$version.'</small>';
	
	$is_pjax = new Typecho_Widget_Helper_Form_Element_Radio('is_pjax', array(
		'y'=>_t('启用'),
		'n'=>_t('禁用')
	), 'n', _t('PJAX无刷新加载'),_t('开启后网页中非新窗口打开非登录非评论的跳转将变为无刷新跳转，适合与播放器共同使用，已支持pjax评论，<font color=red>但不支持多次评论</font>，可间断评论。开启后如果看不见评论这是因为后台设置开启了反垃圾保护，去掉勾即可。'));
	$form->addInput($is_pjax->addRule('enum', _t(''), array('y', 'n')));
	
	$is_play = new Typecho_Widget_Helper_Form_Element_Radio('is_play', array(
		'y'=>_t('启用'),
		'n'=>_t('禁用')
	), 'n', _t('音乐播放器'), _t('开启后网页左下角会出现音乐播放器，适合和PJAX无刷新加载共同使用。'));
	$form->addInput($is_play->addRule('enum', _t(''), array('y', 'n')));
	
	$is_ajax_page = new Typecho_Widget_Helper_Form_Element_Radio('is_ajax_page', array(
		'y'=>_t('启用'),
		'n'=>_t('禁用')
	), 'n', _t('AJAX分页加载'), _t('开启后文章分页链接会变成无限自动加载的形式，可选择开启，<font color=red>目前开启后与图片放大不兼容。</font>'));
	$form->addInput($is_ajax_page->addRule('enum', _t(''), array('y', 'n')));
	
	$is_play_auto = new Typecho_Widget_Helper_Form_Element_Radio('is_play_auto', array(
		'true'=>_t('自动'),
		'false'=>_t('手动')
	), 'false', _t('是否自动播放'), _t('开启后将自动播放音乐。'));
	$form->addInput($is_play_auto->addRule('enum', _t(''), array('true', 'false')));
	
	$is_play_defaultMode = new Typecho_Widget_Helper_Form_Element_Radio('is_play_defaultMode', array(
		'1'=>_t('列表循环'),
		'2'=>_t('随机播放'),
		'3'=>_t('单曲循环')
	), '2', _t('播放模式'), _t('选择一种播放音乐的模式'));
	$form->addInput($is_play_defaultMode->addRule('enum', _t(''), array('1', '2', '3')));
	
	$query= $db->select('value')->from('table.options')->where('name = ?', 'siteUrl'); 
	$row = $db->fetchRow($query);
	
	$playjsonvalue='
		[{
			"title":"花下舞剑",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/49/7/2753401394.jpg",
			"src":"http://other.web.rf01.sycdn.kuwo.cn/resource/n1/84/87/3802376964.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-huaxiawujian.lrc"
		},{
			"title":"萌二代",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/35/65/238194684.jpg",
			"src":"http://other.web.rg01.sycdn.kuwo.cn/resource/n3/21/49/2096701565.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-mengerdai.lrc"
		},{
			"title":"吃货进行曲",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/26/34/1695727344.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n3/15/72/1780780959.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-chihuojinxingqu.lrc"
		},{
			"title":"小秘密",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/55/73/500614479.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n1/74/68/3330561514.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-xiaomimi.lrc"
		},{
			"title":"听你爱听的歌",
			"singer":"童可可",
			"cover":"https://img1.kuwo.cn/star/starheads/240/16/85/44330486.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n2/80/39/46671518.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-tingniaitingdege.lrc"
		},{
			"title":"别让我放不下",
			"singer":"童可可",
			"cover":"https://img1.kuwo.cn/star/albumcover/240/9/59/996272309.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n1/15/60/2541949312.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-bierangwofangbuxia.lrc"
		},{
			"title":"非主恋",
			"singer":"童可可",
			"cover":"https://img4.kuwo.cn/star/albumcover/240/21/10/339989310.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n2/34/93/1218459911.mp3",
			"lyric":"'.$row["value"].'/usr/themes/tongleer/assets/smusic/data/tongkeke-feizhulian.lrc"
		}]
	';
	$playjson = new Typecho_Widget_Helper_Form_Element_Textarea('playjson', array("value"), $playjsonvalue, _t('播放器音乐数据'), _t('自定义歌单需要至少2首，可到<a href="http://api.tongleer.com/music/" target="_blank">http://api.tongleer.com/music/</a>下载歌曲，专辑图片网络有现成的就用现成的，没有就上传微博图床后设置到此处，歌词文件一般酷狗、酷我等软件即可生成。'));
	$form->addInput($playjson);
	
	$othernavvalue='
		[{
			"name":"文章 RSS",
			"icon":"home",
			"link":"'.$row["value"].'/feed"
		},{
			"name":"评论 RSS",
			"icon":"home",
			"link":"'.$row["value"].'/feed/comments/"
		}]
	';
	$othernav = new Typecho_Widget_Helper_Form_Element_Textarea('othernav', array("value"), $othernavvalue, _t('顶部导航链接'), _t('此处可以随意添加链接到导航栏中，name=链接名，icon=图标（http://amazeui.org/css/icon），link=链接地址。'));
	$form->addInput($othernav);
	
	$favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', array('value'), 'https://wx3.sinaimg.cn/large/ecabade5ly1fxqhk08iedj200s00s744.jpg', _t('自定义favicon图标'), _t('在这里填入自定义favicon图标url'));
    $form->addInput($favicon);
	
	$pagebg = new Typecho_Widget_Helper_Form_Element_Text('pagebg', array('value'), '', _t('网页背景图片'), _t('在这里填入网页背景图片url'));
    $form->addInput($pagebg);
	
	$headBg = new Typecho_Widget_Helper_Form_Element_Text('headBg', array('value'), 'https://wx3.sinaimg.cn/large/ecabade5ly1fxqhgnclydj21hc0u0wn1.jpg', _t('资料卡背景图片'), _t('在这里填入资料卡背景图片url'));
    $form->addInput($headBg);
	
	$headImgUrl = new Typecho_Widget_Helper_Form_Element_Text('headImgUrl', array('value'), 'https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg', _t('头像地址'), _t('在这里填入头像的URL地址，它会显示在你的头部资料卡和每条微博前'));
    $form->addInput($headImgUrl);
	
	$nickname = new Typecho_Widget_Helper_Form_Element_Text('nickname', array('value'), '快乐贰呆', _t('昵称'), _t('在这里填入微博昵称，它会显示在你的头部资料卡，如：快乐贰呆'));
    $form->addInput($nickname);
	
	$sex = new Typecho_Widget_Helper_Form_Element_Radio('sex', array(
		'boy'=>_t('男'),
		'girl'=>_t('女')
	), 'girl', _t('性别'), _t('显示在昵称右侧'));
	$form->addInput($sex->addRule('enum', _t(''), array('boy', 'girl')));
	
	$follow_qrcode = new Typecho_Widget_Helper_Form_Element_Text('follow_qrcode', array('value'), 'https://wx3.sinaimg.cn/large/ecabade5ly1fxqhkxs6qbj203w03wt8m.jpg', _t('关注二维码'), _t('在这里填入头部资料卡关注的二维码图片地址'));
    $form->addInput($follow_qrcode);
	
	$home_name = new Typecho_Widget_Helper_Form_Element_Text('home_name', array('value'), '主页', _t('主页名称'), _t('在这里填入头部资料卡关注右侧按钮的名称，如：主页'));
    $form->addInput($home_name);
	
	$home_link = new Typecho_Widget_Helper_Form_Element_Text('home_link', array('value'), $row["value"], _t('主页链接'), _t('在这里填入头部资料卡关注右侧按钮的链接'));
    $form->addInput($home_link);
	
	$album_name = new Typecho_Widget_Helper_Form_Element_Text('album_name', array('value'), '相册', _t('相册名称'), _t('在这里填入自定义相册页面的名称，如：相册，模板page_album.php即为相册模板，只需建立独立页面即可。'));
    $form->addInput($album_name);
	
	$album_link = new Typecho_Widget_Helper_Form_Element_Text('album_link', array('value'), 'javascript:;', _t('相册链接'), _t('在这里填入自定义相册页面的链接，模板page_album.php即为相册模板，只需建立独立页面即可。'));
    $form->addInput($album_link);
	
	$other_1_name = new Typecho_Widget_Helper_Form_Element_Text('other_1_name', array('value'), '同乐儿', _t('资料卡更多下第一行名称'), _t('在这里填入头部资料卡更多按钮第一行的名称'));
    $form->addInput($other_1_name);
	
	$other_1_link = new Typecho_Widget_Helper_Form_Element_Text('other_1_link', array('value'), 'http://www.tongleer.com', _t('资料卡更多下第一行名称的链接'), _t('在这里填入头部资料卡更多按钮第一行的名称的链接'));
    $form->addInput($other_1_link);
	
	$weiboname = new Typecho_Widget_Helper_Form_Element_Text('weiboname', array('value'), '同乐儿', _t('微博认证资料名称'), _t('在这里填入微博认证资料名称'));
    $form->addInput($weiboname);
	
	$address = new Typecho_Widget_Helper_Form_Element_Text('address', array('value'), '北京 朝阳区', _t('地区'), _t('在这里填入地区'));
    $form->addInput($address);
	
	$birthday = new Typecho_Widget_Helper_Form_Element_Text('birthday', array('value'), '2018年7月1日', _t('生日'), _t('在这里填入生日'));
    $form->addInput($birthday);
	
	$detail = new Typecho_Widget_Helper_Form_Element_Text('detail', array('value'), '工作联系 ：diamond@tongleer.com 微信：Diamond0419', _t('简介'), _t('在这里填入简介'));
    $form->addInput($detail);
	
	$about = new Typecho_Widget_Helper_Form_Element_Text('about', array('value'), '', _t('更多资料'), _t('在这里填入以更多资料为模板的新建页面的链接'));
    $form->addInput($about);
	
	$friendlinkvalue='
		[{
			"name":"百度",
			"link":"https://www.baidu.com",
			"target":"_blank",
			"rel":"nofollow friend",
			"detail":"百度一下，你就知道",
			"icon":"229***8477",
			"order":"1"
		},{
			"name":"",
			"link":"https://www.baidu.com",
			"target":"_blank",
			"rel":"nofollow friend",
			"detail":"百度一下，你就知道",
			"icon":"https://wx3.sinaimg.cn/large/ecabade5ly1fxqhk08iedj200s00s744.jpg",
			"order":"2"
		}]
	';
	$friendlink = new Typecho_Widget_Helper_Form_Element_Textarea('friendlink', array("value"), $friendlinkvalue, _t('友情链接'), _t('此处可以随意添加链接到导航栏的下拉菜单中，name=链接名，link=链接地址，target=打开方式，rel=链接关系，detail=链接描述，icon=链接图标，order=链接排序。注：target包括_blank、_self、_parent、_top；rel可以指定任意关系名称；icon可以是一个QQ号，也可以是链接图标的地址，如果是QQ号，那么既包含QQ链接也包含QQ头像；order的排序规则是越大越靠前。'));
	$form->addInput($friendlink);
	
	$foot_count = new Typecho_Widget_Helper_Form_Element_Textarea('foot_count', array('value'), '', _t('统计代码'), _t('在这里填入统计代码'));
    $form->addInput($foot_count);
}
/*输出友情链接*/
function printFriends($link){
	?>
	<style>
	.friendlink{margin:0 auto;width:calc(100% - 100px);}
	@media screen and (max-width:calc(100% - 100px);) {
		.friendlink{width: calc(100% - 100px);}
	}
	</style>
	<?php
	$friendlink=json_decode($link,true);
	if(isset($friendlink)){
		$friendlinks='<div class="friendlink"><marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="10" loop="-1" onMouseOver="this.stop()" onMouseOut="this.start()" width="100%" height="30" style="text-align:center;">友情链接：';
		array_multisort(array_column($friendlink, 'order'), SORT_DESC, $friendlink);
		$isHaveLink=false;
		foreach($friendlink as $value){
			if($value["name"]!=null&&$value["link"]!=null){
				$isHaveLink=true;
				$icon=$value["icon"]!=""?$value["icon"]:"0";
				$iconlink=is_numeric($icon)?'https://wpa.qq.com/msgrd?v=3&uin='.$icon.'&site=qq&menu=yes':$value["link"];
				$iconimg=is_numeric($icon)?'https://q1.qlogo.cn/g?b=qq&nk='.$icon.'&s=100':$icon;
				$friendlinks.='<a href=javascript:open("'.$iconlink.'");><img src="'.$iconimg.'" width="16" /></a><a href="'.$value["link"].'" target="'.$value["target"].'" title="'.$value["detail"].'" rel="'.$value["rel"].'">'.$value["name"].'</a>&nbsp;';
			}
		}
		$friendlinks.='</marquee></div>';
		if(!$isHaveLink){
			$friendlinks='';
		}
		echo $friendlinks;
	}
}
/*调用热门文章*/
function getHotCommentsArticle($limit = 10){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($limit)
        ->order('commentsNum', Typecho_Db::SORT_DESC)
    );
    if($result){
		echo '
			<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
				<div class="am-list-news-bd">
					<ul class="am-list">
		';
        foreach($result as $val){            
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
			$match_str = "/((http)+.*?((.gif)|(.jpg)|(.bmp)|(.png)|(.GIF)|(.JPG)|(.PNG)|(.BMP)))/";
			preg_match_all ($match_str,$val['text'],$matches,PREG_PATTERN_ORDER);
			$img="";
			$width=12;
			if(count($matches[1])>0){
				$width=8;
				$img='<div class="am-u-sm-4 am-list-thumb"><img src="'.$matches[1][0].'" /></div>';
			}
            echo '<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">'.$img.'<a href="'.$permalink.'" title="'.$post_title.'"><div class=" am-u-sm-'.$width.' am-list-main"><small style="word-wrap:break-word;">'.$post_title.'</small></div>'.'</a></li>';        
        }
		echo '
				</ul>
			</div>
		</div>
		';
    }
}
/**
 * 截取编码为utf8的字符串
 *
 * @param string $strings 预处理字符串
 * @param int $start 开始处 eg:0
 * @param int $length 截取长度
 */
function subString($strings, $start, $length) {
	if (function_exists('mb_substr') && function_exists('mb_strlen')) {
		$sub_str = mb_substr($strings, $start, $length, 'utf8');
		return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
	}
	$str = substr($strings, $start, $length);
	$char = 0;
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) >= 128)
			$char++;
	}
	$str2 = substr($strings, $start, $length + 1);
	$str3 = substr($strings, $start, $length + 2);
	if ($char % 3 == 1) {
		if ($length <= strlen($strings)) {
			$str3 = $str3 .= '...';
		}
		return $str3;
	}
	if ($char % 3 == 2) {
		if ($length <= strlen($strings)) {
			$str2 = $str2 .= '...';
		}
		return $str2;
	}
	if ($char % 3 == 0) {
		if ($length <= strlen($strings)) {
			$str = $str .= '...';
		}
		return $str;
	}
}
/*获得当前页面url*/
function curPageURL(){
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	}else{
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
/**
 * 解析内容以实现附件加速
 * @access public
 * @param string $content 文章正文
 * @param Widget_Abstract_Contents $obj
 */
function parseContent($obj) {
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->src_add) && !empty($options->cdn_add)) {
        $obj->content = str_ireplace($options->src_add, $options->cdn_add, $obj->content);
    }
    echo trim($obj->content);
}
/*缩略图调用*/
function showThumb($obj){
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = array();
    if(count($matches[1])<9&&count($matches[1])!=0){
        array_push($thumb,$matches[1][0]);//文章内容中抓到了图片 输出链接
    }else if(count($matches[1])>=9){
		array_push($thumb,$matches[1][0]);
		array_push($thumb,$matches[1][1]);
		array_push($thumb,$matches[1][2]);
		array_push($thumb,$matches[1][3]);
		array_push($thumb,$matches[1][4]);
		array_push($thumb,$matches[1][5]);
		array_push($thumb,$matches[1][6]);
		array_push($thumb,$matches[1][7]);
		array_push($thumb,$matches[1][8]);
	}
    return $thumb;
}
/*文章阅读次数统计*/
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}
/**
 * 判断是否通过手机访问
 */
function isMobile(){ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])){ 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array ('nokia',
            'sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod',
            'blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])){ 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
            return true;
        } 
    } 
    return false;
}
/*获取配置文件 已废弃*/
function getThemeConfig($ini, $type="string"){ 
	$file=dirname(__FILE__).'/config.php';
	if(!file_exists($file)) return false; 
	$str = file_get_contents($file); 
	if ($type=="int"){ 
		$config = preg_match("/".preg_quote($ini)."=(.*);/", $str, $res); 
		return $res[1]; 
	}else{ 
		$config = preg_match("/".preg_quote($ini)."=\"(.*)\";/", $str, $res); 
		if(!isset($res[1])){ 
		$config = preg_match("/".preg_quote($ini)."='(.*)';/", $str, $res); 
		} 
		if(isset($res[1])){
			return $res[1]; 
		}else{
			return false; 
		}
	} 
}
/*更新配置文件 已废弃*/
function updateThemeConfig($ini, $value,$type="string"){ 
	$file=dirname(__FILE__).'/config.php';
	$str = file_get_contents($file); 
	$str2=""; 
	if($type=="int"){ 
		$str2 = preg_replace('/' . $ini . "=(.*);/", $ini . '=' . $value . ';', $str); 
	}else{ 
		$str2 = preg_replace('/' . $ini . "=(.*);/", $ini . '=\'' . $value . '\';',$str); 
	} 
	file_put_contents($file, $str2);
}
?>
