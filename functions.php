<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/* 后台设置 */
function themeConfig($form) {
	//版本检查
	$version=file_get_contents('http://api.tongleer.com/interface/tongleer.php?action=update&version=4');
	echo '<p style="font-size:14px;">
        <span style="display: block; margin-bottom: 10px; margin-top: 10px; font-size: 16px;">感谢使用 WeiboForTypecho 主题<br />版本检查：'.$version.'</span>';
    echo '</p>';
	
	$db= Typecho_Db::get();
	$userQuery= $db->select()->from('table.users');
	$userData = $db->fetchAll($userQuery);
	$config_totalUser=count($userData);
	if($config_totalUser){
		updateThemeConfig("config_totalUser",$config_totalUser,'int');
	}
	
	$config_nav = new Typecho_Widget_Helper_Form_Element_Text('config_nav', array('value'), '<li><a href=http://baidu.com target=_blank></a></li><li><a href=http://qq.com target=_blank></a></li>', _t('顶部导航链接'), _t("在这里填入需要添加的顶部导航链接代码，如：&lt;li&gt;&lt;a href=http://baidu.com target=_blank&gt;百度&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=http://qq.com target=_blank&gt;腾讯&lt;/a&gt;&lt;/li&gt;"));
    $form->addInput($config_nav);
	$config_nav = @isset($_POST['config_nav']) ? addslashes(trim($_POST['config_nav'])) : '';
	if($config_nav){
		updateThemeConfig("config_nav",$config_nav);
	}
	
	$config_favicon = new Typecho_Widget_Helper_Form_Element_Text('config_favicon', array('value'), 'http://www.tongleer.com/wp-content/themes/D8/img/favicon.png', _t('自定义favicon图标'), _t('在这里填入自定义favicon图标url'));
    $form->addInput($config_favicon);
	$config_favicon = @isset($_POST['config_favicon']) ? addslashes(trim($_POST['config_favicon'])) : '';
	if($config_favicon){
		updateThemeConfig("config_favicon",$config_favicon);
	}
	
	$config_bg = new Typecho_Widget_Helper_Form_Element_Text('config_bg', array('value'), '', _t('网页背景图片'), _t('在这里填入网页背景图片url'));
    $form->addInput($config_bg);
	
	$config_headBg = new Typecho_Widget_Helper_Form_Element_Text('config_headBg', array('value'), 'http://api.tongleer.com/picturebed/img/bg.jpg', _t('资料卡背景图片'), _t('在这里填入资料卡背景图片url，如：http://api.tongleer.com/picturebed/img/bg.jpg'));
    $form->addInput($config_headBg);
	$config_headBg = @isset($_POST['config_headBg']) ? addslashes(trim($_POST['config_headBg'])) : '';
	if($config_headBg){
		updateThemeConfig("config_headBg",$config_headBg);
	}
	
	$config_headImgUrl = new Typecho_Widget_Helper_Form_Element_Text('config_headImgUrl', array('value'), 'https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg', _t('头像地址'), _t('在这里填入头像的URL地址，它会显示在你的头部资料卡和每条微博前，如：https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg'));
    $form->addInput($config_headImgUrl);
	$config_headImgUrl = @isset($_POST['config_headImgUrl']) ? addslashes(trim($_POST['config_headImgUrl'])) : '';
	if($config_headImgUrl){
		updateThemeConfig("config_headImgUrl",$config_headImgUrl);
	}
	
	$config_nickname = new Typecho_Widget_Helper_Form_Element_Text('config_nickname', array('value'), '快乐贰呆', _t('昵称'), _t('在这里填入微博昵称，它会显示在你的头部资料卡，如：快乐贰呆'));
    $form->addInput($config_nickname);
	$config_nickname = @isset($_POST['config_nickname']) ? addslashes(trim($_POST['config_nickname'])) : '';
	if($config_nickname){
		updateThemeConfig("config_nickname",$config_nickname);
	}
	
	$config_follow_qrcode = new Typecho_Widget_Helper_Form_Element_Text('config_follow_qrcode', array('value'), 'http://me.tongleer.com/content/uploadfile/201706/008b1497454448.png', _t('关注二维码'), _t('在这里填入头部资料卡关注的二维码图片地址，如：http://me.tongleer.com/content/uploadfile/201706/008b1497454448.png'));
    $form->addInput($config_follow_qrcode);
	
	$config_home_name = new Typecho_Widget_Helper_Form_Element_Text('config_home_name', array('value'), '主页', _t('主页名称'), _t('在这里填入头部资料卡关注右侧按钮的名称，如：主页'));
    $form->addInput($config_home_name);
	$config_home_name = @isset($_POST['config_home_name']) ? addslashes(trim($_POST['config_home_name'])) : '';
	if($config_home_name){
		updateThemeConfig("config_home_name",$config_home_name);
	}
	
	$config_home_link = new Typecho_Widget_Helper_Form_Element_Text('config_home_link', array('value'), 'http://www.tongleer.com', _t('主页链接'), _t('在这里填入头部资料卡关注右侧按钮的链接，如：http://www.tongleer.com'));
    $form->addInput($config_home_link);
	$config_home_link = @isset($_POST['config_home_link']) ? addslashes(trim($_POST['config_home_link'])) : '';
	if($config_home_link){
		updateThemeConfig("config_home_link",$config_home_link);
	}
	
	$config_album_name = new Typecho_Widget_Helper_Form_Element_Text('config_album_name', array('value'), '相册', _t('相册名称'), _t('在这里填入自定义相册页面的名称，如：相册，模板page_album.php即为相册模板，只需建立独立页面即可。'));
    $form->addInput($config_album_name);
	$config_album_name = @isset($_POST['config_album_name']) ? addslashes(trim($_POST['config_album_name'])) : '';
	if($config_album_name){
		updateThemeConfig("config_album_name",$config_album_name);
	}
	
	$config_album_link = new Typecho_Widget_Helper_Form_Element_Text('config_album_link', array('value'), 'javascript:;', _t('相册链接'), _t('在这里填入自定义相册页面的链接，模板page_album.php即为相册模板，只需建立独立页面即可。'));
    $form->addInput($config_album_link);
	$config_album_link = @isset($_POST['config_album_link']) ? addslashes(trim($_POST['config_album_link'])) : '';
	if($config_album_link){
		updateThemeConfig("config_album_link",$config_album_link);
	}
	
	$config_other_1_name = new Typecho_Widget_Helper_Form_Element_Text('config_other_1_name', array('value'), '^_^', _t('资料卡更多下第一行名称'), _t('在这里填入头部资料卡更多按钮第一行的名称'));
    $form->addInput($config_other_1_name);
	$config_other_1_name = @isset($_POST['config_other_1_name']) ? addslashes(trim($_POST['config_other_1_name'])) : '';
	if($config_other_1_name){
		updateThemeConfig("config_other_1_name",$config_other_1_name);
	}
	
	$config_other_1_link = new Typecho_Widget_Helper_Form_Element_Text('config_other_1_link', array('value'), 'javascript:;', _t('资料卡更多下第一行名称的链接'), _t('在这里填入头部资料卡更多按钮第一行的名称的链接'));
    $form->addInput($config_other_1_link);
	$config_other_1_link = @isset($_POST['config_other_1_link']) ? addslashes(trim($_POST['config_other_1_link'])) : '';
	if($config_other_1_link){
		updateThemeConfig("config_other_1_link",$config_other_1_link);
	}
	
	$config_weiboname = new Typecho_Widget_Helper_Form_Element_Text('config_weiboname', array('value'), '同乐儿', _t('微博认证资料名称'), _t('在这里填入微博认证资料名称'));
    $form->addInput($config_weiboname);
	
	$config_address = new Typecho_Widget_Helper_Form_Element_Text('config_address', array('value'), '北京 东城区', _t('地区'), _t('在这里填入地区'));
    $form->addInput($config_address);
	
	$config_birthday = new Typecho_Widget_Helper_Form_Element_Text('config_birthday', array('value'), '2018年7月1日', _t('生日'), _t('在这里填入生日'));
    $form->addInput($config_birthday);
	
	$config_detail = new Typecho_Widget_Helper_Form_Element_Text('config_detail', array('value'), '工作联系 ：diamond@tongleer.com 微信：2293338477', _t('简介'), _t('在这里填入简介'));
    $form->addInput($config_detail);
	
	$config_foot_info = new Typecho_Widget_Helper_Form_Element_Textarea('config_foot_info', array('value'), '<p>友情链接：<a href="" target="_blank" rel="nofollow">同乐儿</a> <a href="" target="_blank" rel="nofollow">同乐儿</a></p>', _t('底部信息'), _t('在这里填入底部信息'));
    $form->addInput($config_foot_info);
	
	$config_foot_count = new Typecho_Widget_Helper_Form_Element_Textarea('config_foot_count', array('value'), '', _t('统计代码'), _t('在这里填入统计代码'));
    $form->addInput($config_foot_count);
}
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
        foreach($result as $val){            
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            echo '<li class="am-serif"><a href="'.$permalink.'" title="'.$post_title.'" target="_blank">'.$post_title.'</a></li>';        
        }
    }
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
?>