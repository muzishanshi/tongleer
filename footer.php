<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="side-button">
	<ul>
		<li id="go-top" class="am-icon-btn am-icon-arrow-up"></li>
		<li id="go-bottom" class="am-icon-btn am-icon-arrow-down"></li>
		<!--侧滑评论所需开始-->
		<?php if ($this->is('post')||$this->is('page')) : ?>
		<li id="ex-comment" class="am-icon-btn am-icon-comments"></li>
		<?php endif; ?>
		<!--侧滑评论所需结束-->
	</ul>
</div>
<!-- footer -->
<footer class="am-footer am-footer-default">
	<div class="am-footer-miscs ">
		<?=printFriends($this->options->friendlink);?>
    </div>
	<div class="am-footer-miscs ">
		<!--尊重以下网站版权是每一个合法公民应尽的义务，请不要去除以下版权。-->
		<p>
			CopyRight©<?=date("Y");?> <a href="<?=$this->options ->siteUrl();?>"><?php $this->options->title();?></a> Powered by <a href="http://typecho.org/" title="Typecho" target="_blank" rel="nofollow">Typecho</a> Theme By <a id="rightdetail" href="http://www.tongleer.com" target="_blank" title="同乐儿">Tongleer</a>
		</p>
    </div>
	<div style="display:none;"><?=$this->options->foot_count;?></div>
