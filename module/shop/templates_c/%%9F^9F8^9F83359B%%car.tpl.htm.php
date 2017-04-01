<?php /* Smarty version 2.6.18, created on 2009-08-12 02:14:36
         compiled from car.tpl.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="include/jquery-ui/development-bundle/jquery-1.3.2.js"></script>
<script type="text/javascript" src="link_car.js"></script>
<link href="car.css" rel=stylesheet type=text/css />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2009國立中央大學 大一生活知訊網-購物商城</title>
</head>


<body>
<div id = "background">
  <div class = "center">
<div id="shop_num"></div>
    <span class="funny"><a onMouseOver="MM_swapImage('ifunny','','shop_pic/headfunnychange.png',1)" onMouseOut="MM_swapImgRestore()" href="items.php"><img id="ifunny" style="border:none;" src="shop_pic/headfunny.png"/></a></span> 
    <span class="head"><a onMouseOver="MM_swapImage('ihead','','shop_pic/funnyheadchange.png',1)" onMouseOut="MM_swapImgRestore()" href="head.php"><img id="ihead" style="border:none;" src="shop_pic/funnyhead.png"/></a></span> 
    <span class="money"></span> 
    <span class="coin"><?php echo $this->_tpl_vars['coins']; ?>
</span>
  

  <div id="space">
  <span id = "speek">*若加上您已擁有的拼圖量，您選購超過數量的拼圖，系統會自動忽略多餘的量</span>
    <div id="good_space">
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['car_head_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   <br /><span id="shop_all<?php echo $this->_tpl_vars['car_head_arr'][$this->_sections['i']['index']]['ino']; ?>
">
    <img width="100" height="100" src="items_pic/<?php echo $this->_tpl_vars['car_head_arr'][$this->_sections['i']['index']]['pic']; ?>
"><br />
    物品名稱：<?php echo $this->_tpl_vars['car_head_arr'][$this->_sections['i']['index']]['item']; ?>
<br />
    售價：<?php echo $this->_tpl_vars['car_head_arr'][$this->_sections['i']['index']]['price']; ?>
<br />
    購買數量:1<br />
    <input type="button" onClick="leavecar( <?php echo $this->_tpl_vars['car_head_arr'][$this->_sections['i']['index']]['ino']; ?>
 )" value="取消購買"/></span>
    </span>
<?php endfor; endif; ?> 

<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['car_puzzle_bag_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>  
<span class="good" >
    <br /><span id="shop_all<?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['ino']; ?>
">
    <img width="100" height="100" src="items_pic/<?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['pic']; ?>
"><br />
    物品名稱：<?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['item']; ?>
<br />
    售價：<?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['price']; ?>
<br />
    購買數量:<input type="text" id ="number" value="<?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['much']; ?>
" size=1><br /> 
    <input type="button" onClick="changemuch( <?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['ino']; ?>
 );" value="變更數量"/>
<br />
    <input type="button" onClick="leavecar( <?php echo $this->_tpl_vars['car_puzzle_bag_arr'][$this->_sections['j']['index']]['ino']; ?>
 );" value="取消購買"/></span> 
</span>
<?php endfor; endif; ?> 


<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['car_other_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>  
<span class="good" >
    <br />
    <span id="shop_all<?php echo $this->_tpl_vars['car_other_arr'][$this->_sections['k']['index']]['ino']; ?>
">
    <img width="100" height="100" src="items_pic/<?php echo $this->_tpl_vars['car_other_arr'][$this->_sections['k']['index']]['pic']; ?>
"><br />
    物品名稱：<?php echo $this->_tpl_vars['car_other_arr'][$this->_sections['k']['index']]['item']; ?>
<br />
    售價：<?php echo $this->_tpl_vars['car_other_arr'][$this->_sections['k']['index']]['price']; ?>
<br />
    購買數量:<br />
    <input type="button" onClick="leavecar( <?php echo $this->_tpl_vars['car_other_arr'][$this->_sections['k']['index']]['ino']; ?>
 );" value="取消購買"/>
    </span>
  </span>
<?php endfor; endif; ?> 
</div>

 <div class="down"> 
 <form action="getgood.php" method="post">
  <input name="button" type="submit" value="確認購買"/>
 </form>
 </div> 
   
   </div>
 </div>
</div>
</body>
</html>