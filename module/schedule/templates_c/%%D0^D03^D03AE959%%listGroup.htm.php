<?php /* Smarty version 2.6.18, created on 2009-08-04 00:24:07
         compiled from block/listGroup.htm */ ?>
<?php if (( ! $this->_tpl_vars['curruser']->isguest() )): ?>
<div class="list_group">
<table border="0" style="width:100%">
	<form action="memberChange.php?del=1" method="post">
	<?php $_from = $this->_tpl_vars['block']['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listGroup'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listGroup']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group']):
        $this->_foreach['listGroup']['iteration']++;
?>
<?php if (( $this->_foreach['listGroup']['iteration']%2 == 1 )): ?><tr><?php endif; ?>
	<td style="width:40%">
		<input style="margin:5px" type="checkbox" name="chk[]" value="<?php echo $this->_tpl_vars['group']['gno']; ?>
" /><a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/group.php?gno=<?php echo $this->_tpl_vars['group']['gno']; ?>
" title="<?php echo $this->_tpl_vars['group']['level']; ?>
"><?php echo $this->_tpl_vars['group']['name']; ?>
</a>	</td>
	<td style="width:10%"><img src="templates/images/<?php echo $this->_tpl_vars['group']['level']; ?>
.gif"/></td>
<?php if (( $this->_foreach['listGroup']['iteration']%2 == 0 )): ?></tr><?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_foreach['listGroup']['total'] % 2 == 1): ?> <td>&nbsp;</td></tr><?php endif; ?>
	<tr><td colspan="6" align="center">
		<input type="submit" value="DELETE"/>
	</td></tr>
	</form>
</table>
</div>
<?php endif; ?>