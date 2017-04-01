<?php /* Smarty version 2.6.18, created on 2009-08-12 02:25:59
         compiled from index.tpl.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="include/jquery-ui/development-bundle/jquery-1.3.2.js"></script>
<script type="text/javascript" src="link_index.js"></script>
<link href="index.css" rel=stylesheet type=text/css />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2009國立中央大學 大一生活知訊網-購物商城</title>
</head>

<body>
<div id="background">
 <div class="center">
<div class="stop">
<?php if ($this->_tpl_vars['admin'] == 1): ?>
 <a href="addform.php">上傳介面</a>
<?php endif; ?></div>
   <span class="head">
     <a onmouseover="MM_swapImage('ihead','','shop_pic/homeheadchange.png',1)" onmouseout="MM_swapImgRestore()" href="head.php">
<img id="ihead" style="border:none;" src="shop_pic/homehead.png"/></a></span>
   
   <span class="funny">
     <a onmouseover="MM_swapImage('ifunny','','shop_pic/homefunnychange.png',1)" onmouseout="MM_swapImgRestore()" href="items.php">
<img id="ifunny" style="border:none;" src="shop_pic/homefunny.png"/></a></span>
   <span class="motor">
    <a onmouseover="MM_swapImage('imotor','','shop_pic/homemotorchange.png',1)" onmouseout="MM_swapImgRestore()" href="car.php">
<img id="imotor" style="border:none;" src="shop_pic/homemotor.png"/></a>  </span> 
   <span class="money"></span> 
   <span id="coin"><?php echo $this->_tpl_vars['coins']; ?>
</span>
  </div>
</div>
</body>
</html>
