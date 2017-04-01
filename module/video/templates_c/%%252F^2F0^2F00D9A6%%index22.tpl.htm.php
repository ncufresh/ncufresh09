<?php /* Smarty version 2.6.18, created on 2009-07-28 22:45:29
         compiled from index22.tpl.htm */ ?>
<div class="dock" id="dock">
<div class="dock-container">

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<a class="dock-item" href="#">
	<form  action="videoplay.php" method="post">
	<input class="img"  type="image" alt="Loading" src="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['image']; ?>
" />
	<input type="hidden" name="no" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" />
	</form>
<span><?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['name']; ?>

<!--
br />
瀏覽人次：<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['browse']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
上傳時間：<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['date']; ?>
<br />
影片介紹：<br />
<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['content']; ?>
<br />


<?php if ($this->_tpl_vars['data'][$this->_sections['i']['index']]['delete'] == true): ?>
<form action="fileget.php" method="POST" enctype="multipart/form-data">
<br />
影片名稱：<br /><input type = "text" name="name" /><br /><br />
上傳影片：(640*480)<br /><input type = "file" name="video" /><br /><br />
上傳圖片：(640*480)<br /><input type = "file" name="image" /><br /><br />
內容介紹：(五行以內)<br /><textarea name="content"rows="5"cols="32"></textarea>
<input type="hidden" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" name="no"/>
<input type="hidden" value="update" name="update"/>
<input type="submit" value="修改" />
</form>


<form action="fileget.php" method="POST">
<input type="hidden" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" name="no"/>
<input type="hidden" value="delete" name="delete"/>
<input type="submit" value="刪除"/>
</form>
<?php endif; ?>

<div id="update" style="padding: 5px; display: none;">
<br /><br /><br /><br /><br /><?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['update']; ?>
</div>
-->
</span>



</a>
<?php endfor; endif; ?>


<script type="text/javascript">
	
	$(document).ready(
		function()
		{
			$('#dock').Fisheye(
				{
					maxWidth: 50,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: 40,
					proximity: 90,
					halign : 'center'
				}
			)
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

</script>


</div>
</div>