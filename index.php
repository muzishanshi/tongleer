<?php
/**
 * tongleer - A WeiboForTypecho Template From tongleer.com
 * 
 * @package tongleer
 * @author 二呆
 * @version 1.0.8
 * @link http://www.tongleer.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<script type="text/javascript">
	$(function(){
		/*鼠标移入和移出事件*/
		$('.menu li').hover(function(){	
			$(this).find('.two').show();
			/*鼠标移入和移出事件*/
			$('.two li').hover(function(){
				var content=$(this).find('.hide li:first small').text();
				if(content != null && content.length != 0){
					$(this).find('.hide').show();
				}
			},function(){
				$(this).find('.hide').hide();
			});
		},function(){
			$(this).find('.two').hide();
		});
	});
</script>
<style>
#nav ul.menu li ul{
		position: relative; 
		top: 0px; 
		background: #fff; 
		border: 1px solid #eee;
		border-radius: 0 0 3px 3px; 
	}
	#nav ul.menu li ul li{
		position: relative;
	}
	#nav ul.menu li ul li .hide{
		position: relative; 
		top: 0px; 
		left: 0px;
		border: 1px solid #eee;
		border-radius: 0 0 3px 3px; 
	}
	.two,.hide{
		display:none;
	}
</style>
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
			  <li id="nav" class="am-dropdown" data-am-dropdown>
				<a class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle><small>更多</small><span class="am-icon-caret-down"></span></a>
				<ul class="am-dropdown-content menu">
					<?php
					$this->widget('Widget_Metas_Category_List')->to($categories);
					while($categories->next()){
						if($categories->parent!=0){
							continue;
						}
						?>
						<li>
							<a href="<?php echo $categories->permalink;?>" title="<?php echo $categories->name;?>"><small><?php echo $categories->name;?></small></a>
							<?php
							$children = $categories->getAllChildren($categories->mid);
							if(count($children)>0){
							?>
							<ul class="two">
								<?php
								foreach ($children as $mid) {
									$child = $categories->getCategory($mid);
									?>
									<li>
										<a href="<?php echo $child['permalink'];?>" title="<?php echo $child['name'];?>"><small><?php echo $child['name']; ?></small></a>
										<ul class="hide">
											<?php
											$threecate = $categories->getAllChildren($child['mid']);
											foreach ($threecate as $three) {
											?>
											<li><a href="<?php echo $three['permalink'];?>" title="<?php echo $three['name'];?>"><small><?php echo $three['name']; ?></small></a></li>
											<?php
											}
											?>
										</ul>
									</li>
									<?php
								}
								?>
							</ul>
							<?php
							}
							?>
						</li>
						<?php
					}
					?>
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
    <section id="content" class="am-u-md-12">
	  <?php if ($this->have()): ?>
		<ul class="am-list">
		  <?php while($this->next()): ?>
		  <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left tleajaxpage" style="background-color:#fff;margin-bottom:10px;">
			<div <?php if(isMobile()){?>class="am-u-sm-3 am-list-thumb"<?php }else{?>class="am-u-sm-2 am-list-thumb"<?php }?>>
			  <a href="<?php $this->author->permalink(); ?>" rel="author">
				<img class="am-circle" src="<?=$this->options->headImgUrl;?>"/>
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
				$miaopai='miaopai.com';
				$douyin='aweme.snssdk.com';
				if(count($thumb)<9&&count($thumb)!=0){
					if(strpos($thumb[0],$youku)===false&&strpos($thumb[0],$miaopai)===false&&strpos($thumb[0],$douyin)===false){
						?>
						<ul class="am-avg-sm-3" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
						  <li><img src="<?=$thumb[0];?>"  alt="" width="180" /></li>
						</ul>
						<?php
					}else if(strpos($thumb[0],'player.youku.com')){
						?>
						<iframe height="400" width="100%" src="<?=$thumb[0];?>" frameborder="0" "allowfullscreen"></iframe>
						<?php
					}else if(strpos($thumb[0],'miaopai.com')){
						?>
						<video src="<?=$thumb[0];?>" controls="controls"></video>
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
			<ul class="am-avg-sm-3" style="text-align:center;">
			  <li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text" href="<?php $this->permalink(); ?>">阅读 <?php get_post_view($this); ?></a></li>
			  <li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text" href="<?php $this->permalink(); ?>#comments">评论 <?php $this->commentsNum('0', '1', '%d'); ?></a></li>
			  <li style="border-top:1px solid #ddd;"><a class="am-list-item-text" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>&title=<?php echo $this->title(); ?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" >分享 <span class="am-icon-share-square-o"></span></a></li>
			</ul>
		  </li>
		  <?php endwhile; ?>
		</ul>
		<div class="am-pagination blog-pagination">
			<li class="am-pagination-next"><?php $this->pageLink('上一页'); ?></li>
			<li class="am-pagination-prev"><?php $this->pageLink('下一页','next'); ?></li>
		</div>
		<?php if($this->options->is_ajax_page=='y'){?>
		<!--ajax分页加载-->
		<script>
		$(function(){
			var ias = $.ias({
				container: "#content", /*包含所有文章的元素*/
				item: ".tleajaxpage", /*文章元素*/
				pagination: ".am-pagination", /*分页元素*/
				next: ".am-pagination a.next", /*下一页元素*/
			});
			ias.extension(new IASTriggerExtension({
				text: '<div class="cat-nav am-round"><small></small></div>', /*此选项为需要点击时的文字*/
				offset: false, /*设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载*/
			}));
			ias.extension(new IASSpinnerExtension());
			ias.extension(new IASNoneLeftExtension({
				text: '<div class="cat-nav am-round"><small></small></div>', /*加载完成时的提示*/
			}));
		});
		</script>
		<?php }?>
	  <?php endif; ?>  
	</section>
  </div>
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>