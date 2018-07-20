<?php
/**
 * tongleer - A WeiboForTypecho Template From tongleer.com
 * 
 * @package tongleer
 * @author 二呆
 * @version 1.0.4
 * @link http://www.tongleer.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
include('config.php');
?>
<style>
	a{
		color:#000;
	}
	.boxes {
	  width: 180px;
	}
	.boxes .box {
	  height: 60px;
	  color: #eee;
	  line-height: 60px;
	  text-align: center;
	  font-weight: bold;
	  transition: all .2s ease;
	}
	.boxes .box img{
		width:100%;
		height:100%;
	}
	.boxes .box:hover {
	  font-size: 250%;
	  transform: rotate(360deg);
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
<div class="am-g am-g-fixed">
  <div class="am-u-md-9 am-u-md-push-3">
	<div class="cat-nav am-round" data-am-sticky="{top:60}">
		<div data-am-widget="tabs">
		  <ul class="am-tabs-nav">
			  <li><button type="button" class="am-btn am-radius" onClick="location.href='<?=$this->options ->siteUrl();?>';">全部</button></li>
			  <li class="am-dropdown" data-am-dropdown>
				<button type="button" class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle>更多<span class="am-icon-caret-down"></span></button>
				<ul class="am-dropdown-content">
					<?php $this->widget('Widget_Metas_Category_List')->to($cats); ?>
					<?php while ($cats->next()): ?>
						<li><a href="<?php $cats->permalink()?>" title="<?php $cats->name()?>"><?php $cats->name()?></a></li>
					<?php endwhile; ?>
				</ul>
			  </li>
			  <li>
				<form class="am-fr" id="search-header" method="post" action="<?php $this->options ->siteUrl(); ?>" name="search-header">
					<input class="am-form-field am-round am-input-sm" type="text" name="s" placeholder="搜文章" />
				</form>
			  </li>
		  </ul>
		</div>
	</div>
    <section class="am-u-md-12">
	  <?php if ($this->have()): ?>
		<ul class="am-list">
		  <?php $k=0;while($this->next()): ?>
		  <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left" style="background-color:#fff;margin-bottom:10px;">
			<div <?php if(isMobile()){?>class="am-u-sm-3 am-list-thumb"<?php }else{?>class="am-u-sm-2 am-list-thumb"<?php }?>>
			  <a href="">
				<img class="am-circle" src="<?=$config_headImgUrl;?>"/>
			  </a>
			</div>
			<div <?php if(isMobile()){?>class="am-u-sm-9 am-list-main"<?php }else{?>class="am-u-sm-10 am-list-main"<?php }?> style="margin-bottom:5px;">
				<h3 class="am-list-item-hd">
					<a href="<?php $this->permalink(); ?>" class="">
						<?php $this->title(); ?>
					</a>
				</h3>
				<small class="am-list-item-text"><?php $this->date('Y年m月d日 H:i'); ?> 来自 <?php $this->category(','); ?>&nbsp;&nbsp;<?php $this->tags(',', true, ''); ?></small>
				<div>
					<small>
						<?php $this->excerpt(140, '...'); ?>
					</small>
				</div>
				<?php
				$thumb=showThumb($this);
				$youku='player.youku.com';
				$miaopai='gslb.miaopai.com';
				$douyin='aweme.snssdk.com';
				if(count($thumb)<9&&count($thumb)!=0){
					if(strpos($thumb[0],$youku)===false&&strpos($thumb[0],$miaopai)===false&&strpos($thumb[0],$douyin)===false){
						?>
						<div class="am-avg-sm-3" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
						  <img src="<?=$thumb[0];?>"  alt="" width="180" />
						</div>
						<?php
					}else if(strpos($thumb[0],'player.youku.com')){
						?>
						<iframe height="400" width="100%" src="<?=$thumb[0];?>" frameborder="0" "allowfullscreen"></iframe>
						<?php
					}
				}else if(count($thumb)>=9){
					?>
					<ul class="am-avg-sm-3 boxes" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
						<?php
						for($i=0;$i<count($thumb);$i++){
							if(strpos($thumb[$i],$youku)===false&&strpos($thumb[$i],$miaopai)===false&&strpos($thumb[$i],$douyin)===false){
								?>
								<li class="box box-1"><img src="<?=$thumb[$i];?>"  alt="" /></li>
								<?php
							}
						}
						?>
					</ul>
					<?php
				}
				?>
			</div>
			<ul class="am-avg-sm-1" style="text-align:center;">
			  <!--<li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text" href="">阅读 <?php get_post_view($this); ?></a></li>-->
			  <li style="border-top:1px solid #ddd;"><a class="am-list-item-text" href="<?php $this->permalink(); ?>#comments">评论 <?php $this->commentsNum('0', '1', '%d'); ?></a></li>
			  <!--
			  <li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text bdsharebuttonbox" data-cmd="more" href="">分享 <span class="am-icon-share-square-o"></span></a></li>
			  <input type="hidden" class="sharetitle" id="sharetitle<?=$k;?>" value="<?php $this->title() ?>" />
			  <input type="hidden" class="sharedesc" id="sharedesc<?=$k;?>" value="<?php $this->excerpt(140, '...'); ?>" />
			  <input type="hidden" class="shareurl" id="shareurl<?=$k;?>" value="<?php $this->permalink(); ?>" />
			  -->
			  <script>
					/*
					window._bd_share_config={
						"common":{
							"bdSnsKey":{},
							"bdText":$('#'+$('.sharetitle').attr('id')).val(),
							"bdMini":"2",
							"bdMiniList":["qzone","tsina","weixin","tqq","sqq","fbook","twi","copy"],
							"bdPic":"",
							"bdDesc" : $('#'+$('.sharedesc').attr('id')).val(),
							"bdUrl" : $('#'+$('.shareurl').attr('id')).val(),
							"bdStyle":"0",
							"bdSize":"16"
						},
						"share":{},
						"image":{
							"viewList":["qzone","tqq","weixin","sqq","tsina"],
							"viewText":"分享到：",
							"viewSize":"16"
						},
						"selectShare":{
							"bdContainerClass":null,
							"bdSelectMiniList":["qzone","tqq","weixin","sqq","tsina"]
						}
					};
					with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
					*/
			  </script>
			</ul>
		  </li>
		  <?php $k++;endwhile; ?>
		</ul>
		<?php $this->pageNav('«', '»', 0, '...', array('wrapTag' => 'ul', 'wrapClass' => 'am-pagination am-pagination-right', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' => 'am-active', 'prevClass' => '', 'nextClass' => '')); ?>
	  <?php else: ?>
		<style>
		.page-main{
			background-color:#fff;
			margin:0px auto 0px auto;
		}
		@media screen and (max-width: 960px) {
			.page-main {width: 100%;}
		}
		</style>
		<section class="page-main">
		  <div class="admin-content">
			<div class="admin-content-body">
			  <div class="am-cf am-padding am-padding-bottom-0">
				<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">404</strong> / <small>That’s an error</small></div>
			  </div>

			  <hr>

			  <div class="am-g">
				<div class="am-u-sm-12">
				  <h2 class="am-text-center am-text-xxxl am-margin-top-lg">404. Not Found</h2>
				  <p class="am-text-center">没有找到你要的页面</p>
				<pre class="page-404">
				  .----.
			   _.'__    `.
		   .--($)($$)---/#\
		 .' @          /###\
		 :         ,   #####
		  `-..__.-' _.-\###/
				`;_:    `"'
			  .'"""""`.
			 /,  ya ,\\
			//  404!  \\
			`-._______.-'
			___`. | .'___
		   (______|______)
				</pre>
				</div>
			  </div>
			</div>
		  </div>
		<!-- content end -->
		</section>
	  <?php endif; ?>  
	</section>
  </div>
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>