<?php /* Smarty version 2.6.18, created on 2010-07-02 00:15:54
         compiled from show_pfile.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlencode', 'show_pfile.htm', 15, false),array('modifier', 'nl2br', 'show_pfile.htm', 18, false),)), $this); ?>
<div id="profile">
  <div class="profile_title">帳號</div>
  <div class="profile_content"><?php echo $this->_tpl_vars['user']->uid; ?>
 (<?php if (( $this->_tpl_vars['user']->isonline() == 1 )): ?>正在線上<?php else: ?>不在線上<?php endif; ?>)</div>
  <br class="clear" />
  <div class="profile_title">暱稱</div>
  <div class="profile_content"><?php echo $this->_tpl_vars['user']->name; ?>
</div>
  <br class="clear" />
  <div class="profile_title">性別</div>
  <div class="profile_content"><?php echo $this->_tpl_vars['user']->sex; ?>
</div>
  <br class="clear" />
  <div class="profile_title">系所</div>
  <div class="profile_content"><?php echo $this->_tpl_vars['user']->department; ?>
</div>
  <br class="clear" />
  <div class="profile_title">首頁</div>
  <div class="profile_content"><?php if (( $this->_tpl_vars['user']->website )): ?><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['user']->website)) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
" target="_blank" title="個人首頁">請按我</a><?php else: ?>無<?php endif; ?></div>
  <br class="clear" />
  <div class="profile_title">自我介紹</div>
  <div class="profile_content"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->intro)) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
  <br class="clear" />
</div>