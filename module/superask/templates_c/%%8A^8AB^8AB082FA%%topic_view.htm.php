<?php /* Smarty version 2.6.18, created on 2009-07-29 08:12:35
         compiled from topic_view.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlencode', 'topic_view.htm', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topic_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="topic_view">
<div class="menu_link_top">
	<div style="float:right;margin:10px 7px 5px 0px;background:#FF3;"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/forum/viewboard.php?no=<?php echo $this->_tpl_vars['_WikiTopic']->tno; ?>
">我有問題!</a></div>
<?php if (( $this->_tpl_vars['_WikiPost']->pno != $this->_tpl_vars['_WikiTopic']->currpost->pno )): ?>
    <div class="menu_link"><a href="view.php?pno=<?php echo $this->_tpl_vars['_WikiTopic']->currpost->pno; ?>
" title="目前版本" class="menu">目前版本</a></div>
<?php else: ?>
    <div class="menu_link"><a href="allversion.php?tno=<?php echo $this->_tpl_vars['_WikiTopic']->tno; ?>
" title="編修紀錄" class="menu">編修紀錄</a></div>
<?php endif; ?>
    <?php if (( $this->_tpl_vars['curruser']->g_handler->isGroupAdmin($this->_tpl_vars['_WikiTopic']->gno,$this->_tpl_vars['curruser']->uno) ) || $this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?>
        <div class="menu_link"><a href="do_topic.php?newpost=1&pno=<?php echo $this->_tpl_vars['_WikiPost']->pno; ?>
" title="編輯" class="menu">編輯</a></div>
    <?php endif; ?>
</div>
<div class="topic_view_title"><a name="topic_top"></a><?php echo ((is_array($_tmp=$this->_tpl_vars['_WikiTopic']->title)) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
</div>
    <div class="topic_view_field">
        <?php echo $this->_tpl_vars['_WikiPost']->content(); ?>

    </div>
    <hr id="topic_hr"/>
    <div style="text-align:right; margin-right:63px;"><a href="#topic_top" class="menu">TOP&#9650;</a></div>
    <?php if (! ( $this->_tpl_vars['curruser']->isguest() )): ?>
<div class="menu_link_top">
        <div class="menu_link"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/group.php?gno=<?php echo $this->_tpl_vars['_WikiTopic']->gno; ?>
&apply=1" title="加入此行事曆" class="menu">加入此行事曆</a></div>
</div>
    <?php endif; ?>
    <?php if (( $this->_tpl_vars['curruser']->g_handler->isGroupAdmin($this->_tpl_vars['_WikiTopic']->gno,$this->_tpl_vars['curruser']->uno) ) || $this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?>
    <div class="caledit"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/actAdd-sample.php<?php if ($_GET['userType'] == 'G'): ?>?n=<?php echo $_GET['no']; ?>
<?php endif; ?>"><span>新增</span></a></div>
    <?php endif; ?>
    <?php echo $this->_tpl_vars['cal_block']; ?>

</div>