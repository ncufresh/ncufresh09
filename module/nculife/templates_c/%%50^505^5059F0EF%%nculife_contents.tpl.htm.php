<?php /* Smarty version 2.6.18, created on 2009-08-03 23:39:42
         compiled from nculife_contents.tpl.htm */ ?>
<style type="text/css">
#nculife_cc_l a{		background-image: url(<?php echo $this->_tpl_vars['cat_arr']['cat_a_icon']; ?>
);}
#nculife_cc_l a:hover{	background-image: url(<?php echo $this->_tpl_vars['cat_arr']['cat_a_hover_icon']; ?>
);}
#nculife_cc_r_top_bg{	background-image: url(<?php echo $this->_tpl_vars['cat_arr']['cat_title_image']; ?>
);}
</style>
<div id="nculife_contents_container">
  <div id="nculife_cc_l" style="background-image:url(<?php echo $this->_tpl_vars['cat_arr']['cat_menuside_image']; ?>
);">
    <div id="nculife_cc_l_top_bg" style="background-image:url(<?php echo $this->_tpl_vars['cat_arr']['cat_favicon_image']; ?>
);"><?php echo $this->_tpl_vars['cat_arr']['cat_name']; ?>
</div>
    <br />&nbsp;
    <br />
    <?php unset($this->_sections['menu_lst']);
$this->_sections['menu_lst']['name'] = 'menu_lst';
$this->_sections['menu_lst']['loop'] = is_array($_loop=$this->_tpl_vars['list_menu_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['menu_lst']['show'] = true;
$this->_sections['menu_lst']['max'] = $this->_sections['menu_lst']['loop'];
$this->_sections['menu_lst']['step'] = 1;
$this->_sections['menu_lst']['start'] = $this->_sections['menu_lst']['step'] > 0 ? 0 : $this->_sections['menu_lst']['loop']-1;
if ($this->_sections['menu_lst']['show']) {
    $this->_sections['menu_lst']['total'] = $this->_sections['menu_lst']['loop'];
    if ($this->_sections['menu_lst']['total'] == 0)
        $this->_sections['menu_lst']['show'] = false;
} else
    $this->_sections['menu_lst']['total'] = 0;
if ($this->_sections['menu_lst']['show']):

            for ($this->_sections['menu_lst']['index'] = $this->_sections['menu_lst']['start'], $this->_sections['menu_lst']['iteration'] = 1;
                 $this->_sections['menu_lst']['iteration'] <= $this->_sections['menu_lst']['total'];
                 $this->_sections['menu_lst']['index'] += $this->_sections['menu_lst']['step'], $this->_sections['menu_lst']['iteration']++):
$this->_sections['menu_lst']['rownum'] = $this->_sections['menu_lst']['iteration'];
$this->_sections['menu_lst']['index_prev'] = $this->_sections['menu_lst']['index'] - $this->_sections['menu_lst']['step'];
$this->_sections['menu_lst']['index_next'] = $this->_sections['menu_lst']['index'] + $this->_sections['menu_lst']['step'];
$this->_sections['menu_lst']['first']      = ($this->_sections['menu_lst']['iteration'] == 1);
$this->_sections['menu_lst']['last']       = ($this->_sections['menu_lst']['iteration'] == $this->_sections['menu_lst']['total']);
?>
    <a href="index.php?t_ID=<?php echo $this->_tpl_vars['list_menu_arr'][$this->_sections['menu_lst']['index']]['t_ID']; ?>
"><?php echo $this->_tpl_vars['list_menu_arr'][$this->_sections['menu_lst']['index']]['t_name']; ?>
</a><br />
    <?php endfor; endif; ?>
  </div>
  <div id="nculife_cc_r">
    <div id="nculife_cc_r_top_bg" align="center"><?php echo $this->_tpl_vars['topic_arr']['t_name']; ?>
</div>
    <div id="nculife_cc_r_contents">
    <?php echo $this->_tpl_vars['topic_arr']['t_contents']; ?>

    <br />&nbsp;
    <br />&nbsp;
    <img src="<?php echo $this->_tpl_vars['cat_arr']['cat_end_image']; ?>
" alt="中大生活" />
    </div>
  </div>
</div>