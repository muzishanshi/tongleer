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
<div class="am-g am-g-fixed" style="word-wrap:break-word;">
  <div class="am-u-md-9 am-u-md-push-3">
	<div class="cat-nav am-round" data-am-sticky="{top:60}">
		<div data-am-widget="tabs">
		  <ul class="am-tabs-nav">
			  <li><a class="am-btn am-radius" href="<?=$this->options ->siteUrl();?>"><small>全部</small></a></li>
			  <li class="am-dropdown" data-am-dropdown>
				<a class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle><small>更多</small><span class="am-icon-caret-down"></span></a>
				<ul class="am-dropdown-content">
					<?php $this->widget('Widget_Metas_Category_List')->to($cats); ?>
					<?php while ($cats->next()): ?>
						<li><a href="<?php $cats->permalink()?>" title="<?php $cats->name()?>"><small><?php $cats->name()?></small></a></li>
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
    <section id="content">
		<ol class="am-breadcrumb" style="background-color:#fff;">
		  <li><a href="<?=$this->options ->siteUrl();?>" class="am-icon-home">首页</a></li>
		  <li><?php $this->category(','); ?></li>
		  <li class="am-active"><?php $this->title(); ?></li>
		</ol>
		<div class="am-cf am-article" style="padding:10px;background-color:#fff;">
			<h6><?php $this->title(); ?></h6>
			<div>
				<small>
					<a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> 发布 | <?php $this->date('Y-m-d'); ?> | <?php $this->category(','); ?> | 阅读数：<?php get_post_view($this); ?> | 评论数：<?php $this->commentsNum('0', '1', '%d'); ?> | 标签：<?php $this->tags(',', true, '<a>没有标签</a>'); ?>
				</small>
			</div>
			<p>
				<?php parseContent($this); ?>
			</p>
			<p>
				<?php
				preg_match_all( "/<img.*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $this->content, $sharematche );
				$sharecontent=subString(str_replace('', '', strip_tags($this->content)),0,140);
				?>
				<small>分享至:</small>
				<a href="http://service.weibo.com/share/share.php?url=<?=curPageURL();?>&title=<?php echo $this->title(); ?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php $this->options->themeUrl('assets/images/icon_sina.png'); ?>" alt="" /></a>
				<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?=curPageURL();?>&title=<?php echo $this->title(); ?>&site=<?=$this->options ->siteUrl();?>&desc=这是一篇神奇的文章&summary=<?php echo $sharecontent; ?>&pics=<?php if(count($sharematche[1])>0){echo $sharematche[1][0];}?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php $this->options->themeUrl('assets/images/icon_qzone.png'); ?>" alt="" /></a>
				<a href="http://connect.qq.com/widget/shareqq/index.html?url=<?=curPageURL();?>&title=<?php echo $this->title(); ?>&site=<?=$this->options ->siteUrl();?>&desc=这是一篇神奇的文章&summary=<?php echo $sharecontent; ?>&pics=<?php if(count($sharematche[1])>0){echo $sharematche[1][0];}?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php $this->options->themeUrl('assets/images/icon_qq.png'); ?>" alt="" /></a>
			</p>
		</div>
		<?php $this->need('comments.php'); ?>
	</section>
  </div>
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>