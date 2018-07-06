<?php
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
    <section>
		<ol class="am-breadcrumb" style="background-color:#fff;">
		  <li><a href="<?=$this->options ->siteUrl();?>" class="am-icon-home">首页</a></li>
		  <li><?php $this->category(','); ?></li>
		  <li class="am-active"><?php $this->title(); ?></li>
		</ol>
		<div class="am-cf am-article" style="padding:10px;background-color:#fff;">
			<h6><?php $this->title(); ?></h6>
			<div>
				<small>
					<a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> 发布 | <?php $this->date('Y-m-d'); ?> | <?php $this->category(','); ?>| 评论数：<?php $this->commentsNum('0', '1', '%d'); ?> | 标签：<?php $this->tags(',', true, '<a>没有标签</a>'); ?>
				</small>
			</div>
			<p>
				<?php parseContent($this); ?>
			</p>
			<p>
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></div>
				<script>
					window._bd_share_config={
						"common":{
							"bdSnsKey":{},
							"bdText":"<?php $this->title() ?>",
							"bdMini":"2",
							"bdMiniList":["qzone","tsina","weixin","tqq","sqq","fbook","twi","copy"],
							"bdPic":"<?php if(showThumb($this)){echo showThumb($this)[0];};?>",
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
				</script>
			</p>
		</div>
		<?php $this->need('comments.php'); ?>
	</section>
  </div>
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>