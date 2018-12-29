<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
	$db = Typecho_Db::get();
	$isRandomAlbum = new Typecho_Widget_Helper_Form_Element_Radio('isRandomAlbum', array(
		'y'=>_t('启用'),
		'n'=>_t('禁用')
	), 'n', _t('随机相册'), _t('是否开启随机相册，如果开启，必须在后台设置->永久链接中，将自定义文章路径设置为个性化定义的文章路径：<font color="red">/{cid}.html</font>'));
	$form->addInput($isRandomAlbum->addRule('enum', _t(''), array('y', 'n')));
	$isLazy = new Typecho_Widget_Helper_Form_Element_Radio('isLazy', array(
		'y'=>_t('启用'),
		'n'=>_t('禁用')
	), 'n', _t('图片懒加载'), _t('是否开启图片懒加载'));
	$form->addInput($isLazy->addRule('enum', _t(''), array('y', 'n')));
	
	$lazyUrl = new Typecho_Widget_Helper_Form_Element_Text('lazyUrl', null, '', _t('懒加载图片地址'), _t('输入懒加载时GIF图片的地址'));
	$form->addInput($lazyUrl);
	
	$icp = new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, NULL, _t('ICP备案号'), _t('填写 ICP 备案号，留空则不显示。'));
	$form->addInput($icp);
	$notice = new Typecho_Widget_Helper_Form_Element_Textarea('notice', NULL, NULL, _t('网站公告'), _t('填写网站公告，留空则不显示。'));
	$form->addInput($notice);
	$statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', NULL, NULL, _t('统计代码'), _t('填写统计平台生成的统计代码，该内容在页面隐藏生效，留空则不生效。'));
	$form->addInput($statistics);
	$picdesc = new Typecho_Widget_Helper_Form_Element_Textarea('picdesc', NULL, NULL, _t('组图默认描述'), _t('填写组图的默认描述，优先级低于“自定义字段”的值，留空则显示“未填写”。'));
	$form->addInput($picdesc);
	
	$query= $db->select('value')->from('table.options')->where('name = ?', 'siteUrl'); 
	$row = $db->fetchRow($query);
	$otherlinkvalue='
		[{
			"name":"文章 RSS",
			"link":"'.$row["value"].'/feed"
		},{
			"name":"评论 RSS",
			"link":"'.$row["value"].'/feed/comments/"
		}]
	';
	$otherlink = new Typecho_Widget_Helper_Form_Element_Textarea('otherlink', array("value"), $otherlinkvalue, _t('其他导航链接'), _t('此处可以随意添加链接到导航栏的下拉菜单中，name=链接名，link=链接地址。注：页面模板包括rss订阅地址、sitemap网站地图。'));
	$form->addInput($otherlink);
	$friendlinkvalue='
		[{
			"name":"链接1",
			"link":"'.$row["value"].'",
			"target":"_blank",
			"rel":"nofollow friend",
			"detail":"描述",
			"icon":"0",
			"order":"1"
		},{
			"name":"链接2",
			"link":"'.$row["value"].'",
			"target":"_blank",
			"rel":"nofollow friend",
			"detail":"描述",
			"icon":"0",
			"order":"2"
		}]
	';
	$friendlink = new Typecho_Widget_Helper_Form_Element_Textarea('friendlink', array("value"), $friendlinkvalue, _t('其他导航链接'), _t('此处可以随意添加链接到导航栏的下拉菜单中，name=链接名，link=链接地址，target=打开方式，rel=链接关系，detail=链接描述，icon=链接图标，order=链接排序。注：target包括_blank、_self、_parent、_top；rel可以指定任意关系名称；icon可以是一个QQ号，也可以是链接图标的地址，如果是QQ号，那么既包含QQ链接也包含QQ头像；order的排序规则是越大越靠前。'));
	$form->addInput($friendlink);
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
/*页脚数据统计*/
function getDataCount($type) {
	$data=array();
	$db = Typecho_Db::get();
	switch($type){
		case "attachnum":
			$queryAttach=$db->select('count(*) as total')->from('table.contents')->where('type = ?', 'attachment')->where('status = ?', 'publish'); 
			$rowAttach = $db->fetchRow($queryAttach);
			$data["attachnum"]=$rowAttach["total"];
			break;
		case "albumnum":
			$queryAlbum= $db->select('count(*) as total')->from('table.contents')->where('type = ?', 'post')->where('status = ?', 'publish'); 
			$rowAlbum = $db->fetchRow($queryAlbum);
			$data["albumnum"]=$rowAlbum["total"];
			break;
		case "catenum":
			$queryCate= $db->select('count(*) as total')->from('table.metas')->where('type = ?', 'category'); 
			$rowCate = $db->fetchRow($queryCate);
			$data["catenum"]=$rowCate["total"];
			break;
		case "pagenum":
			$queryPage= $db->select('count(*) as total')->from('table.contents')->where('type = ?', 'page')->where('status = ?', 'publish'); 
			$rowPage = $db->fetchRow($queryPage);
			$data["pagenum"]=$rowPage["total"];
			break;
		case "commentnum":
			$queryComment= $db->select('count(*) as total')->from('table.comments')->where('type = ?', 'comment')->where('status = ?', 'approved'); 
			$rowComment = $db->fetchRow($queryComment);
			$data["commentnum"]=$rowComment["total"];
			break;
	}
	return $data;
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
            Typecho_Cookie::set('extend_contents_views', $views);
        }
    }
    echo $row['views'];
}
//文章缩略图
function showThumb($obj, $link = false) {
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment; 
    if (isset($attach->isImage) && $attach->isImage == 1) {
        $thumb = $attach->url;   //附件是图片 输出附件
    } elseif (isset($matches[1][0])) {
        $thumb = $matches[1][0];  //文章内容中抓到了图片 输出链接
    }
	//空的话输出默认随机图
	$thumb = empty($thumb) ? $options->themeUrl .'/img/' . rand(1, 14) . '.jpg' : $thumb;	
    if($link) {
        return $thumb;
    }
	else {
		$thumb='<img src="'.$thumb.'">';
		return $thumb;
	}
}

