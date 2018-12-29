<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
Typecho_Widget::widget('Widget_Stat')->to($stat);
$querySite= $this->db->select('value')->from('table.options')->where('name = ?', 'siteUrl'); 
$rowSite = $this->db->fetchRow($querySite);
?>
<style>
.web-info{
    margin: 10px 0 0 0;
    font-size: 14px;
    color: #444;
    background-color: #fff;
    padding:8px;
    border: 1px solid #E1E8ED;
    list-style: none;
    overflow: hidden;
}
.web-info li{
    width: 33%;
    text-align: center;
    float: left;
    font-size: 13px;
    letter-spacing: 1px;
}
li.frinum, li.vitnum {
    border-right: 1px solid #EFEFEF;
}
.web-info span{
    display: block;
}
@media screen and (max-width: 960px) {
	.web-info {margin: 0 0 0 0;}
}
</style>
<div class="am-u-md-3 am-u-md-pull-9">
    <div class="am-panel-group">
	
		<section class="am-panel am-panel-default web-info" style="margin-bottom:5px;">
			<li id="btnCommentShow" class="frinum">
				<a href="javascript:void(0)"><?php echo $stat->PublishedCommentsNum; ?>
				<span>评论</span></a>
			</li>
			<li id="btnUserShow" class="vitnum">
				<?php
				$userQuery= $this->db->select()->from('table.users');
				$userData = $this->db->fetchAll($userQuery);
				$config_totalUser=count($userData);
				?>
				<a href="javascript:void(0)"><?php echo $config_totalUser; ?>
				<span>粉丝</span></a>
			</li>
			<li id="btnArticleShow" class="ptnum">
				<a href="javascript:void(0)"><?php echo $stat->PublishedPostsNum; ?>
				<span>文章</span></a>
			</li>
			<div id="commentShowDiv">
				<?php
				$this->widget('Widget_Comments_Recent','pageSize=5')->to($comments);
				if($comments->have()){
					?>
					<span style="text-align: center;"><small><b>最新评论</b></small></span>
					<?php
					while($comments->next()){
					?>
					<div>
						<?php
						$host = 'https://secure.gravatar.com';
						$url = '/avatar/';
						$size = '50';
						$rating = Helper::options()->commentsAvatarRating;
						$hash = md5(strtolower($comments->user->mail));
						$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
						?>
						<img src="<?=$avatar;?>" alt="" class="am-circle" width="18" height="18">
						<small><a href="<?=$rowSite["value"];?>/index.php/author/<?=$comments->user->uid;?>" title="<?=$comments->user->screenName!=""?$comments->user->screenName:$comments->user->name;?>"><?=$comments->user->screenName!=""?$comments->user->screenName:$comments->user->name;?></a>说：<?=subString(str_replace('', '', strip_tags($comments->text)),0,20);?></small>
					</div>
					<?php
					}
				}
				?>
			</div>
			<div id="userShowDiv" style="display:none;">
				
				<?php
				$queryUsers= $this->db->select()->from('table.users')->order('created',Typecho_Db::SORT_DESC)->offset(0)->limit(5);
				$resultUsers = $this->db->fetchAll($queryUsers);
				if(count($resultUsers)>0){
					?>
					<span style="text-align: center;"><small><b>最新粉丝</b></small></span>
					<?php
					foreach($resultUsers as $value){
					?>
					<div>
						<?php
						$host = 'https://secure.gravatar.com';
						$url = '/avatar/';
						$size = '50';
						$rating = Helper::options()->commentsAvatarRating;
						$hash = md5(strtolower($value['mail']));
						$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
						?>
						<img src="<?=$avatar;?>" alt="" class="am-circle" width="18" height="18">
						<small><a href="<?=$rowSite["value"];?>/index.php/author/<?=$value['uid'];?>" title="<?=$value['screenName']!=""?$value['screenName']:$value['name'];?>"><?=$value['screenName']!=""?$value['screenName']:$value['name'];?></a></small>
					</div>
					<?php
					}
				}
				?>
			</div>
			<div id="articleShowDiv" style="display:none;">
				<?php
				$this->widget('Widget_Contents_Post_Recent','pageSize=5')->to($posts);
				if($posts->have()){
					?>
					<span style="text-align: center;"><small><b>最新文章</b></small></span>
					<?php
					while($posts->next()){
					$queryAnchor= $this->db->select()->from('table.users')->where('table.users.uid = ?', $posts->authorId);
					$rowAnchor = $this->db->fetchRow($queryAnchor);
					?>
					<div>
						<?php
						$host = 'https://secure.gravatar.com';
						$url = '/avatar/';
						$size = '50';
						$rating = Helper::options()->commentsAvatarRating;
						$hash = md5(strtolower($rowAnchor['mail']));
						$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
						?>
						<img src="<?=$avatar;?>" alt="" class="am-circle" width="18" height="18">
						<small>
							<a href="<?=$rowSite["value"];?>/index.php/author/<?=$posts->authorId;?>" title="<?=$rowAnchor['screenName']!=""?$rowAnchor['screenName']:$rowAnchor['name'];?>">
								<?=$rowAnchor['screenName']!=""?$rowAnchor['screenName']:$rowAnchor['name'];?>
							</a>于<?=date('Y-m-d',$posts->created);?>发表：
							<a href="<?=$posts->permalink;?>" title="<?=$posts->title;?>">
								<font color="#aaa">
									<?=$posts->title;?>
								</font>
							</a>
							<?php
							$sidetext=Markdown::convert($posts->text);
							echo subString(str_replace('', '', strip_tags($sidetext)),0,35);
							?>
						</small>
					</div>
					<?php
					}
				}
				?>
			</div>
		</section>
		
		<section class="am-panel am-panel-default">
			<ul class="am-list am-list-static am-list-border">
			  <li>
				<span><img src="<?php $this->options->themeUrl('assets/images/weiboauth.png'); ?>" /></span><br />
				<small><?=$this->options->weiboname;?></small>
			  </li>
			  <li><i class="am-icon-map-marker am-icon-fw"></i><small><?=$this->options->address;?></small></li>
			  <li><i class="am-icon-birthday-cake am-icon-fw"></i><small><?=$this->options->birthday;?></small></li>
			  <li><i class="am-icon-info am-icon-fw"></i><small><?=$this->options->detail;?></small></li>
			  <li style="text-align: center;"><small><a href="<?=$this->options->about;?>">查看更多 ></a></small></li>
			</ul>
		</section>
		
		<section class="am-panel am-panel-default">
			<div class="am-panel-hd"><small>热门文章</small></div>
			<ul class="am-list blog-list">
			  <?php getHotCommentsArticle(5);?>
			</ul>
		</section>
		
		<section data-am-sticky="{top:60}">
			<?php include('page_weibofile_webimgupload.php'); ?>
		</section>
		
		<section class="am-panel am-panel-success">
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
			<?php if($tags->have()): ?>
			<div class="am-panel-hd"><small>标签</small></div>
			<?php while($tags->next()): ?>
				<small><a style="color: rgb(<?php echo(rand(0, 255)); ?>, <?php echo(rand(0,255)); ?>, <?php echo(rand(0, 255)); ?>)" href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a></small>
			<?php endwhile; ?>
			<?php endif; ?>
		</section>
	
    </div>
</div>
<script>
$("#btnCommentShow").click(function(){
	if($("#commentShowDiv").css("display")=="none"){
		$("#commentShowDiv").css("display","block");
		$("#userShowDiv").css("display","none");
		$("#articleShowDiv").css("display","none");
	}else{
		$("#commentShowDiv").css("display","none");
	}
});
$("#btnUserShow").click(function(){
	if($("#userShowDiv").css("display")=="none"){
		$("#userShowDiv").css("display","block");
		$("#commentShowDiv").css("display","none");
		$("#articleShowDiv").css("display","none");
	}else{
		$("#userShowDiv").css("display","none");
	}
});
$("#btnArticleShow").click(function(){
	if($("#articleShowDiv").css("display")=="none"){
		$("#articleShowDiv").css("display","block");
		$("#commentShowDiv").css("display","none");
		$("#userShowDiv").css("display","none");
	}else{
		$("#articleShowDiv").css("display","none");
	}
});
</script>