<?php /* Smarty version 2.6.18, created on 2009-08-06 22:45:57
         compiled from new.tpl.php */ ?>
﻿<div id="FB_MAIN_OUTER">
	<div id="FB_divideBAR"></div>
	<div id="FB_content">
		<form action="<?php if ($this->_tpl_vars['modify']): ?><?php echo $this->_tpl_vars['modify']['url']; ?>
<?php else: ?>./newquest.php<?php endif; ?>" method="post" >
		標題:
		<?php if ($this->_tpl_vars['modify']['title']): ?>
		<?php echo $this->_tpl_vars['modify']['title']; ?>

		<?php else: ?>
		<input name="title" type="text" />
		<?php endif; ?><br /><br />
		<div><div id="NQContent">內容:</div>
		<textarea rows="10" cols="90" name="content"><?php echo $this->_tpl_vars['modify']['content']; ?>
</textarea><br /><br />
		</div>
	<div id="FB_submit"><input type="submit" value="確定" />
	<?php if ($this->_tpl_vars['modify']): ?>
	<input type="hidden" value="<?php echo $this->_tpl_vars['modify']['ano']; ?>
" name="ANO"/>
	<input type="hidden" value="update" name="mode"/>
	<?php endif; ?>
	<input type="hidden" value="<?php echo $this->_tpl_vars['FNO']; ?>
" name="FNO"/>
	<input type="submit" name="submitVal" value="取消" /><input name="" type="reset" /></div>
	</form>
	</div>
</div>