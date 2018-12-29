<?php if(!defined( '__TYPECHO_ROOT_DIR__'))exit;?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title><?php $this->archiveTitle(array('category'=>_t(' %s '),'search'=>_t(' %s '),'tag'=>_t(' %s '),'author'=>_t(' %s ')),'',' - ');?><?php $this->options->title();?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <meta name="author" content="<?php $this->options->title(); ?>">
  <meta name="description" itemprop="description" content="<?php $this->options->description(); ?>">
  <meta name="keywords" content="<?php $this->options->keywords(); ?>">
  <link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>" />
  <link rel="apple-touch-icon" href="<?=$this->options->favicon;?>" type="image/png" />
  <link rel="alternate icon" href="<?=$this->options->favicon;?>" type="image/png" />
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/amazeui.min.css'); ?>"/>
  <!--[if lt IE 9]>-->
  <script src="https://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
  <!--[endif]-->
  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="<?php $this->options->themeUrl('assets/js/jquery.min.js'); ?>"></script>
  <!--<![endif]-->
  <?php $this->header(); ?>
</head>
<body style="background-image: url('<?=$this->options->pagebg;?>');">
<style>
.banner-head{
	background-image: url(https://ws3.sinaimg.cn/large/ecabade5ly1fxqhgnclydj21hc0u0wn1.jpg);
	width:960px;
	margin:10px auto -10px auto;
	text-align: center;
	padding:30px;
	color:#fff;
}
.banner-nav{
	width:960px;
	margin:0px auto 15px auto;
	text-align: center;
	background-color:#fff;
	border:1px solid #eee;
}
.banner-nav button{
	background-color:#fff;
	font-size:90%;
}
@media screen and (max-width: 960px) {
	.banner-head {width: 100%;}
	.banner-nav {width: 100%;}
}
</style>
<!-- navigation panel -->
<header class="am-topbar am-topbar-fixed-top" style="opacity:0.9;">
  <div class="am-container">
	<h1 class="am-topbar-brand">
	  <a href="<?=$this->options ->siteUrl();?>"><?php $this->options->title();?></a>
	</h1>
	
	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only" data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
        class="am-icon-bars"></span></button>

	<div class="am-topbar-collapse am-collapse" id="collapse-head">
	  <ul class="am-nav am-nav-pills am-topbar-nav">
		<li>
			<a href="<?=$this->options ->siteUrl();?>"><span class="am-icon-home"></span>首页</a>
		</li> 
		<?php
		  $othernav=json_decode($this->options->othernav,true);
		  if(isset($othernav)){
			foreach($othernav as $val){
				if($val["name"]!=null&&$val["link"]!=null){
				?>
				<li>
					<a href="<?=$val["link"];?>" target="_blank" rel="nofollow"><span class="am-icon-<?=$val["icon"];?>"></span><?=$val["name"];?></a>
				</li> 
				<?php
				}
			}
		  }
		?>
	  </ul>
	  <?php if(!$this->user->hasLogin()){ ?>
	  <div class="am-topbar-right">
        <div class="am-topbar-btn">
			<span class="am-icon-user"></span> <a href="javascript:;"id="login-prompt-toggle">登录</a>
		</div>
      </div>
	  <?php }else{?>
      <div class="am-topbar-right">
        <div class="am-topbar-btn">
			<span class="am-icon-user"></span><a href="<?=$this->options ->siteUrl();?>admin"><?=$this->user->name();?></a>
		</div>
      </div>
	  <?php }?>
	</div>
  </div>
</header>
<div class="am-modal am-modal-prompt" tabindex="-1" id="login-prompt">
  <div class="am-modal-dialog">
	<form class="am-form" id="loginForm" method="post" action="<?php $this->options->loginAction(); ?>">
	<div class="am-modal-hd">登录</div>
	<div class="am-modal-bd">
	  <a href="<?php $this->options->adminUrl(); ?>register.php">新用户注册</a>
	  <fieldset class="am-form-set">
	  <input type="text" name="name" class="am-modal-prompt-input" placeholder="用户名">
	  <input type="password" name="password" class="am-modal-prompt-input" placeholder="密码">
	  <input type="hidden" name="referer" value="<?php echo htmlspecialchars($this->request->get('referer')); ?>" />
	  <input type="checkbox" name="remember" class="checkbox" value="1" id="remember" />
	  </fieldset>
	</div>
	<div class="am-modal-footer">
	  <span class="am-modal-btn" data-am-modal-cancel>取消</span>
	  <span class="am-modal-btn" data-am-modal-confirm>登录</span>
	</div>
	</form>
  </div>
</div>
<!--end navigation panel -->
<section class="banner-head" style="background-image:url('<?=$this->options->headBg;?>')">
	<img class="am-circle" src="<?=$this->options->headImgUrl;?>" width="100" height="100"/><br />
	<span>
		<?=$this->options->nickname;?>
		<?php if($this->options->sex=='boy'){echo "♂";}else{echo "♀";};?>
	</span><br />
	<?php
	$userQuery= $this->db->select()->from('table.users');
	$userData = $this->db->fetchAll($userQuery);
	?>
	<small>关注 <?php $friendlink=json_decode($this->options->friendlink,true);echo count($friendlink); ?>  |  粉丝 <?php echo count($userData);?></small><br />
	<small><?php $this->options->description(); ?></small><br />
	<small>微博认证：<?php if($this->options->config_weiboname){echo $this->options->config_weiboname;}else{echo '同乐儿';}?></small>
	<div>
		<div class="am-dropdown" data-am-dropdown>
		  <button class="am-btn am-btn-warning am-radius am-btn-xs am-dropdown-toggle">关注</button>
		  <div class="am-dropdown-content">
			<img src="<?=$this->options->follow_qrcode;?>" width="150" height="150"/>
		  </div>
		</div>
		<button type="button" class="am-btn am-btn-warning am-radius am-btn-xs" onClick="location.href='<?=$this->options->home_link;?>';"><?=$this->options->home_name;?></button>
		<div class="am-dropdown" data-am-dropdown>
			<button class="am-btn am-btn-warning am-radius am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span
        class="am-icon-bars"></span></button>
		  <ul class="am-dropdown-content">
			<li><a href="<?=$this->options->other_1_link;?>" target="_blank"><?=$this->options->other_1_name;?></a></li>
		  </ul>
		</div>
	</div>
</section>
<div class="banner-nav">
	<div data-am-widget="tabs">
      <ul class="am-tabs-nav">
          <li><a class="am-btn am-radius" href="<?=$this->options ->siteUrl();?>"><small>主页</small></a></li>
		  <li><a class="am-btn am-radius" target="_blank" href="<?=$this->options->album_link;?>"><small><?=$this->options->album_name;?></small></a></li>
      </ul>
	</div>
</div>
<script>
$('#login-prompt-toggle').on('click', function() {
    $('#login-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
		$('#loginForm').submit();
      },
      onCancel: function(e) {}
    });
});
</script>