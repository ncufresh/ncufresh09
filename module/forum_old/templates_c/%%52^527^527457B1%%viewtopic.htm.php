<?php /* Smarty version 2.6.18, created on 2009-07-29 02:19:21
         compiled from viewtopic.htm */ ?>
<script type="text/javascript">
	var pno = 0;

	function subscribe(type, no)
	{
		var parms = 'subscr_' + type + '=1&no=' + no;

		var req = new Ajax.Request("do_subscribe.php", {method: "post", parameters: parms});
	}

	function rmtopic_result(req)
	{
		if (req.responseText == '找不到主題')
			alert(req.responseText);
		else
			document.location.href = 'viewboard.php?no=<?php echo $this->_tpl_vars['forumtopic']->board_no; ?>
';
	}

	function rmtopic(no)
	{
		var parms = 'rmtopic=1&tno=' + no;

		var req = new Ajax.Request("do_topic.php", {method: "post", parameters: parms, onComplete: rmtopic_result});
	}

	function rmreply_result(req)
	{
		if (req.responseText == '找不到文章')
			alert(req.responseText);
		else
			document.location.href = 'viewtopic.php?<?php echo $_SERVER['QUERY_STRING']; ?>
';
	}

	function rmreply(no)
	{
		var parms = 'rmreply=1&rno=' + no;

		var req = new Ajax.Request("do_reply.php", {method: "post", parameters: parms, onComplete: rmreply_result});
	}

	function show_push(no)
	{
		if($('push_form' + no).innerHTML != '')
		{
			$('push_form' + no).innerHTML = '';
			return false;
		}
		if (pno > 0)
			$('push_form' + pno).innerHTML = '';

		var str = '';
		str = str + '<form method="post" action="do_push.php" name="do_push" id="do_push">\n';
		str = str + '<?php echo $this->_tpl_vars['curruser']->name; ?>
 → <input type="text" name="content" size="40" />&nbsp;&nbsp;<input type="hidden" name="dopush" value="1" /><input type="hidden" name="rno" value="' + no + '" /><input type="submit" value="確定" />\n';
		str = str + '</form>\n';

		$('push_form' + no).innerHTML = str;

		pno = no;
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
	<a id="img_repost" style="float:right;margin-right:10px;" href="#reply"><span>我要回覆</span></a>
	<?php else: ?>
	<div class="noperm" style="float:right;">你不能 [發表文章] (<acronym title="你可能尚未登入或者沒有權限">?</acronym>)</div>
	<div class="noperm" style="float:right;margin-right:10px;">你不能 [回應文章] (<acronym title="你可能尚未登入或者沒有權限">?</acronym>)</div>
	<?php endif; ?>
	<a id="img_return" style="float:left;" href="viewboard.php?no=<?php echo $this->_tpl_vars['forumtopic']->board_no; ?>
"><span>回列表</span></a>
	<div style="clear:both"></div>
</div>

<?php if ($_GET['page'] == '' || $_GET['page'] == 1): ?>
<div class="mitem">
<div class="mitem-left">
	<div class="img"><img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/pine<?php echo $this->_tpl_vars['forumtopic']->pic; ?>
.gif" alt="<?php echo $this->_tpl_vars['forumtopic']->pic; ?>
" /></div>
	<p>
	帳號：<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/show_pfile.php?uno=<?php echo $this->_tpl_vars['forumtopic']->poster_no; ?>
" title="使用者資料"><?php echo $this->_tpl_vars['forumtopic']->uid; ?>
</a><br />
	系所：<?php echo $this->_tpl_vars['forumtopic']->dep; ?>
<br/>
	暱稱：<?php echo $this->_tpl_vars['forumtopic']->poster_name; ?>

	</p>
</div>
<div class="mitem-right">
	<div class="title">
		<div class="admin">
			<a href="topicfeed.php?no=<?php echo $this->_tpl_vars['forumtopic']->topic_no; ?>
" title="rss"><img src="templates/images/feed.png" border="0" alt="rss" /></a>
			<?php if (( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['forumboard']->perm) && ( $this->_tpl_vars['forumtopic']->poster_no == $this->_tpl_vars['curruser']->uno || $this->_tpl_vars['bm'] ) )): ?>
			<a href="do_topic.php?mdarticle=1&amp;tno=<?php echo $this->_tpl_vars['forumtopic']->topic_no; ?>
