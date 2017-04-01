<?php /* Smarty version 2.6.18, created on 2010-07-02 00:02:36
         compiled from msg_box.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="templates/style.css" />
</head>

<body>
<form action="msgbox_do.php?msgdel=1" method="post">
<div id="ma_container">
  <div class="ma_mail_single" style="width:700px;" align="right">
  <a href="msgsend.php" title="傳送訊息">[傳送訊息]</a>
  </div>
  <div class="ma_mail_single" style="font-size:18px;">
    <div class="ma_mail_s_title">信件標題</div>
    <div class="ma_mail_s_uid">寄件者</div>
    <div class="ma_mail_s_datetime">發送時間</div>
    <div class="ma_mail_s_delete">刪除?</div>
  </div>
  <div id="ma_mail_list">
  <?php unset($this->_sections['sec1']);
$this->_sections['sec1']['name'] = 'sec1';
$this->_sections['sec1']['loop'] = is_array($_loop=$this->_tpl_vars['msgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sec1']['show'] = true;
$this->_sections['sec1']['max'] = $this->_sections['sec1']['loop'];
$this->_sections['sec1']['step'] = 1;
$this->_sections['sec1']['start'] = $this->_sections['sec1']['step'] > 0 ? 0 : $this->_sections['sec1']['loop']-1;
if ($this->_sections['sec1']['show']) {
    $this->_sections['sec1']['total'] = $this->_sections['sec1']['loop'];
    if ($this->_sections['sec1']['total'] == 0)
        $this->_sections['sec1']['show'] = false;
} else
    $this->_sections['sec1']['total'] = 0;
if ($this->_sections['sec1']['show']):

            for ($this->_sections['sec1']['index'] = $this->_sections['sec1']['start'], $this->_sections['sec1']['iteration'] = 1;
                 $this->_sections['sec1']['iteration'] <= $this->_sections['sec1']['total'];
                 $this->_sections['sec1']['index'] += $this->_sections['sec1']['step'], $this->_sections['sec1']['iteration']++):
$this->_sections['sec1']['rownum'] = $this->_sections['sec1']['iteration'];
$this->_sections['sec1']['index_prev'] = $this->_sections['sec1']['index'] - $this->_sections['sec1']['step'];
$this->_sections['sec1']['index_next'] = $this->_sections['sec1']['index'] + $this->_sections['sec1']['step'];
$this->_sections['sec1']['first']      = ($this->_sections['sec1']['iteration'] == 1);
$this->_sections['sec1']['last']       = ($this->_sections['sec1']['iteration'] == $this->_sections['sec1']['total']);
?>
    <div class="ma_mail_single">
      <div class="ma_mail_s_title"><a href="msgbox_do.php?msgread=1&mno=<?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['mno']; ?>
" title="閱讀訊息" style="color:#1f4652;"><?php if (( $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['status'] == 2 )): ?><b><?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['title']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['title']; ?>
<?php endif; ?></a></div>
      <div class="ma_mail_s_uid"><a href="show_pfile.php?uno=<?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['sender_no']; ?>
" title="使用者資料" style="color:#690;"><?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['sender_id']; ?>
</a></div>
      <div class="ma_mail_s_datetime"><?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['time']; ?>
</div>
      <div class="ma_mail_s_delete"><a onClick="if(!confirm('確定刪除此信件?'))return false;" href="msgbox_do.php?msgdel=1&mno=<?php echo $this->_tpl_vars['msgs'][$this->_sections['sec1']['index']]['mno']; ?>
" title="刪除訊息">[刪除]</a></div>
    </div>
  <?php endfor; endif; ?>
  </div>
  <div align="right" style="width: 720px;">共有<?php echo $this->_tpl_vars['num']; ?>
封</div>
</div>
</form>
</body>
</html>