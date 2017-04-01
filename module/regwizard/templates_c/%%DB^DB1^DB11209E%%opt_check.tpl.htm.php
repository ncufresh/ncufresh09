<?php /* Smarty version 2.6.18, created on 2009-08-21 20:08:35
         compiled from opt_check.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'opt_check.tpl.htm', 42, false),)), $this); ?>
<div id="regw_main">
 <?php if ($this->_tpl_vars['request_month'] == 8): ?>
 &nbsp;
  <div id="cal_container" style="background-image: url(templates/images/cal_august.gif);">
  <a id="btn_sep" href="opt_check.php?rwoID=<?php echo $this->_tpl_vars['curr_rwoID']; ?>
&request_month=9"><img src="templates/images/btn_sep.png" alt="九月行事曆" /></a>
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
  <a id="btn_aug" href="opt_check.php?rwoID=<?php echo $this->_tpl_vars['curr_rwoID']; ?>
&request_month=8"><img src="templates/images/btn_aug.png" alt="八月行事曆" /></a>
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
 <a name="reg_content" id="reg_content"></a>
  <div id="content_main">
    <div id="content_detail">
    <div style="width: 647px; height: 417px; overflow-y: scroll;">
    <span class="content_detail_title"><?php echo $this->_tpl_vars['opt_dis']['rwo_name']; ?>
</span>
    <br /><br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['opt_dis']['rwo_description'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

    </div>
    </div>
    
    <?php if ($this->_tpl_vars['islogin'] == FALSE): ?>
    <div id="content_right" style="background-image: url(templates/images/right_nologin.jpg);">
    <div id="content_right_msg">您還沒登入喔！<br /><br />請先至右上方先行登入，方可使用註冊精靈</div>
    </div>
    <?php else: ?>
    <div id="content_right" style="background-image: url(templates/images/right_login.jpg);">
    <div id="content_right_msg"><?php echo $this->_tpl_vars['curr_opt_msg']; ?>
</div>
    <form method="post" action="opt_check.php?action=process&rwoID=<?php echo $this->_tpl_vars['opt_dis']['rwoID']; ?>
"><?php echo $this->_tpl_vars['form_complete_submit']; ?>
</form>
    <br />
    <img id="wiz<?php echo $this->_tpl_vars['c_dis']['id']; ?>
" src="templates/images/0<?php echo $this->_tpl_vars['c_dis']['id']; ?>
.png" alt="<?php echo $this->_tpl_vars['c_dis']['desc']; ?>
" />
    </div>
    <?php endif; ?>
  </div>
</div>