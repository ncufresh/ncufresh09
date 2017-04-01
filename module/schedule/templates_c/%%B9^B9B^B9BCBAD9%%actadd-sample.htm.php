<?php /* Smarty version 2.6.18, created on 2009-08-05 20:20:26
         compiled from actadd-sample.htm */ ?>
<div class="blue_back">
	<div class="field_top_top">
		<img src="templates/images/addnew.gif" class="field_title"/>
		<div style="margin: -20px 0px 80px 470px;float:none;font-size:14pt;">
			回到&gt;&gt;
			<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/redirect.php?1" style="color:black;text-decoration:none;margin:10px 0 0 20px;font-size:24pt;display:block;"><span>行事曆</span></a>
		</div>
	</div>

<div class="field_content_bar">新增事項</div>
<div class="field_content">
<form id="actadd" method="post" action="?t=<?php echo $_GET['t']; ?>
&n=<?php echo $_GET['n']; ?>
">
	<p>開始: <input type="text" name="start_date" value="<?php echo $this->_tpl_vars['dnow']; ?>
" /></p>
	<p>標題: <input type="test" name="title" /></p>
	<p>內容: <textarea cols="40" rows="7" name="content"></textarea></p>
	<p>連續: <input name="interval" value="1" /> 天</p>
	<p><input type="submit" value="新增" /></p>
</form>
</div>
<div class="field_bottom"></div>

</div>