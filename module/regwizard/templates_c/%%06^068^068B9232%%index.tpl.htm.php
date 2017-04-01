<?php /* Smarty version 2.6.18, created on 2009-08-21 20:06:35
         compiled from index.tpl.htm */ ?>
<?php if ($this->_tpl_vars['isadmin'] == TRUE): ?><center><a target="_blank" href="admin_main.php">[管理介面]</a></center><?php endif; ?>
<div id="regw_main">
 <?php if ($this->_tpl_vars['request_month'] == 8): ?>
 &nbsp;
  <div id="cal_container" style="background-image: url(templates/images/cal_august.gif);">
  <a id="btn_sep" href="index.php?request_month=9"><img src="templates/images/btn_sep.png" alt="九月行事曆" /></a>
  <a id="aug01_1" href="opt_check.php?rwoID=3#reg_content"><img src="templates/images/calendar/aug01_1.gif" alt="申請學雜費減免" /></a>
  <a id="aug01_2" href="opt_check.php?rwoID=3#reg_content"><img src="templates/images/calendar/aug01_2.gif" alt="申請學雜費減免" /></a>
  <a id="aug02" href="opt_check.php?rwoID=5#reg_content"><img src="templates/images/calendar/aug02.gif" alt="查詢宿舍" /></a>
  <a id="aug03_1" href="opt_check.php?rwoID=4#reg_content"><img src="templates/images/calendar/aug03_1.gif" alt="啟動E-mail帳號及線上登錄學籍資料" /></a>
  <a id="aug03_2" href="opt_check.php?rwoID=4#reg_content"><img src="templates/images/calendar/aug03_2.gif" alt="啟動E-mail帳號及線上登錄學籍資料" /></a>
  <a id="aug04" href="opt_check.php?rwoID=6#reg_content"><img src="templates/images/calendar/aug04.gif" alt="第二階段初選(新生初選)" /></a>
  </div>
 <?php else: ?>
 &nbsp;
  <div id="cal_container" style="background-image: url(templates/images/cal_september.gif);">
  <a id="btn_aug" href="index.php?request_month=8"><img src="templates/images/btn_aug.png" alt="八月行事曆" /></a>
  <a id="sep01" href="opt_check.php?rwoID=6#reg_content"><img src="templates/images/calendar/sep01.gif" alt="第二階段初選(新生初選)" /></a>
  <a id="sep02" href="opt_check.php?rwoID=7#reg_content"><img src="templates/images/calendar/sep02.gif" alt="繳交學雜費及就學貸款" /></a>
  <a id="sep04" href="opt_check.php?rwoID=8#reg_content"><img src="templates/images/calendar/sep04.gif" alt="新生進住宿舍" /></a>
  <a id="sep05" href="opt_check.php?rwoID=6#reg_content"><img src="templates/images/calendar/sep05.gif" alt="第二階段初選(新生初選)" /></a>
  <a id="sep06" href="opt_check.php?rwoID=10#reg_content"><img src="templates/images/calendar/sep06.gif" alt="英文能力分級測驗" /></a>
  <a id="sep07" href="opt_check.php?rwoID=12#reg_content"><img src="templates/images/calendar/sep07.gif" alt="中大超級新生營" /></a>
  <a id="sep08" href="opt_check.php?rwoID=13#reg_content"><img src="templates/images/calendar/sep08.gif" alt="新生體檢" /></a>
  <a id="sep09" href="opt_check.php?rwoID=14#reg_content"><img src="templates/images/calendar/sep09.gif" alt="僑生大一國文中文能力分級測驗(僑外生中文分級測驗)" /></a>
  <a id="sep10" href="opt_check.php?rwoID=7#reg_content"><img src="templates/images/calendar/sep10.gif" alt="繳交學雜費及就學貸款" /></a>
  <a id="sep11" href="opt_check.php?rwoID=8#reg_content"><img src="templates/images/calendar/sep11.gif" alt="新生進住宿舍" /></a>
  <a id="sep12" href="opt_check.php?rwoID=11#reg_content"><img src="templates/images/calendar/sep12.gif" alt="院系時間" /></a>
  <a id="sep13" href="opt_check.php?rwoID=15#reg_content"><img src="templates/images/calendar/sep13.gif" alt="註冊並開始上課" /></a>
  <a id="sep14" href="opt_check.php?rwoID=17#reg_content"><img src="templates/images/calendar/sep14.gif" alt="課程加退選" /></a>
  <a id="sep15" href="opt_check.php?rwoID=16#reg_content"><img src="templates/images/calendar/sep15.gif" alt="大一國文中文寫作檢定" /></a>
  <a id="sep16" href="opt_check.php?rwoID=9#reg_content"><img src="templates/images/calendar/sep16.gif" alt="繳交兵役資料" /></a>
  <a id="sep17" href="opt_check.php?rwoID=17#reg_content"><img src="templates/images/calendar/sep17.gif" alt="課程加退選" /></a>
  <a id="sep18" href="opt_check.php?rwoID=19#reg_content"><img src="templates/images/calendar/sep18.gif" alt="適應講座" /></a>
  </div>
 <?php endif; ?>
  <div id="content_main">
    <div id="content_left" style="background-image: url(templates/images/left_<?php if ($this->_tpl_vars['islogin'] == FALSE): ?>nologin<?php else: ?>login<?php endif; ?>.jpg);">
    <div id="content_left_msg">
    近日內需要完成的行程：<?php echo $this->_tpl_vars['opt_list_null']; ?>

    <ol>
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['opt_list_dis']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <li><a href="opt_check.php?rwoID=<?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['i']['index']]['rwoID']; ?>
#reg_content"><?php echo $this->_tpl_vars['opt_list_dis'][$this->_sections['i']['index']]['rwo_name']; ?>
</a></li>
    <?php endfor; endif; ?>
    </ol>
    </div>
    </div>
    <?php if ($this->_tpl_vars['islogin'] == FALSE): ?>
    <div id="content_right" style="background-image: url(templates/images/right_nologin.jpg);">
    <div id="content_right_msg">您還沒登入喔！<br /><br />請先至右上方先行登入，方可使用註冊精靈</div>
    </div>
    <?php else: ?>
    <div id="content_right" style="background-image: url(templates/images/right_login.jpg);">
    <div id="content_right_msg"><?php echo $this->_tpl_vars['rside_msg']; ?>
</div>
    <br />
    <img id="wiz<?php echo $this->_tpl_vars['c_dis']['id']; ?>
" src="templates/images/0<?php echo $this->_tpl_vars['c_dis']['id']; ?>
.png" alt="<?php echo $this->_tpl_vars['c_dis']['desc']; ?>
" />
    </div>
    <?php endif; ?>
  </div>
</div>