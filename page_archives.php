<?php
/**
 * 页面存档
 *
 * @package custom
 */
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
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
<section class="page-main">
	<ol class="am-breadcrumb">
		<li><a href="<?=$this->options ->siteUrl();?>" class="am-icon-home">首页</a></li>
		<li class="am-active"><?php $this->title(); ?></li>
	</ol>
	<div class="am-article-hd">
		<h1 class="am-article-title"><?php $this->title(); ?></h1>
		<p class="am-article-meta">
			<div>
				<small>
					<a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> 发布 | <?php $this->date('Y-m-d'); ?> | 评论数：<?php $this->commentsNum('0', '1', '%d'); ?> | 标签：<?php $this->tags(',', true, '<a>没有标签</a>'); ?>
				</small>
			</div>
		</p>
	</div>
	<div class="am-panel-group" id="accordion">
	  <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);?>
	  <?php
		$i=1;$year=0; $mon=0;
		$output = "";
		while($archives->next()):
		$year_tmp = date('Y',$archives->created);
		$mon_tmp = date('m',$archives->created);
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
					<div class=\"am-panel-hd\">
						<h4 class=\"am-panel-title\" data-am-collapse=\"{parent: '#accordion', target: '#do-not-say-".$i."'}\">".$year."年".$mon."月
						</h4>
					</div>
					<div id=\"do-not-say-".$i."\" class=\"am-panel-collapse am-collapse\">
						<div class=\"am-panel-bd\">
							<ul>
			";
        }
		$output .= "
			<li>时间：<time>".date('d日',$archives->created)."</time>&nbsp;&nbsp;标题：<a href=\"".$archives->permalink."\">".$archives->title."</a>&nbsp;&nbsp;评论数：(".$archives->commentsNum.")</li>
		";
		$i++;
		endwhile;
		echo $output.'
					</ul>
				</div>
			</div>
		</div>
		';
	  ?>
	</div>
</section>
<?php $this->need('footer.php'); ?>