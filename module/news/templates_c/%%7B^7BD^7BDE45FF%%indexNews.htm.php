<?php /* Smarty version 2.6.18, created on 2009-08-06 21:48:22
         compiled from block/indexNews.htm */ ?>
<div id="news_content_top">
  <a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/index.php"><div id="a_more">More</div></a>
</div>
<div id="news_content_center">
<?php $_from = $this->_tpl_vars['block']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news']):
?>
  <span class="news_title"><a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/index.php?news_no=<?php echo $this->_tpl_vars['news']['news_no']; ?>
" title="<?php echo $this->_tpl_vars['news']['title']; ?>
"><?php if ($this->_tpl_vars['news']['top'] == 1): ?><span style="color: #FFFF00; font-weight: bold;">[重要]</span><?php endif; ?><span class="white_font"><?php echo $this->_tpl_vars['news']['title']; ?>
</span></a></span>
  <span class="news_date"><?php echo $this->_tpl_vars['news']['date']; ?>
</span>
  <br />
<?php endforeach; endif; unset($_from); ?>
</div>
<div id="news_content_footer"></div>

