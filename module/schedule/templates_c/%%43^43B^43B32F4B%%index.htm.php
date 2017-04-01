<?php /* Smarty version 2.6.18, created on 2009-08-04 00:24:07
         compiled from index.htm */ ?>
<?php if (( ! $this->_tpl_vars['curruser']->isguest() )): ?>
<div class="blue_back">
	<div class="field_top_top">
		<img src="templates/images/calendar.gif" class="field_title" alt="" />
		<div class="caledit" style="margin: -20px 0px 80px 470px;float:none;"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/actAdd-sample.php<?php if ($_GET['userType'] == 'G'): ?>?n=<?php echo $_GET['no']; ?>
<?php endif; ?>"><span>新增</span></a></div>
		<div style="margin-left: 95px; margin-top: -55px;"><?php echo $this->_tpl_vars['currconfig']->nowtime; ?>
</div>
	</div>
<div style="margin-right:40px">
	<?php echo $this->_tpl_vars['c_block']; ?>

	<div style="width:80%;color:white;margin:10px auto 0;font-size:18pt">
		我的訂閱
		<div style="height:2px;background:white;font-size:0"></div>
		<div style="text-align:right;font-size:12pt;">勾選後按delete刪除訂閱</div>
	</div>
	<?php echo $this->_tpl_vars['c_block2']; ?>

</div>

</div>
<?php else: ?>
請先登入再使用此功能
<?php endif; ?>