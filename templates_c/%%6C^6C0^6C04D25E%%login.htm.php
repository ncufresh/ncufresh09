<?php /* Smarty version 2.6.18, created on 2010-07-02 02:41:05
         compiled from login.htm */ ?>
<div >使用者登入</div>
<div style="magin:0 auto;">
  <form method="post" action="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/include/user.php">
    <table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse" align="center">
      <tr>
        <td colspan="2" align="center"><span style="font-weight: bold; color: #FF0000;"><?php echo $this->_tpl_vars['msg']; ?>
</span></td>
      </tr>
      <tr>
        <td align="right">帳號</td>
        <td align="left"><input type="text" name="id" size="10" /></td>
      </tr>
      <tr>
        <td align="right">密碼</td>
        <td align="left"><input type="password" name="pwd" size="10" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="hidden" name="user_login" value="1" /><input type="submit" value="登入" />&nbsp;&nbsp;<input type="reset" value="取消" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">還沒有帳號？<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/register.php" title="註冊">註冊</a></td>
      </tr>
    </table>
  </form>
</div>