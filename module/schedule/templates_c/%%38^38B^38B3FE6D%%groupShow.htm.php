<?php /* Smarty version 2.6.18, created on 2009-08-06 21:20:45
         compiled from groupShow.htm */ ?>
<table border="1" cellpadding="10" cellspacing="0" style="margin: 0px auto; border-collapse: collapse; width: 500px;">
  <tr>
    <td width="25%">群組名稱</td>
    <td width="75%"><?php echo $this->_tpl_vars['group']['name']; ?>
 (<?php if (( $this->_tpl_vars['group']['public'] == 1 )): ?>公開<?php else: ?>隱藏<?php endif; ?>)</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $this->_tpl_vars['group']['introduce']; ?>
</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
<?php if (( $this->_tpl_vars['joined'] == 0 ) && ! ( $this->_tpl_vars['curruser']->isguest() )): ?>
      <a href="group.php?gno=<?php echo $this->_tpl_vars['group']['gno']; ?>
&apply=1" title="申請加入群組">申請加入群組</a>&nbsp;&nbsp;
<?php endif; ?>
<?php if (( $this->_tpl_vars['manager'] == 1 )): ?>
      <a href="member.php?gno=<?php echo $this->_tpl_vars['group']['gno']; ?>
" title="管理群組成員">管理群組成員</a>&nbsp;&nbsp;
<?php endif; ?>
	<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/redirect.php?1" title="回上一頁">回上一頁</a>
    </td>
  </tr>
</table>