" title="修改文章">[編輯]</a>
			<?php if ($this->_tpl_vars['bm']): ?><a href="javascript: rmtopic(<?php echo $this->_tpl_vars['forumtopic']->topic_no; ?>
);" title="刪除文章">[刪除]</a><?php endif; ?>
			<?php endif; ?>
		</div>
		<?php echo $this->_tpl_vars['forumtopic']->title; ?>

	</div>
	<div class="content"><?php echo $this->_tpl_vars['forumtopic']->content; ?>
</div>
	<div class="footer">
		頂樓 :
		發表時間：<?php echo $this->_tpl_vars['forumtopic']->posttime; ?>

		點閱數：<?php echo $this->_tpl_vars['forumtopic']->numread; ?>

		回應數：<?php echo $this->_tpl_vars['forumtopic']->numreply; ?>

	</div>
</div>
<div style="clear:both"></div>
</div>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['forumreply']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reply'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reply']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['reply']):
        $this->_foreach['reply']['iteration']++;
?>
<?php if ($this->_tpl_vars['reply']->die == 1): ?>
<div class="replyitem">
<div class="mitem-left" style="height: auto">
	<p>
	帳號：----<br />
	系所：----<br />
	暱稱：----
	</p>
</div>
<div class="mitem-right">
	<div><p>-- 本回覆已被刪除 --</p></div><br />
	#<?php echo $this->_tpl_vars['reply']->fix_no; ?>
 樓 : 發表時間：<?php echo $this->_tpl_vars['reply']->posttime; ?>

</div>
<div style="clear:both"></div>
</div>
<?php else: ?>
<div class="replyitem">
<div class="mitem-left">
	<div class="img"><img src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/templates/images/pine<?php echo $this->_tpl_vars['reply']->pic; ?>
.gif" alt="<?php echo $this->_tpl_vars['reply']->pic; ?>
" /></div>
	<p>
	帳號：<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/show_pfile.php?uno=<?php echo $this->_tpl_vars['reply']->poster_no; ?>
" title="使用者資料"><?php echo $this->_tpl_vars['reply']->uid; ?>
</a><br />
	系所：<?php echo $this->_tpl_vars['reply']->dep; ?>
<br />
	暱稱：<?php echo $this->_tpl_vars['reply']->poster_name; ?>

	</p>
</div>
<div class="mitem-right">
    <div>
	<?php if ($this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['forumboard']->perm) && ( $this->_tpl_vars['reply']->poster_no == $this->_tpl_vars['curruser']->uno || $this->_tpl_vars['bm'] )): ?>
	<div class="admin">
		<a href="do_reply.php?mdreply=1&amp;rno=<?php echo $this->_tpl_vars['reply']->reply_no; ?>
;" title="修改文章">[編輯]</a>
		<?php if ($this->_tpl_vars['bm']): ?><a href="javascript: rmreply(<?php echo $this->_tpl_vars['reply']->reply_no; ?>
);" title="刪除文章">[刪除]</a><?php endif; ?>

	</div>
	<?php endif; ?>
    &nbsp;
    </div>
    <div class="content"><?php echo $this->_tpl_vars['reply']->content; ?>
</div>
	<div class="footer">
		#<?php echo $this->_tpl_vars['reply']->fix_no; ?>
 樓 : 發表時間：<?php echo $this->_tpl_vars['reply']->posttime; ?>

	</div>
</div>
<div style="clear:both"></div>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<div class="forum_page"><?php $_from = $this->_tpl_vars['plink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?><?php echo $this->_tpl_vars['link']; ?>
&nbsp;&nbsp;<?php endforeach; endif; unset($_from); ?></div>

<a name="reply"></a>
<?php if (! $this->_tpl_vars['curruser']->isguest() && ( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['forumboard']->perm) || $this->_tpl_vars['bm'] )): ?>
<div id="reply_form">
  <form method="post" action="do_reply.php">
    <table class="formTable" style="width:100%">
      <tr>
        <th>回覆文章</th>
      </tr>
      <tr>
        <td><textarea style="width:100%" name="content" rows="10" cols="60"></textarea></td>
      </tr>
      <tr>
		<td><input type="hidden" name="doreply" value="1" /><input type="hidden" name="tno" value="<?php echo $this->_tpl_vars['forumtopic']->topic_no; ?>
" /><input type="submit" value="確定" />&nbsp;&nbsp;<input type="reset" value="重填" /></td>
      </tr>
    </table>
  </form>
</div>
<?php endif; ?>

</div>
</div>