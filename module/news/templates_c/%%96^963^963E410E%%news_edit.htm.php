<?php /* Smarty version 2.6.18, created on 2009-08-21 10:03:19
         compiled from news_edit.htm */ ?>
<div>
	<table>
		<form action="news_do.php?edit=1&action=1&news_no=<?php echo $this->_tpl_vars['news_no']; ?>
" method="post" enctype="multipart/form-data">
			<tr>
			<td>標題：</td><td><input type="text" name="title" value="<?php echo $this->_tpl_vars['title']; ?>
"></td>
			</tr>
			<tr>
			<td>置頂：</td><td align="left"><?php if ($this->_tpl_vars['top'] == 1): ?><input type="radio" name="top" value="1" checked>是<input type="radio" name="top" value"0">否<?php endif; ?><?php if ($this->_tpl_vars['top'] == 0): ?><input type="radio" name="top" value="1">是<input type="radio" name="top" value"0" checked>否<?php endif; ?></td>
			</tr>
			<tr>
			<td valign="top">內容：</td><td><textarea rows="20" cols="140" name="content"><?php echo $this->_tpl_vars['content']; ?>
</textarea></td>
			</tr>
            <tr>
            <td>寄發站內信？</td><td><input type="checkbox" name="sendmail" /></td>
            </tr>
			<tr>
			<td valign="top">已上傳檔案：</td>
			<td>
			<?php unset($this->_sections['dis']);
$this->_sections['dis']['loop'] = is_array($_loop=$this->_tpl_vars['upfiled']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dis']['name'] = 'dis';
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
				<a href="upfile/fileofnews<?php echo $this->_tpl_vars['upfiled'][$this->_sections['dis']['index']]['news_no']; ?>
/<?php echo $this->_tpl_vars['upfiled'][$this->_sections['dis']['index']]['fname']; ?>
" target="_blank"><?php echo $this->_tpl_vars['upfiled'][$this->_sections['dis']['index']]['fname']; ?>
<br></a>
			<?php endfor; endif; ?>
			</td>
			</tr>
			<tr>
			<td>上傳檔案：</td><td align="left"><input type="file" name="upfile"></td>
			</tr>
			<tr>
			<td colspan="2" align="center"><input type="submit" value="確認"><input type="reset" value="復原"><input type="button" onClick="history.go(-1)" value="放棄"></td>
			</tr>
		</form>
	</table>
</div>