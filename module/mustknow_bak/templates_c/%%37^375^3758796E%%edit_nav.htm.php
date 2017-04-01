<?php /* Smarty version 2.6.18, created on 2009-07-28 11:43:18
         compiled from edit_nav.htm */ ?>
<div class="module_container">
<div id="edit_tips">
						<strong>編輯小提醒</strong>
						<blockquote>
							1. 若要將選項變為母分類，將其階層設為 0 即可<br />
							2. 子選項的母分類設定，將其階層設為母分煩的序號即可。<br />
							3-1. 若母分類要加連結，請記得填上連結。<br />
							3-2. 若不想產生連結反應，那就千萬<font color="red">不要</font>加上連結。<br />
							4. 第一層是紅色, 第二層是橘色, 第三層是綠色
						</blockquote>
						<h3><font color="red"><?php echo $this->_tpl_vars['edit_message']; ?>
</font></h3>
					</div>
<form method="post" action="edit_nav.php">
	<input type="submit" value="修改完成"  style="width:100%; margin:10px auto;" />
		<table cellpadding="0" cellspacing="0" style="margin:0px auto; width: 500px;font-size: 10pt;" align="center">
		<tr>
				<td width="35"><h5>序號/</h5></td>
				<td width="40"><h5>節點/</h5></td>
				<td width="40"><h5>排序</h5></td>
				<td align="center"><h5>名稱</h5></td>

				<td width="60"> </td>
			</tr>
		<?php unset($this->_sections['cate']);
$this->_sections['cate']['loop'] = is_array($_loop=$this->_tpl_vars['cate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cate']['name'] = 'cate';
$this->_sections['cate']['show'] = true;
$this->_sections['cate']['max'] = $this->_sections['cate']['loop'];
$this->_sections['cate']['step'] = 1;
$this->_sections['cate']['start'] = $this->_sections['cate']['step'] > 0 ? 0 : $this->_sections['cate']['loop']-1;
if ($this->_sections['cate']['show']) {
    $this->_sections['cate']['total'] = $this->_sections['cate']['loop'];
    if ($this->_sections['cate']['total'] == 0)
        $this->_sections['cate']['show'] = false;
} else
    $this->_sections['cate']['total'] = 0;
if ($this->_sections['cate']['show']):

            for ($this->_sections['cate']['index'] = $this->_sections['cate']['start'], $this->_sections['cate']['iteration'] = 1;
                 $this->_sections['cate']['iteration'] <= $this->_sections['cate']['total'];
                 $this->_sections['cate']['index'] += $this->_sections['cate']['step'], $this->_sections['cate']['iteration']++):
$this->_sections['cate']['rownum'] = $this->_sections['cate']['iteration'];
$this->_sections['cate']['index_prev'] = $this->_sections['cate']['index'] - $this->_sections['cate']['step'];
$this->_sections['cate']['index_next'] = $this->_sections['cate']['index'] + $this->_sections['cate']['step'];
$this->_sections['cate']['first']      = ($this->_sections['cate']['iteration'] == 1);
$this->_sections['cate']['last']       = ($this->_sections['cate']['iteration'] == $this->_sections['cate']['total']);
?>
			 <tr>
			 	<td align="center"><?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
</td>
				<td><input style="width:30px;text-align: center;" type="text" name="hsn-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" value ="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hsn']; ?>
"/></td>
				<td><input   <?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['level'] == 1): ?>  
							class="class_grandmother" 
						<?php elseif ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['level'] == 2): ?> 
							class="class_mother" 
						<?php else: ?>
							class="class_son" <?php endif; ?>
							 style="width:30px;text-align: center;" type="text" size="1" name="ord-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" value ="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['ord']; ?>
"/></td>
				<td><input style="width:300px;" type="text" size="60" name="title-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" value ="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
"/></td>

				<td><input name="kill-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" type="checkbox" value="1" />刪除
				</td>
			</tr>
			<tr>
				<td colspan="2"></td>
					<td colspan="3">
					網址: <input type="text" style="width:330px;background-color:#EEE;color: #333;" name="url-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" value="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink']; ?>
" />
					</td>
				</tr>
				<input type="hidden" name="allord-<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn']; ?>
" value="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['allord']; ?>
" />
		<?php endfor; endif; ?>
		<tr>
				<td class="new_td">新增</td>
				<td class="new_td" colspan="4" align="center">
					<a href="edit_nav.php?new=1">1格</a> 
					<a href="edit_nav.php?new=2">2格</a> 
					<a href="edit_nav.php?new=3">3格</a> 
					<a href="edit_nav.php?new=4">4格</a> 
					<a href="edit_nav.php?new=5">5格</a>
					<a href="edit_nav.php?new=6">6格</a>
					<a href="edit_nav.php?new=7">7格</a>
					<a href="edit_nav.php?new=8">8格</a>
					<a href="edit_nav.php?new=9">9格</a>
					<a href="edit_nav.php?new=10">10格</a>
					<a href="edit_nav.php?new=11">11格</a>
					<a href="edit_nav.php?new=12">12格</a>
					<a href="edit_nav.php?new=13">13格</a>
					<a href="edit_nav.php?new=14">14格</a>
					<a href="edit_nav.php?new=15">15格</a>
				</td>
				</tr>
		</table>
		<input type="submit" value="修改完成"  style="width:100%; margin:10px auto;" />
		<input type="hidden" name="edit_nav_done" value="1" />
		<input type="hidden" name="biggest_csn" value="<?php echo $this->_tpl_vars['biggest_csn']; ?>
" />
	</form>		
</div>
