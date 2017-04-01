<?php /* Smarty version 2.6.18, created on 2009-08-12 18:19:10
         compiled from admin_main.html */ ?>
<table width="652" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="64" colspan="2" valign="top" background="templates/images/bg_1_top.gif">&nbsp;</td>
  </tr>
  <tr>
    <td width="318" valign="top" background="templates/images/bg_2_left.gif">
    <table width="318" border="0" cellspacing="0" cellpadding="0">
    <?php unset($this->_sections['dis']);
$this->_sections['dis']['name'] = 'dis';
$this->_sections['dis']['loop'] = is_array($_loop=$this->_tpl_vars['opt_list_dis']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dis']['show'] = true;
$this->_sections['dis']['max'] = $this->_sections['dis']['loop'];
$this->_sections['dis']['step'] = 1;
$this->_sections['dis']['start'] = $this->_sections['dis']['step'] > 0 ? 0 : $this->_sections['dis']['loop']-1;
if ($this->_sections['dis']['show']) {
    $this->_sections['dis']['total'] = $this->_sections['dis']['loop'];
    if ($this->_sections['dis']['total'] == 0)
        $this->_sections['dis']['show'] = false;
} else
    $this->_sections['dis']['total'] = 0;
if ($this->_sections['dis']['show']):

            for ($this->_sections['dis']['index'] = $this->_sections['dis']['start'], $this->_sections['dis']['iteration'] = 1;
                 $this->_sections['dis']['iteration'] <= $this->_sections['dis']['total'];
                 $this->_sections['dis']['index'] += $this->_sections['dis']['step'], $this->_sections['dis']['iteration']++):
$this->_sections['dis']['rownum'] = $this->_sections['dis']['iteration'];
$this->_sections['dis']['index_prev'] = $this->_sections['dis']['index'] - $this->_sections['dis']['step'];
$this->_sections['dis']['index_next'] = $this->_sections['dis']['index'] + $this->_sections['dis']['step'];
$this->_sections['dis']['first']      = ($this->_sections['dis']['iteration'] == 1);
$this->_sections['dis']['last']       = ($this->_sections['dis']['iteration'] == $this->_sections['dis']['total']);
?>
      <tr>
        <td width="58">
        <a href="admin_process.php?action=delete&rwoID=<?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwoID']; ?>
"><span class="text_delete">[刪除]</span></a><br />
        <a href="admin_manage_url.php?action=editurl&rwoID=<?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwoID']; ?>
"><span class="text_url">[相關連結]</span></a><br /><br />
        </td>
        <td width="5">&nbsp;</td>
        <td width="255"><a href="admin_manage_add.php?action=modify&rwoID=<?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwoID']; ?>
"><span class="necessary"><?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwo_name']; ?>
</span></a><br /><span class="column_title"><?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwo_type_display']; ?>
(<?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['dis']['index']]['rwo_date_display']; ?>
)</span><br /><br /></td>
      </tr>
    <?php endfor; endif; ?>
    </table>
    </td>
    <td width="334" valign="top" class="td_2_full_right">
    <div id="td_2_right_admin"></div>
    <a href="admin_main.php"><img border="0" src="templates/images/admin_btn_opt_manage.gif" alt="管理端首頁" /></a><br />
    <a href="admin_manage_add.php"><img border="0" src="templates/images/admin_btn_opt_add.gif" alt="選項新增" /></a><br />
    </td>
  </tr>
</table>