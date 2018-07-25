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
</style>
<!-- content section -->
<section class="page-main">
	<ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
	  <?php
		$queryTotal= $this->db->select()->from('table.contents');
		$page_now = isset($_GET['page_now']) ? intval($_GET['page_now']) : 1;
		if($page_now<1){
			$page_now=1;
		}
		$resultTotal = $this->db->fetchAll($queryTotal);
		$page_rec=$this->parameter->pageSize;
		$totalrec=count($resultTotal);
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
		$i=($page_now-1)*$page_rec<0?0:($page_now-1)*$page_rec;
		$query= $this->db->select()->from('table.contents')->order('created',Typecho_Db::SORT_DESC);//->offset($i)->limit($page_rec)
		$result = $this->db->fetchAll($query);
		$temi=1;
		?>
		<?php
		foreach($result as $value){
			$match_str = "/((http)+.*?((.gif)|(.jpg)|(.bmp)|(.png)|(.GIF)|(.JPG)|(.PNG)|(.BMP)))/";
			preg_match_all ($match_str,$value['text'],$matches,PREG_PATTERN_ORDER);
			if(count($matches[1])==0){
				continue;
			}
			
			for($j=0;$j<count($matches[1]);$j++){
				?>
				<li>
				<div class="am-gallery-item" style="width:100%;height:0px;padding-bottom:100%;position:relative;">
					<a href="<?=$matches[1][$j];?>">
					  <img src="<?=$matches[1][$j];?>" style="width:100%;height:100%;position:absolute;"  alt="<?=$value["title"];?>" />
					  <h3 class="am-gallery-title"><?=$value["title"];?></h3>
					  <div class="am-gallery-desc"><?=date('Y-m-d H:i:s',$value["created"]);?></div>
					</a>
				</div>
				</li>
				<?php
				$temi++;
			}
		}
		?>
	</ul>
</section>
<!-- end content section -->
<?php $this->need('footer.php'); ?>