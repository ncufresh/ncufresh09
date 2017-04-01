<?php /* Smarty version 2.6.18, created on 2009-08-25 14:25:28
         compiled from head.tpl.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="include/jquery-ui/development-bundle/jquery-1.3.2.js"></script>
<script type="text/javascript" src="link.js"></script>
<link href="head.css" rel=stylesheet type=text/css />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2009國立中央大學 大一生活知訊網-購物商城</title>
</head>

<body>
<div id = "background">
 <div class = "center"> 
   <span class="funny">
   <a onmouseover="MM_swapImage('ifunny','','shop_pic/motorfunnychange.png',1)" onmouseout="MM_swapImgRestore()" href="items.php">
<img id="ifunny" style="border:none;" src="shop_pic/motorfunny.png"/></a></span>
   <span class="motor">
    <a onmouseover="MM_swapImage('imotor','','shop_pic/funnymotorchange.png',1)" onmouseout="MM_swapImgRestore()" href="car.php">
<img id="imotor" style="border:none;" src="shop_pic/funnymotor.png"/></a>  </span> 

   <span class="money"></span> 
   <span class="coin"><?php echo $this->_tpl_vars['coins']; ?>
</span>
 
  <div id="space">
    <div id="good_space">
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['head_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <span class="good" >
    <?php if ($this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['num'] > 0 || $this->_tpl_vars['admin'] == 1): ?>
    <img width="100" height="100" src="items_pic/<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['pic']; ?>
"><br />
    商品名稱：<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['item']; ?>
<br />
    說明:<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['deric']; ?>
<br />
    售價：<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['price']; ?>
<br />
    <?php if ($this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['num'] < 50): ?>
    這是限量商品喔!現在還有<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['num']; ?>
個!<br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['check_arr'][$this->_sections['i']['index']] == 0): ?>
    <span id="shop_btnn<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['ino']; ?>
"><input name="buy_button" type="button" onClick="tocar(<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['ino']; ?>
)" value="購買此商品"/></span><br />
    <?php else: ?>
     您已選購過此商品<br />
    <?php endif; ?>
    <?php endif; ?>

	<?php if ($this->_tpl_vars['admin'] == 1): ?>
		<span class="edit">
			<form action="edit_form.php" style="margin:0;padding:0;">
			<input name="ino" type="hidden" value="<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['ino']; ?>
"/>
			<input name="" type="submit" value="修改"/>
			</form>
		</span>
		<span class="del">
			<form action="delete.php" style="margin:0;">
			<input name="ino" type="hidden" value="<?php echo $this->_tpl_vars['head_arr'][$this->_sections['i']['index']]['ino']; ?>
"/>
			<input name="" type="submit" value="刪除"/>
			</form>
		</span>
	<?php endif; ?>
	</span>
<?php endfor; endif; ?>
</div>
 </div>
</div>
</div>
</body>
</html>