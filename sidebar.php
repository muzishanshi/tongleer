<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?><?php include('config.php');?><?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?><style>.web-info{    margin: 10px 0 0 0;    font-size: 14px;    color: #444;    background-color: #fff;    padding:8px;    border: 1px solid #E1E8ED;    list-style: none;    overflow: hidden;}.web-info li{    width: 33%;    text-align: center;    float: left;    font-size: 13px;    letter-spacing: 1px;}li.frinum, li.vitnum {    border-right: 1px solid #EFEFEF;}.web-info span{    display: block;}@media screen and (max-width: 960px) {	.web-info {margin: 0 0 0 0;}}</style><div class="am-u-md-3 am-u-md-pull-9">    <div class="am-panel-group">			<section class="am-panel am-panel-default web-info">			<li class="frinum">				<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>				<a href="javascript:void(0)"><?php echo $stat->PublishedCommentsNum; ?>				<span>评论</span></a>			</li>			<li class="vitnum">				<a href="javascript:void(0)"><?php echo $config_totalUser; ?>				<span>粉丝</span></a>			</li>			<li class="ptnum">				<a href="javascript:void(0)"><?php echo $stat->PublishedPostsNum; ?>				<span>文章</span></a>			</li>					</section>				<section class="am-panel am-panel-default">			<ul class="am-list am-list-static am-list-border">			  <li>				<span><img src="<?php $this->options->themeUrl('assets/images/weiboauth.png'); ?>" /></span><br />				<small><?=$this->options->config_weiboname();?></small>			  </li>			  <li><i class="am-icon-map-marker am-icon-fw"></i><small><?=$this->options->config_address();?></small></li>			  <li><i class="am-icon-birthday-cake am-icon-fw"></i><small><?=$this->options->config_birthday();?></small></li>			  <li><i class="am-icon-info am-icon-fw"></i><small><?=$this->options->config_detail();?></small></li>			</ul>		</section>				<section class="am-panel am-panel-default">        <div class="am-panel-hd">热门文章</div>        <ul class="am-list blog-list">		  <?php getHotCommentsArticle(5);?>        </ul>      </section>	    </div></div>