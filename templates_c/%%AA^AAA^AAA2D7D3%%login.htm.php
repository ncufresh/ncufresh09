<?php /* Smarty version 2.6.18, created on 2010-07-01 23:35:58
         compiled from block/login.htm */ ?>
<?php if (( $this->_tpl_vars['curruser']->isguest() )): ?>
<div id="login_block">
<form method="post" action="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/include/user.php" id="block_login_form">
	<span class="main_link"><strong>帳號</strong></span>
	<input type="text" name="id" size="10" /><br />
	<span class="main_link"><strong>密碼</strong></span>
	<input type="password" name="pwd" size="10" />
	<input type="hidden" name="user_login" value="1" />
    <input type="submit" class="login_button" value="登入" />
<?php if (( $this->_tpl_vars['currconfig']->openreg == 1 )): ?>
	<a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/register.php"><span class="login_button">註冊</span></a>
<?php endif; ?>
</form>
</div>
<?php endif; ?>