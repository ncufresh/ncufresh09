<?php /* Smarty version 2.6.18, created on 2009-08-06 23:18:50
         compiled from schModify-sample.htm */ ?>
<div class="blue_back">
	<div class="field_top_top">
		<img src="templates/images/edit.gif" class="field_title"/>
		<div style="margin: -20px 0px 80px 470px;float:none;font-size:14pt;">
			回到&gt;&gt;
			<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/redirect.php?1" style="color:black;text-decoration:none;margin:10px 0 0 20px;font-size:24pt;display:block;"><span>上一頁</span></a>
		</div>
	</div>

<div class="field_content_bar">修改事項</div>
<div class="field_content_content">
	<form id="actadd" method="post" action="?modify=1&sno=<?php echo $this->_tpl_vars['sch']['sno']; ?>
&ano=<?php echo $this->_tpl_vars['sch']['ano']; ?>
">
	<p>開始: <input type="text" name="start_date" value="<?php echo $this->_tpl_vars['sch']['start_date']; ?>
" /></p>
	<p>標題: <input type="test" name="title" value="<?php echo $this->_tpl_vars['sch']['subject']; ?>
" /></p>
	<p>內容: <textarea cols="40" rows="7" name="content"><?php echo $this->_tpl_vars['sch']['content']; ?>
</textarea></p>
	<p>連續: <input name="interval" value="<?php echo $this->_tpl_vars['sch']['contin']; ?>
" /> 天</p>
	<p><input type="submit" value="修改" /></p>
</form>
</div>
<div class="field_bottom"></div>

</div>