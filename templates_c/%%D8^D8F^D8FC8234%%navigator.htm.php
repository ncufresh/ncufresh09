<?php /* Smarty version 2.6.18, created on 2010-07-01 23:35:58
         compiled from block/navigator.htm */ ?>

  <div id="img_btn_bar" align="right">
    <a id="img_btn01" <?php echo $this->_tpl_vars['block']['btn_addcss']['mustknow']; ?>
 title="大一必讀" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/mustknow"></a>
    <a id="img_btn02" <?php echo $this->_tpl_vars['block']['btn_addcss']['campus']; ?>
 title="中大校園" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/campus"></a>
    <a id="img_btn03" <?php echo $this->_tpl_vars['block']['btn_addcss']['nculife']; ?>
 title="中大生活" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/nculife"></a>
    <a id="img_btn04" <?php echo $this->_tpl_vars['block']['btn_addcss']['forum']; ?>
 title="系所社團" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/forum"></a>
    <a id="img_btn05" <?php echo $this->_tpl_vars['block']['btn_addcss']['QA']; ?>
 title="新生論壇" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/QA"></a>
    <a id="img_btn06" <?php echo $this->_tpl_vars['block']['btn_addcss']['regwizard']; ?>
 title="註冊精靈" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/regwizard"></a>
    <a id="img_btn07" <?php echo $this->_tpl_vars['block']['btn_addcss']['aboutus']; ?>
 title="關於我們" href="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/module/aboutus"></a>
  </div>
  
  <div id="img_status_bar" align="center" style="background-image:url(<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/<?php echo $this->_tpl_vars['block']['content_top']['bg']; ?>
); height:<?php echo $this->_tpl_vars['block']['content_top']['height']; ?>
px;">
  <?php $_from = $this->_tpl_vars['block']['bar_lnk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bar_lnk']):
?>
  <?php echo $this->_tpl_vars['bar_lnk']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php endforeach; endif; unset($_from); ?>
  </div>
  
  <?php if ($this->_tpl_vars['block']['content_top']['type'] == 'ws'): ?>
  <div id="content_top_ws">
    <div id="content_top_path">
	  <img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/breadcrumbsIcon.gif" alt="路徑" /> <span class="main_link"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
">09 知訊網首頁</a><?php $_from = $this->_tpl_vars['block']['currsite']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['site']):
?> &gt; <a href="<?php echo $this->_tpl_vars['site']['url']; ?>
"><?php echo $this->_tpl_vars['site']['name']; ?>
</a><?php endforeach; endif; unset($_from); ?></span>
    </div>
    
    <div id="content_top_schedule">
      <!--<div id="content_top_schedule_l"><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s01.png" alt="新生史卡舅" /></div>-->
      <div id="content_top_schedule_l"><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/closed.png" alt="Closed"/><br /></div>
      <!--<div id="content_top_schedule_r"><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s03.png" alt="登錄學籍資料" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s02.png" alt="宿舍查詢" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s04.png" alt="第二階段初選" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s05.png" alt="繳交學雜費" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s06.png" alt="新生宿舍進住" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s07.png" alt="英文分級測驗" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s08.png" alt="院系時間" /><br /><br /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s09.png" alt="中大超級新生營" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s10.png" alt="體檢及適應訓練" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s12.png" alt="註冊並開始上課" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s13.png" alt="大一國文寫作檢定" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s11.png" alt="繳交兵役資料" /><img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/s14.png" alt="課程加退選" /></div>-->
    </div>
  </div>
  <?php else: ?>
  <div id="content_top_nws">
    <div id="content_top_path">
	  <img src="<?php echo $this->_tpl_vars['block']['currconfig_url']; ?>
/templates/images/breadcrumbsIcon.gif" alt="路徑" /> <span class="main_link"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
">09 知訊網首頁</a><?php $_from = $this->_tpl_vars['block']['currsite']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['site']):
?> &gt; <a href="<?php echo $this->_tpl_vars['site']['url']; ?>
"><?php echo $this->_tpl_vars['site']['name']; ?>
</a><?php endforeach; endif; unset($_from); ?></span>
    </div>
  </div>
  <?php endif; ?>