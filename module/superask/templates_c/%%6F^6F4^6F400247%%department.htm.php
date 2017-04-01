<?php /* Smarty version 2.6.18, created on 2009-07-27 15:01:43
         compiled from department.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlencode', 'department.htm', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topic_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cate_field">
  <div class="cate_menu_top">
    <?php $_from = $this->_tpl_vars['cate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cate'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cate']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pcat']):
        $this->_foreach['cate']['iteration']++;
?>
    <div class="cate_<?php if ($this->_foreach['cate']['iteration'] % 2 == 0): ?>1<?php else: ?>2<?php endif; ?>">
       <div class="pcat_menu"><?php echo ((is_array($_tmp=$this->_tpl_vars['pcat']['name'])) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
</div>
       <div class="cate_menu">
	       <table ><tr>
       <?php $_from = $this->_tpl_vars['pcat']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ccat']):
        $this->_foreach['child']['iteration']++;
?>
       <td class="child<?php if (($this->_foreach['child']['iteration'] == $this->_foreach['child']['total']) && $this->_foreach['child']['iteration']%4 != 0): ?>2<?php endif; ?>" <?php if (($this->_foreach['child']['iteration'] == $this->_foreach['child']['total'])): ?>colspan="2"<?php endif; ?>>
	       <?php if ($this->_tpl_vars['ccat']['showlink'] == 1): ?>
	       <a href="view.php?tno=<?php echo $this->_tpl_vars['ccat']['tno']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['ccat']['title'])) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
" class="menu">
	       <?php endif; ?>
	       <?php echo ((is_array($_tmp=$this->_tpl_vars['ccat']['title'])) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>

	       <?php if ($this->_tpl_vars['ccat']['showlink'] == 1): ?>
               </a>
               <?php endif; ?>
       </td><?php if ($this->_foreach['child']['iteration']%4 == 0 && $this->_foreach['child']['iteration'] != 0): ?></tr><tr><?php endif; ?>
       <?php endforeach; endif; unset($_from); ?>
       </tr></table>
       </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
  </div>
  <br/>
</div>