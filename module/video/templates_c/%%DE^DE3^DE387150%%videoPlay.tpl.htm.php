<?php /* Smarty version 2.6.18, created on 2009-08-01 04:49:55
         compiled from videoPlay.tpl.htm */ ?>
<div class="bold"><?php echo $this->_tpl_vars['data']['name']; ?>
</div>
下載！

	<script type="text/javascript" src="swfobject.js"></script>
	<script type="text/javascript">
		swfobject.registerObject("player","9.0.98","expressInstall.swf");
	</script>

	<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="640" height="480">
		<param name="movie" value="player-viral.swf" />
		<param name="allowfullscreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="flashvars" value="file=<?php echo $this->_tpl_vars['data']['video']; ?>
&image=<?php echo $this->_tpl_vars['data']['image']; ?>
" />
		<object type="application/x-shockwave-flash" data="player-viral.swf" width="640" height="480">
			<param name="movie" value="player-viral.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<param name="flashvars" value="file=<?php echo $this->_tpl_vars['data']['video']; ?>
&image=<?php echo $this->_tpl_vars['data']['image']; ?>
" />
			<p><a href="http://get.adobe.com/flashplayer">Get Flash</a> to see this player.</p>
		</object>
	</object> 


	<br />
瀏覽人次：<?php echo $this->_tpl_vars['data']['browse']; ?>
<br />
檔案大小：<?php echo $this->_tpl_vars['data']['size']; ?>
 Mb<br />
內容介紹：<br />
<?php echo $this->_tpl_vars['data']['content']; ?>