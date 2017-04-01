<?php /* Smarty version 2.6.18, created on 2010-07-01 23:35:58
         compiled from block/status.htm */ ?>
<?php if (( ! $this->_tpl_vars['curruser']->isguest() )): ?>
<script type="text/javascript">
function show_msg_status(req)
{
	var msg_num = req.responseText;
	var status = (msg_num > 0) ? '<a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/msgbox.php" title="訊息信箱">您有 ' + msg_num + ' 封新訊息</a>' : '您沒有新訊息';
	$('msg_status').innerHTML = status;
}

function get_msg_status()
{
	var parms = "unread=1";
	var req = new Ajax.Request("<?php echo $this->_tpl_vars['block']['dirname']; ?>
/msgbox_do.php", {method: "get", parameters: parms, onComplete: show_msg_status});
	setTimeout(get_msg_status, 60 * 1000);
}

get_msg_status();

/* <?php echo $this->_tpl_vars['block']['name']; ?>
 歡迎回來^^ <span id="msg_status"><?php echo $this->_tpl_vars['block']['unreadmail']; ?>
</span><br /> */
// 
</script>

<div id="login_block">
<span style="color: #FFFFFF;"><?php echo $this->_tpl_vars['block']['name']; ?>
歡迎回來 ^^ <?php echo $this->_tpl_vars['block']['unreadmail']; ?>
</span><br />
<a title="個人資料" href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/edit_pfile.php"><img src="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/templates/images/login_personal.gif" alt="個人資料" /></a>
<a title="個人信箱" href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/msgbox.php"><img src="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/templates/images/login_mailbox.gif" alt="個人信箱" /></a>
<a target="_blank" title="商城" href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/module/shop/"><img src="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/templates/images/login_shoppingmall.gif" alt="商城" /></a>
<a title="登出" href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/include/user.php?user_logout=1"><img src="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/templates/images/login_logout.gif" alt="登出" /></a>
</div>
<?php endif; ?>