<?php /* Smarty version 2.6.18, created on 2009-08-25 06:31:47
         compiled from items.tpl.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="include/jquery-ui/development-bundle/jquery-1.3.2.js"></script>
<script type="text/javascript" src="include/ajax_item.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="items.css"/>
<title>2009國立中央大學 大一生活知訊網-購物商城</title>
</head>

<body>

<div id="background">
<div id="base">
	<span class="money"><img src="templates/images/funnymoney.gif" /></span>
	<span class="face"><a onmouseover="MM_swapImage('ihead','','shop_pic/funnyheadchange.png',1)" onmouseout="MM_swapImgRestore()" href="head.php">
<img id="ihead" style="border:none;" src="shop_pic/funnyhead.png"/></a></span>
	
    <span class="car"><a onmouseover="MM_swapImage('icar','','shop_pic/funnymotorchange.png',1)" onmouseout="MM_swapImgRestore()" href="car.php">
<img id="icar" style="border:none;" src="shop_pic/funnymotor.png"/></a></span>
<div class="mar"><img src="templates/images/funnyframe.png" />
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['contents']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<div id="here"></div>
<div id="img<?php echo $this->_sections['i']['iteration']; ?>
">
	
	<span>
		<img width="100" height="100" src="./items_pic/<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['pic']; ?>
" alt="圖片生產中" /><br />
	</span>

	<div id="word">
		名稱：<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['item']; ?>
<br />
		價格：<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['price']; ?>
<br />
		說明：<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['deric']; ?>
<br />
	</div>
<span id="buttomtocar"><input name="" type="button"  onclick="buycar(<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['ino']; ?>
)" value="加到購物車"/></span><br />

<?php if ($this->_tpl_vars['admin'] == 1): ?>
<span class="edit">
	<form action="edit_form.php" style="margin:0;padding:0;">
	<input name="ino" type="hidden" value="<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['ino']; ?>
"/>
	<input name="" type="submit" value="修改"/>
</form>
</span>
<span class="del">
	<form action="delete.php" style="margin:0;">
	<input name="ino" type="hidden" value="<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['ino']; ?>
"/>
	<input name="" type="submit" value="刪除"/>
</form>
</span>
<?php endif; ?>

<br />
<span id="btnn<?php echo $this->_tpl_vars['contents'][$this->_sections['i']['index']]['ino']; ?>
"></span>
<br />

</div>
<?php endfor; endif; ?>
</div>
</div>
</div>
</body>
</html>