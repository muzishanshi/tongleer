<?php
/**
 * 相册
 * @package custom
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<style>
.page-main{
	background-color:#fff;
	width:960px;
	margin:0px auto 0px auto;
}
@media screen and (max-width: 960px) {
	.page-main {width: 100%;}
}

.cat-nav{
	width:0.9;
	margin:0px auto 10px auto;
	background-color:#eeeeee;
}
.cat-nav button{
	background-color:#eeeeee;
	font-size:90%;
}
@media screen and (max-width: 0.9;) {
	.cat-nav {width: 100%;}
}
</style>
<!-- content section -->
<section class="page-main" style="word-wrap:break-word;">
	
	<?php
	$query= $this->db->select()->from('table.contents')->where('type = ?', 'post')->where('status = ?', 'publish')->order('created',Typecho_Db::SORT_DESC);
	$result = $this->db->fetchAll($query);
	$album=array();
	$temi=0;
	foreach($result as $value){
		$match_str = "/((http)+.*?((.gif)|(.jpg)|(.bmp)|(.png)|(.GIF)|(.JPG)|(.PNG)|(.BMP)))/";
		preg_match_all ($match_str,$value['text'],$matches,PREG_PATTERN_ORDER);
		if(count($matches[1])==0){
			continue;
		}
		for($j=0;$j<count($matches[1]);$j++){
			$album[$temi]['src']=$matches[1][$j];
			$album[$temi]['title']=$value['title'];
			$album[$temi]['created']=$value['created'];
			$temi++;
		}
	}
	$page_now = isset($_GET['page_now']) ? intval($_GET['page_now']) : 1;
	if($page_now<1){
		$page_now=1;
	}
	$page_rec=16;
	$totalrec=count($album);
	$page=ceil($totalrec/$page_rec);
	if($page_now>$page){
		$page_now=$page;
	}
	if($page_now<=1){
		$before_page=1;
		if($page>1){
			$after_page=$page_now+1;
		}else{
			$after_page=1;
		}
	}else{
		$before_page=$page_now-1;
		if($page_now<$page){
			$after_page=$page_now+1;
		}else{
			$after_page=$page;
		}
	}
	$albumArr = array_slice($album, ($page_now-1)*$page_rec, $page_rec);
	?>
	<?php
	$i=1;$year=0; $mon=0;
	$output = "";
	foreach($albumArr as $value){
		$year_tmp = date('Y',$value["created"]);
		$mon_tmp = date('m',$value["created"]);
		if ($mon != $mon_tmp && $mon > 0){
			$output .= '
						</ul>
					</div>
				</div>
			</div>
			';  //结束拼接
		}
		if ($year != $year_tmp && $year > 0){
		}
		if ($year != $year_tmp) {
			$year = $year_tmp;
		}
		if ($mon != $mon_tmp) {
			$mon = $mon_tmp;
			$output .= "
				<div class=\"am-panel am-panel-default\">
					<div class=\"am-panel-hd\" style=\"background:#fff;color:#aaa;border:1px solid #fff;\">
						<h4 class=\"am-panel-title\" data-am-collapse=\"{parent: '#accordion', target: '#do-not-say-".$i."'}\">".$year."年".$mon."月
						</h4>
					</div>
					<div id=\"do-not-say-".$i."\" class=\"am-panel-collapse am-collapse  am-in\">
						<div class=\"am-panel-bd\">
							<ul data-am-widget=\"gallery\" class=\"am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-overlay\" data-am-gallery=\"{ pureview: true }\" >
			";
		}
		$output .= "
			<li class=\"albumitem\">
				<div class=\"am-gallery-item\" style=\"width:100%;height:0px;padding-bottom:100%;position:relative;\">
					<a href=\"javascript:;\">
						<img src=\"".$value['src']."\" style=\"width:100%;height:100%;position:absolute;\"  alt=\"".$value["title"]."（".date('d日',$value["created"])."）"."\" />
						<h3 class=\"am-gallery-title\">".$value["title"]."（".date('d日',$value["created"])."）"."</h3>
					</a>
				</div>
			</li>
		";
		$i++;
	}
	echo $output.'
				</ul>
			</div>
		</div>
	</div>
	';
	?>
	<ul class="am-pagination blog-pagination">
	  <?php if($page_now!=1){?>
		<li class="am-pagination-prev"><a href="?page_now=1">首页</a></li>
	  <?php }?>
	  <?php if($page_now>1){?>
		<li class="am-pagination-prev"><a href="?page_now=<?=$before_page;?>">&laquo; 上一页</a></li>
	  <?php }?>
	  <?php if($page_now<$page){?>
		<li class="am-pagination-next"><a id="tlenextpage" href="?page_now=<?=$after_page;?>">下一页 &raquo;</a></li>
	  <?php }?>
	  <?php if($page_now!=$page){?>
		<li class="am-pagination-next"><a href="?page_now=<?=$page;?>">尾页</a></li>
	  <?php }?>
	</ul>
	<script src="<?php $this->options->themeUrl('assets/js/jquery.ias.min.js'); ?>" type="text/javascript"></script>
	<script>
	var ias = $.ias({
		container: ".page-main", /*包含所有文章的元素*/
		item: ".albumitem", /*文章元素*/
		pagination: ".am-pagination", /*分页元素*/
		next: ".am-pagination a#tlenextpage", /*下一页元素*/
	});
	ias.extension(new IASTriggerExtension({
		text: '<div class="cat-nav am-round"><small>猛点几次查看更多内容</small></div>', /*此选项为需要点击时的文字*/
		offset: 2, /*设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载*/
	}));
	ias.extension(new IASSpinnerExtension());
	ias.extension(new IASNoneLeftExtension({
		text: '', /*加载完成时的提示*/
	}));
	</script>
</section>
<!-- end content section -->
<?php $this->need('footer.php'); ?>