<?php /* Smarty version 2.6.18, created on 2009-08-16 14:27:11
         compiled from index.htm */ ?>
<script type="text/javascript">
	var i = <?php echo $this->_tpl_vars['news_no']; ?>
;
	var hideid = i;

	function hide(){
		J("#news_"+hideid).slideUp("300");
		clearTimeout();
	}

	function show_news(id)
	{
		if (i > 0)
		{
			hideid = i;
			setTimeout("hide()", 300);
		}
		
		if (i != id)
		{
			J("#news_"+id).slideDown("300");
			i = id;
		}
		else
			i = 0;
	}

</script>

<div id="news_main_container">
<div id="news_top" align="right"><?php if ($this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?><a href="news_do.php?newpost=1" title="新增消息">[新增消息]</a><?php endif; ?> <a style="color: #FFFFFF;" href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
" title="回到上一頁">[上一頁]</a></div>
<div id="news_middle">
	<?php unset($this->_sections['dis']);
$this->_sections['dis']['name'] = 'dis';
$this->_sections['dis']['loop'] = is_array($_loop=$this->_tpl_vars['news_dis']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div class="news_title" style="float:left;"><?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['date']; ?>
<?php if ($this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['top'] == 1): ?> <span class="red_font">[重要]</span><?php endif; ?> <a class="title" onClick="show_news(<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no']; ?>
);return false;" href="index.php?news_no=<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no']; ?>
" ><?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['title']; ?>
</a></div>
	<?php if ($this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?>
    <div align="right">
    	<a href="news_do.php?edit=1&news_no=<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no']; ?>
">編輯</a>
    	<a href="news_do.php?del=1&news_no=<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no']; ?>
">刪除</a>
    </div>
	<?php endif; ?>
	<br class="clear" />
        
	<div class="news_con" id="news_<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no']; ?>
" style="display:<?php if ($this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['news_no'] == $this->_tpl_vars['news_no']): ?>block<?php else: ?>none<?php endif; ?>;">
		<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['content']; ?>

		<?php $_from = $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['files'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['files']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['file']):
        $this->_foreach['files']['iteration']++;
?>
			<div>相關下載<?php echo $this->_foreach['files']['iteration']; ?>
：<a href="upfile/fileofnews<?php echo $this->_tpl_vars['news_no']; ?>
/<?php echo $this->_tpl_vars['file']['fname']; ?>
"><?php echo $this->_tpl_vars['file']['fname']; ?>
</a></div>
		<?php endforeach; endif; unset($_from); ?>
			<div align="right">發文者：<?php echo $this->_tpl_vars['news_dis'][$this->_sections['dis']['index']]['poster']; ?>
</div>
            <br class="clear" />
	</div>
	<?php endfor; endif; ?>
    <br class="clear" />
</div>
<div id="news_bottom" style="text-align:center;"></div>
</div>