</footer>
<?php if($this->options->is_pjax=='y'){?>
<!--pjax刷新开始-->
<style>
.pjax_loading {position: fixed;top: 45%;left: 45%;display: none;z-index: 999999;width: 124px;height: 124px;background: url('<?php $this->options->themeUrl('assets/images/pjax_loading.gif'); ?>') 50% 50% no-repeat;}
.pjax_loading1 {position: fixed;top: 0;left: 0;z-index: 999999;display: none;width: 100%;height: 100%;opacity: .2}
</style>
<script src="https://cdn.bootcss.com/jquery.pjax/1.9.5/jquery.pjax.min.js"></script>
<script type="text/javascript" language="javascript">
$(function() {
	$(document).pjax('a[target!=_blank]', '#content', {fragment:'#content', timeout:6000});
	$(document).on('submit', 'form', function (event) {
		$.pjax.submit(event, '#content', {fragment:'#content', timeout:6000});
	});
	$(document).on('pjax:send', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "block");
	});
	$(document).on('pjax:complete', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "none");
		$("#side-button ul #ex-comment").remove();
		if($("#exist-comment").val()){
			$("#side-button ul").append('<li id="ex-comment" class="am-icon-btn am-icon-comments"></li>');
			if(window.location.href.indexOf("#comment-")>-1) {
				$("#post-comments").addClass("comment-open");
			}
			$("#ex-comment").click(function() {
				$("#post-comments").toggleClass("comment-open");
			});
		}
		if(window.location.href.indexOf("comment")!=-1){
			$("#submitComment").attr("type","button");
			$("#submitComment").text("浏览器后退后继续评论");
			$("#submitComment").attr("onClick","window.history.go(-1);");
		}
		if(window.location.href.indexOf("logout")!=-1){
			location.href="<?=$this->options ->siteUrl();?>";
		}
		
		window.TypechoComment = {
			dom : function (id) {
				return document.getElementById(id);
			},
		
			create : function (tag, attr) {
				var el = document.createElement(tag);
			
				for (var key in attr) {
					el.setAttribute(key, attr[key]);
				}
			
				return el;
			},

			reply : function (cid, coid) {
				var comment = this.dom(cid), parent = comment.parentNode,
					response = this.dom('<?php echo $this->respondId(); ?>'), input = this.dom('comment-parent'),
					form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
					textarea = response.getElementsByTagName('textarea')[0];

				if (null == input) {
					input = this.create('input', {
						'type' : 'hidden',
						'name' : 'parent',
						'id'   : 'comment-parent'
					});

					form.appendChild(input);
				}

				input.setAttribute('value', coid);

				if (null == this.dom('comment-form-place-holder')) {
					var holder = this.create('div', {
						'id' : 'comment-form-place-holder'
					});

					response.parentNode.insertBefore(holder, response);
				}

				comment.appendChild(response);
				this.dom('cancel-comment-reply-link').style.display = '';

				if (null != textarea && 'text' == textarea.name) {
					textarea.focus();
				}

				return false;
			},

			cancelReply : function () {
				var response = this.dom('<?php echo $this->respondId(); ?>'),
				holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

				if (null != input) {
					input.parentNode.removeChild(input);
				}

				if (null == holder) {
					return true;
				}

				this.dom('cancel-comment-reply-link').style.display = 'none';
				holder.parentNode.insertBefore(response, holder);
				return false;
			}
		};
		
		var event = document.addEventListener ? {
			add: 'addEventListener',
			triggers: ['scroll', 'mousemove', 'keyup', 'touchstart'],
			load: 'DOMContentLoaded'
		} : {
			add: 'attachEvent',
			triggers: ['onfocus', 'onmousemove', 'onkeyup', 'ontouchstart'],
			load: 'onload'
		}, added = false;

		document[event.add](event.load, function () {
			var r = document.getElementById('<?php echo $this->respondId(); ?>'),
				input = document.createElement('input');
			input.type = 'hidden';
			input.name = '_';
			input.value = (function () {
		var _CSn = '9'//'JTK'
	+'44'//'x'
	+'R'//'R'
	+//'q0'
	'b'+'RrD'//'RrD'
	+'4e'//'7'
	+//'o6O'
	'02b'+'e'//'lq'
	+//'u'
	'u'+//'H'
	'57a'+'b1'//'B'
	+/* 'lFg'//'lFg' */''+//'v'
	'18'+//'Z9'
	'Z9'+//'c18'
	'6'+/* 'ID'//'ID' */''+//'75o'
	'3'+'1'//'KRN'
	+/* '4E3'//'4E3' */''+'426'//'jIn'
	+//'L'
	'L'+//'Ui'
	'0a'+'2'//'7a'
	+'0'//'gKh'
	+'2'//'cY'
	+/* 'FTc'//'FTc' */''+//'x'
	'8a'+'b'//'J'
	+'d'//'CD'
	, _cHLK = [[3,4],[4,7],[10,11],[17,19],[23,24]];
		
		for (var i = 0; i < _cHLK.length; i ++) {
			_CSn = _CSn.substring(0, _cHLK[i][0]) + _CSn.substring(_cHLK[i][1]);
		}

		return _CSn;
	})();

			if (null != r) {
				var forms = r.getElementsByTagName('form');
				if (forms.length > 0) {
					function append() {
						if (!added) {
							forms[0].appendChild(input);
							added = true;
						}
					}
				
					for (var i = 0; i < event.triggers.length; i ++) {
						var trigger = event.triggers[i];
						document[event.add](trigger, append);
						window[event.add](trigger, append);
					}
				}
			}
		});
	});
});
</script>
<div class="pjax_loading"></div>
<div class="pjax_loading1"></div>
<!--pjax刷新结束-->
<?php }?>
<?php if($this->options->is_play=='y'){?>
<!--音乐播放器开始-->
<link href="https://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/smusic/css/smusic.css'); ?>"/>
<div class="grid-music-container f-usn" id="music">
	<a id="hidemusic" href="#" onClick="doAct();"><i class="fa fa-music suo"></i></a>
    <div class="m-music-play-wrap">
        <div class="u-cover"></div>
        <div class="m-now-info">
            <h1 class="u-music-title"><strong>标题</strong><small>歌手</small></h1>
            <div class="m-now-controls">
                <div class="u-control u-process">
                    <span class="buffer-process"></span>
                    <span class="current-process"></span>
                </div>
                <div class="u-control u-time">00:00/00:00</div>
                <div class="u-control u-volume">
                    <div class="volume-process" data-volume="0.50">
                        <span class="volume-current"></span>
                        <span class="volume-bar"></span>
                        <span class="volume-event"></span>
                    </div>
                    <a class="volume-control"></a>
                </div>
            </div>
            <div class="m-play-controls">
                <a class="u-play-btn prev" title="上一曲"></a>
                <a class="u-play-btn ctrl-play play" title="暂停"></a>
                <a class="u-play-btn next" title="下一曲"></a>
                <a class="u-play-btn mode mode-list <?php if($this->options->is_play_defaultMode==1){?>current<?php }?>" title="列表循环"></a>
                <a class="u-play-btn mode mode-random <?php if($this->options->is_play_defaultMode==2){?>current<?php }?>" title="随机播放"></a>
                <a class="u-play-btn mode mode-single <?php if($this->options->is_play_defaultMode==3){?>current<?php }?>" title="单曲循环"></a>
            </div>
        </div>
    </div>
    <div class="f-cb">&nbsp;</div>
    <div class="m-music-list-wrap" style="display:none;"></div>
    <div class="m-music-lyric-wrap" style="display:none;">
        <div class="inner">
            <ul class="js-music-lyric-content">
                <li class="eof">暂无歌词...</li>
            </ul>
        </div>
    </div>
</div>
<script>
function doAct(){
	var s=document.getElementById('hidemusic');
	var t = document.getElementById('music'),
	c = s.className;
	if(c != null && c.indexOf('more') > -1){
		s.className = c.replace('more', '');
		t.className = t.className.replace('grid-music-container-active', '');
	}else{
		s.className = c + ' more';
		t.className = t.className + ' grid-music-container-active';
		var t=setTimeout("doAct()",5000);
	}
}
</script>
<script src="<?php $this->options->themeUrl('assets/smusic/js/smusic.js'); ?>"></script>
<script>
	var musicList = <?=$this->options->playjson;?>;
	new SMusic({
        musicList : musicList,
        autoPlay  : <?=$this->options->is_play_auto;?>,  /*是否自动播放*/
        defaultMode : <?=$this->options->is_play_defaultMode;?>,   /*默认播放模式，随机*/
        callback   : function (obj) {  /*返回当前播放歌曲信息*/
            console.log(obj);
        }
    });
</script>
<!--音乐播放器结束-->
<?php }?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.ias.min.js'); ?>" type="text/javascript"></script>
<!--[if lt IE 9]>-->
<script src="https://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/amazeui.ie8polyfill.min.js'); ?>"></script>
<!--[endif]-->
<script src="<?php $this->options->themeUrl('assets/js/amazeui.widgets.helper.min.js'); ?>" type="text/javascript"></script>
<script src="<?php $this->options->themeUrl('assets/js/amazeui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php $this->options->themeUrl('assets/js/app.js'); ?>"></script>
<script>
/*侧滑评论所需开始*/
$(function() {
	if(window.location.href.indexOf("#comment-")>-1) {
		$("#post-comments").addClass("comment-open");
	}
	$("#ex-comment").click(function() {
		$("#post-comments").toggleClass("comment-open");
	});
});
/*侧滑评论所需结束*/
/*goToTop*/
$(function(){
	$("#go-top").hide();
	$(window).scroll(function(){
		if($(this).scrollTop() > 100){
			$('#go-top').fadeIn();
		}else{
			$('#go-top').fadeOut();
		}
	});
	$('#go-top').click(function(){
		$('html ,body').animate({scrollTop: 0}, 300);
		return false;
	});
});
/*goToBottom*/
$(function(){
	$(window).scroll(function(){
		if($(this).scrollTop() > (document.body.scrollHeight - 1000)) {
			$('#go-bottom').fadeOut();
		}else{
			$('#go-bottom').fadeIn();
		}
	});
	$('#go-bottom').click(function(){
		$('html ,body').animate({scrollTop: document.body.scrollHeight}, 300);
		return false;
	});
});
</script>
<?php $this->footer(); ?>
</body>
</html>