//获取附件图片
function getAttachImg($cid) {
	$db = Typecho_Db::get();
	$rs = $db->fetchAll($db->select('table.contents.text')
			->from('table.contents')
			->where('table.contents.parent=?', $cid)
			->order('table.contents.cid', Typecho_Db::SORT_ASC));
	$attachPath = array();
	foreach($rs as $attach) {
		$attach = unserialize($attach['text']);
		if($attach['mime'] == 'image/jpeg') {
			$queryPlugins= $db->select('value')->from('table.options')->where('name = ?', 'plugins'); 
			$rowPlugins = $db->fetchRow($queryPlugins);
			$plugins=@unserialize($rowPlugins['value']);
			if(isset($plugins['activated']['WeiboFile'])){
				$attachPath[] = array($attach['name'], 'https://ws3.sinaimg.cn/large/'.$attach['path'].'.jpg');
			}else{
				$query= $db->select('value')->from('table.options')->where('name = ?', 'siteUrl'); 
				$row = $db->fetchRow($query);
				$attachPath[] = array($attach['name'], $row["value"].$attach['path']);
			}
		}
    }
	return $attachPath;
}

//后期软件
function afterSoftware() {
	return array(
		_t('未知'),
		_t('Photoshop'),
		_t('Google Picasa'),
		_t('Snapseed'),
		_t('泼辣修图'),
		_t('美图秀秀'),
		_t('Camera 360'),
		_t('天天P图'),
		_t('黄油相机'),
		_t('Enlight'),
		_t('Facetune'),
		_t('Prisma'),
		_t('PicsArt'),
		_t('Pixlr'),
		_t('VSCO'),
		_t('Instagram'),
    );
}

//自定义字段
function themeFields($layout) {
	$photog = new Typecho_Widget_Helper_Form_Element_Text('photog', NULL, NULL, _t('作者/来源'), _t('在这里填写拍摄照片者的姓名'));
	$srcurl = new Typecho_Widget_Helper_Form_Element_Text('srcurl', NULL, NULL, _t('来源地址'), _t('在这里填写图片出处的网络地址（留空则不链接地址）'));
	$appear = new Typecho_Widget_Helper_Form_Element_Text('appear', NULL, NULL, _t('出镜人物'), _t('在这里填写照片出镜者的姓名'));
	$software = new Typecho_Widget_Helper_Form_Element_Select('software', afterSoftware(), NULL, _t('处理软件'), _t('在这里选择照片后期处理软件'));
	$description = new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, NULL, _t('图集描述'), _t('在这里填写照片描述等其他文本信息'));
	$thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('封面图片'), _t('在这里填写封面图片的地址（留空将自动获取第一个附件图片）'));
	$layout->addItem($photog);
	$layout->addItem($srcurl);
	$layout->addItem($appear);
	$layout->addItem($software);
	$layout->addItem($description);
	$layout->addItem($thumb);
}


//以下函数未启用
function themeInit($archive){
    if ($archive->is('single')){
    		//$archive->content = image_class_replace($archive->content);
    }
}

function image_class_replace($content){
    $content = preg_replace('#<img(.*?) src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', '<div class="post-item layui-col-xs6 layui-col-sm4 layui-col-md3"><img$1 src="$2$3"$5 class="post-item-img"></div>', $content);
    return $content;
}