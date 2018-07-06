<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!-- footer -->
<footer class="am-footer am-footer-default">
	<div class="am-footer-miscs ">
		<?=$this->options->config_foot_info();?>
    </div>
    <div class="am-footer-miscs ">
        <p>
			CopyRight©2018 <a href="<?=$this->options ->siteUrl();?>"><?php $this->options->title();?></a>
		</p>
    </div>
	<div class="am-footer-miscs ">
		<!--尊重以下网站版权是每一个合法公民应尽的义务，请不要去除以下版权。-->
		<p>
			Powered by <a href="http://typecho.org/" title="Typecho" rel="nofollow">Typecho</a> Theme By <a id="rightdetail" href="http://www.tongleer.com" title="同乐儿">同乐儿</a>
		</p>
    </div>
	<div style="display:none;"><?=$this->options->config_foot_count();?></div>
</footer>
<!--[if lt IE 9]>-->
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/amazeui.ie8polyfill.min.js'); ?>"></script>
<!--[endif]-->
<script src="<?php $this->options->themeUrl('assets/js/amazeui.widgets.helper.min.js'); ?>" type="text/javascript"></script>
<script src="<?php $this->options->themeUrl('assets/js/amazeui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php $this->options->themeUrl('assets/js/app.js'); ?>"></script>
</body>
</html>