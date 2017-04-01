<?php /* Smarty version 2.6.18, created on 2009-07-29 10:54:23
         compiled from viewboard.htm */ ?>
<script type="text/javascript">
	function subscribe(type, no)
	{
		var parms = '&subscr_' + type + '=1&no=' + no;

		var req = new Ajax.Request("do_subscribe.php", {method: "post", parameters: parms, onComplete: function(q){alert('訂閱成功');}});
	}

	function rmtopic_result(req)
	{
		if (req.responseText == '找不到主題')
			alert(req.responseText);
		else
			document.location.href = '<?php echo $this->_tpl_vars['currconfig']->phpself; ?>
?no=<?php echo $this->_tpl_vars['forumboard']->board_no; ?>
';
	}

	function rmtopic(no)
	{
		var parms = 'rmtopic=1&tno=' + no;

		var req = new Ajax.Request("do_topic.php", {method: "post", parameters: parms, onComplete: rmtopic_result});
	}

	function toptopic(no)
	{
		var parms = 'toptopic=1&tno=' + no;

		var req = new Ajax.Request("do_top.php", {method: "post", parameters: parms, onComplete: function(q){document.location.href = '<?php echo $this->_tpl_vars['currconfig']->phpself; ?>
?no=<?php echo $this->_tpl_vars['forumboard']->board_no; ?>
';}});
	}
</script>
<div class="forum_field">

<div class="forum_title">
	<?php echo $this->_tpl_vars['forumboard']->title; ?>
 
	<?php if ($this->_tpl_vars['forumboard']->board_no < 301 || $this->_tpl_vars['forumboard'] > 305): ?>
	<span style="font-size:10pt">&gt;&gt; <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/superask/view.php?tno=<?php echo $this->_tpl_vars['forumboard']->board_no; ?>
">前往<?php echo $this->_tpl_vars['forumboard']->title; ?>
介紹</a></span>
	<?php endif; ?>
</div>

<div class="forum_content">

<div class="forum_img">
	<?php if (! $this->_tpl_vars['curruser']->isguest() && ( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['forumboard']->perm) || $this->_tpl_vars['bm'] )): ?>
	<a id="img_post" style="float:right;" href="do_topic.php?dopost=1&amp;bno=<?php echo $this->_tpl_vars['forumboard']->board_no; ?>
"><span>發表文章</span></a>
	<?php else: ?>
	<div class="noperm" style="float:right;">你不能 [發表文章] (<acronym title="你可能尚未登入或者沒有權限">?</acronym>)</div>
	<?php endif; ?>
	<a id="img_back" style="float:left;" href="showGroup.php?gno=<?php echo $this->_tpl_vars['forumboard']->group_no; ?>
"><span>回列表</span></a>
</div>
<div style="clear:both"></div>
<table class="forum_topics" border="0">
<thead>
	<tr>
		<th width="7%">NO</th>
		<th width="45%">標題</th>
		<th width="15%">作者</th>
		<th width="6%">回覆</th>
		<th width="20%">Lasttime</th>
		<th width="7%">人氣</th>
	</tr>
</thead>
<tbody>
<?php if (! $this->_tpl_vars['forumtopic']): ?>
<tr><td colspan="6"><div class="notopic">現在沒有文章，你可利用右上角 [發表文章] 的功能來新增第一篇文章</div></td></tr>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['forumtopic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['topic'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['topic']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['topic']):
        $this->_foreach['topic']['iteration']++;
?>
<?php if ($this->_tpl_vars['topic']->die == 1): ?>
<tr class="point_white">
	<td><?php echo $this->_tpl_vars['topic']->fix_no; ?>
</td>
	<td>本文已被刪除</td>
	<td>--</td>
	<td>--</td>
	<td style="text-align:right">---- - -- - --<br />--:--:--</td>
	<td>--</td>
</tr>
<?php else: ?>
<tr class="point_<?php if ($this->_tpl_vars['topic']->red > 0 || $this->_tpl_vars['curruser']->isguest()): ?>white<?php else: ?>red<?php endif; ?>">
	<td><?php echo $this->_tpl_vars['topic']->fix_no; ?>
</td>
	<td style="text-align:left;overflow:hidden">
		<?php if (( $this->_tpl_vars['bm'] )): ?>
		<a style="float:right;" href="javascript: toptopic(<?php echo $this->_tpl_vars['topic']->topic_no; ?>
);" title="文章置頂">[置頂/取消]</a>
		<?php endif; ?>
		<a href="viewtopic.php?no=<?php echo $this->_tpl_vars['topic']->topic_no; ?>
"><?php echo $this->_tpl_vars['topic']->title; ?>
</a>
	</td>
	<td><?php echo $this->_tpl_vars['topic']->poster_name; ?>
</td>
	<td><?php echo $this->_tpl_vars['topic']->numreply; ?>
</td>
	<td style="text-align:right"><?php echo $this->_tpl_vars['topic']->lasttime; ?>
</td>
	<td><?php echo $this->_tpl_vars['topic']->numread; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>

<div class="forum_page"><?php $_from = $this->_tpl_vars['plink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?><?php echo $this->_tpl_vars['link']; ?>
&nbsp;&nbsp;<?php endforeach; endif; unset($_from); ?></div>

</div>

</div>