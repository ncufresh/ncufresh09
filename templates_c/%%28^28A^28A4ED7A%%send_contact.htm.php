<?php /* Smarty version 2.6.18, created on 2010-07-02 00:10:17
         compiled from send_contact.htm */ ?>
<div class="blue_back">
<!--<div class="field_top_top"><img src="templates/images/contactus.gif" class="field_title"/><img src="templates/images/pineR.gif" class="in_section"/></div>-->
<div class="field_content_bar"></div>
<div class="field_content">
  <form method="post" action="" onSubmit="
<?php if (( $this->_tpl_vars['curruser']->isguest() )): ?>
	if (!this.sender.value) {alert('請輸入寄件人'); this.sender.focus(); return false;}
	if (!this.email.value) {alert('請輸入email'); this.email.focus(); return false;}
<?php endif; ?>
	if (!this.title.value) {alert('請輸入標題'); this.title.focus(); return false;}
	if (!this.content.value) {alert('請輸入內容'); this.content.focus(); return false;}
" >
    <table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse" align="center">
      <tr>
        <td>姓名</td>
<?php if ($this->_tpl_vars['curruser']->isguest()): ?>
        <td><input type="text" name="sender" size="20"/></td>
<?php else: ?>
		<td><?php echo $this->_tpl_vars['curruser']->name; ?>
(<?php echo $this->_tpl_vars['curruser']->uid; ?>
)</td>
<?php endif; ?>
      </tr>
<?php if ($this->_tpl_vars['curruser']->isguest()): ?>
      <tr>
        <td>E-Mail</td>
        <td><input type="text" name="email" size="20"/></td>
      </tr>
<?php endif; ?>
      <tr>
        <td>標題</td>
        <td><input type="text" name="title" value="" size="40" /></td>
      </tr>
      <tr>
        <td colspan="2"><textarea name="content" rows="10" cols="50"></textarea></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><input type="submit" value="送出" />&nbsp;&nbsp;<input type="reset" value="清除" /></td>
      </tr>
    </table>
  </form>
</div>
<div class="field_bottom"></div>
</div>