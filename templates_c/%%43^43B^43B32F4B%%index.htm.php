<?php /* Smarty version 2.6.18, created on 2010-07-01 23:58:47
         compiled from index.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['sitename']; ?>
</title>
<?php echo $this->_tpl_vars['hdr']; ?>

<?php echo $this->_tpl_vars['js']; ?>


<script type="text/javascript">
//var J=jQuery.noConflict();

J(document).ready(function() {
    var content = "<embed src=\"http://ncufresh.ncu.edu.tw/ncufresh09/templates/swf/Bfinal.swf\" loop=\"false\" quality=\"high\" bgcolor=\"#ffffff\" width=\"730\"  height=\"220\" name=\"bannerMain.swf\" align=\"middle\" allowScriptAccess=\"sameDomain\" wmode=\"transparent\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"/>";
    J('#flash_banner').html(content);
});  
</script>

<!--[if lte IE 6]>
 <div style="background-color:#DDECFF;margin:5px 0 5px 0;padding:3px 10px 3px 10px;border-color:#F6F6F6; border-style:solid;border-width:2px;">
 <p><font size="2"><strong>您好</strong>，您目前使用的是舊版的IE 6.0網路瀏覽器，
 建議使用更快、更好用的瀏覽器，以獲得更佳的瀏覽效果！
 如：
 <a target="_blank" href="http://www.google.com/toolbar/ie8/intl/zh-TW/">IE 8.0</a>、
 <a target="_blank" href="http://moztw.org/">Firefox</a>、
 <a target="_blank" href="http://www.google.com/chrome"><u>Google瀏覽器</u></a>
 </font>
 </p>
 </div>
 <![endif]-->
</head>

<body>
<div id="container">
  <div id="intro">
    <span class="intro_banner">
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/"><span class="main_link">回首頁</span></a>
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/map.php"><span class="main_link">網站地圖</span></a>
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/contact.php"><span class="main_link">聯絡我們</span></a>
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <!--<img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuPadng.gif" alt=" " />-->
      <span class="main_link">線上人數: <?php echo $this->_tpl_vars['currconfig']->online_users; ?>
</span>
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <span class="main_link">瀏覽總人數: <?php echo $this->_tpl_vars['currconfig']->total_guests; ?>
</span>
      <img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/menuLine.gif" alt="|" />
      <br />
	  <span id="flash_banner">
      <NoScript>
      <embed src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/swf/Bfinal.swf" loop="false" quality="high" bgcolor="#ffffff" width="730" height="220" name="bannerMain.swf" align="middle" allowScriptAccess="sameDomain" wmode="transparent" allowFullScreen="false" type="application/x-shockwave-flash" luginspage="http://www.macromedia.com/go/getflashplayer" />
      </NoScript>
      </span>
	<a id="backtoindex" href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/" title="回首頁"></a>
    </span>
    <span class="intro_login<?php if (! ( $this->_tpl_vars['curruser']->isguest() )): ?>_mm<?php endif; ?>">
	<?php $_from = $this->_tpl_vars['default_side_blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['default_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['default_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['block']):
        $this->_foreach['default_block']['iteration']++;
?>
	<?php echo $this->_tpl_vars['block']; ?>

	<?php endforeach; endif; unset($_from); ?>
    </span>
  </div>  
  
  <?php $_from = $this->_tpl_vars['default_top_blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
  <?php echo $this->_tpl_vars['block']; ?>

  <?php endforeach; endif; unset($_from); ?>
  
  <div id="content_blockside">
  <?php echo $this->_tpl_vars['content']; ?>

  </div>
  <br class="clear" />
</div>
<div id="footer">
  <center>主辦單位：國立中央大學&nbsp;學務處&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;承辦單位：諮商中心&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;執行單位：2009大一生活知訊網工作團隊<br />地址：桃園縣中壢市五權里2鄰中大路300號&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;電話：03-4227151 分機轉57261 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;版權所有：2009大一生活知訊網工作團隊</center>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
        var pageTracker = _gat._getTracker("UA-10121863-1");
            pageTracker._trackPageview();
} catch(err) {}
J(document).ready(function() {
	J(document).pngFix();
});
</script>
</body>
</html>