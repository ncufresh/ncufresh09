<?php /* Smarty version 2.6.18, created on 2009-08-12 18:19:16
         compiled from admin_manage_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'admin_manage_add.html', 166, false),)), $this); ?>
<table width="652" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="64" colspan="2" valign="top" background="templates/images/bg_1_top.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" width="318" background="templates/images/bg_2_left.gif">

    <table width="318" border="0" cellspacing="0" cellpadding="0">
      <form action="admin_process.php?action=<?php echo $this->_tpl_vars['form_action']; ?>
" method="post">
      <tr>
        <td width="58" align="right"><span class="column_title">選項名稱</span></td>
        <td width="5"></td>
        <td width="255"><input type="text" name="rwo_name" id="rwo_name" value="<?php echo $this->_tpl_vars['opt_dis']['rwo_name']; ?>
" /></td>
      </tr>
      <tr>
        <td width="58" align="right" valign="top"><span class="column_title">選項敘述</span></td>
        <td width="5"></td>
        <td width="255">
        <textarea name="rwo_description" cols="27" rows="7"><?php echo $this->_tpl_vars['opt_dis']['rwo_description']; ?>
</textarea>
        </td>
      </tr>
      <tr>
        <td width="58" rowspan="2" align="right" valign="top"><span class="column_title">有效日期</span></td>
        <td width="5"></td>
        <td width="255">
        <select name="rwo_datetype" id="rwo_datetype" onChange="request_html_column('datetype');">
            <option value="" <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == ""): ?>selected<?php endif; ?>>--請選擇--</option>
            <option value="0" <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == '0'): ?>selected<?php endif; ?>>一天</option>
            <option value="2" <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == '2'): ?>selected<?php endif; ?>>有限日期區間</option>
            <option value="-1" <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == "-1"): ?>selected<?php endif; ?>>自開始日期後可隨時完成</option>
            <option value="1" <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == '1'): ?>selected<?php endif; ?>>隨時可以完成</option>
        </select>
        </td>
      </tr>
    
      <tr>
        <td width="5"></td>
        <td width="255">
        <div id="datetype_result">
        <?php if ($this->_tpl_vars['opt_dis']['rwo_datetype'] == '0' || $this->_tpl_vars['opt_dis']['rwo_datetype'] == "-1"): ?>
        <span class="column_title">開始日期：</span>
        <input name="rwo_date_begin" type="text" value="<?php echo $this->_tpl_vars['opt_dis']['rwo_date_begin']; ?>
" /><br />
        <span class="column_title">(格式：yyyy-mm-dd)</span>
        <?php elseif ($this->_tpl_vars['opt_dis']['rwo_datetype'] == '2'): ?>
        <span class="column_title">開始日期：</span>
        <input name="rwo_date_begin" type="text" value="<?php echo $this->_tpl_vars['opt_dis']['rwo_date_begin']; ?>
" /><br />
        <span class="column_title">結束日期：</span>
        <input name="rwo_date_end" type="text" value="<?php echo $this->_tpl_vars['opt_dis']['rwo_date_end']; ?>
" /><br />
        <span class="column_title">(格式：yyyy-mm-dd)</span>
        <?php endif; ?>
        </div>
        </td>
      </tr>
      <tr>
        <td width="58" align="right"><span class="column_title">必要性</span></td>
        <td width="5"></td>
        <td width="255">
        <select name="rwo_type" id="rwo_type" onChange="request_html_column('c_column');">
            <option value="" <?php if ($this->_tpl_vars['opt_dis']['rwo_type'] == ""): ?>selected<?php endif; ?>>--請選擇--</option>
            <option value="0" <?php if ($this->_tpl_vars['opt_dis']['rwo_type'] == '0'): ?>selected<?php endif; ?>>必要</option>
            <option value="1" <?php if ($this->_tpl_vars['opt_dis']['rwo_type'] == '1'): ?>selected<?php endif; ?>>非必要</option>
            <option value="2" <?php if ($this->_tpl_vars['opt_dis']['rwo_type'] == '2'): ?>selected<?php endif; ?>>自訂必要/非必要條件</option>
        </select>
        </td>
      </tr>
      <tr>
        <td width="58"></td>
        <td width="5"></td>
        <td width="255">
        <div id="c_column_result">
        <?php if ($this->_tpl_vars['opt_dis']['rwo_type'] == '2'): ?>
        <table width="255" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <span class="column_title">當使用者的</span>
            <select name="rwo_c_column" id="rwo_c_column" onChange="request_html_column('c_value');">
               <option value="none" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_column'] == ""): ?>selected<?php endif; ?>>--請選擇--</option>
               <option value="sex" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_column'] == 'sex'): ?>selected<?php endif; ?>>性別</option>
               <option value="department" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_column'] == 'department'): ?>selected<?php endif; ?>>系所</option>
            </select>
            <span class="column_title">的值</span>
            </td>
          </tr>
          <tr>
            <td>
            <div id="c_value_result">
            <span class="column_title">為</span>
            <?php if ($this->_tpl_vars['opt_dis']['rwo_c_column'] == 'sex'): ?>
            <select name="rwo_c_value[]" id="rwo_c_value[]" multiple="multiple" size="2" onchange="request_html_column('c_type');">
                <option value="男" <?php if ($this->_tpl_vars['sel_rwo_c_value']['boy'] == '1'): ?>selected<?php endif; ?>>男</option>
                <option value="女" <?php if ($this->_tpl_vars['sel_rwo_c_value']['girl'] == '1'): ?>selected<?php endif; ?>>女</option>
            </select>
            <?php elseif ($this->_tpl_vars['opt_dis']['rwo_c_column'] == 'department'): ?>
            <select name="rwo_c_value[]" size="12" multiple="multiple" id="rwo_c_value[]" onchange="request_html_column('c_type');">
            <option value="oth" <?php if ($this->_tpl_vars['sel_rwo_c_value']['oth'] == '1'): ?>selected<?php endif; ?>>其他科系</option>
                <optgroup label="文學院">
                    <option value="chinese" <?php if ($this->_tpl_vars['sel_rwo_c_value']['chinese'] == '1'): ?>selected<?php endif; ?>>中國文學系</option>
                    <option value="english" <?php if ($this->_tpl_vars['sel_rwo_c_value']['english'] == '1'): ?>selected<?php endif; ?>>英美語文學系</option>
                    <option value="fr" <?php if ($this->_tpl_vars['sel_rwo_c_value']['fr'] == '1'): ?>selected<?php endif; ?>>法國語文學系</option>
                </optgroup>
                <optgroup label="理學院">
                    <option value="sci" <?php if ($this->_tpl_vars['sel_rwo_c_value']['sci'] == '1'): ?>selected<?php endif; ?>>理學院學士班</option>
                    <option value="phy" <?php if ($this->_tpl_vars['sel_rwo_c_value']['phy'] == '1'): ?>selected<?php endif; ?>>物理學系</option>
                    <option value="math" <?php if ($this->_tpl_vars['sel_rwo_c_value']['math'] == '1'): ?>selected<?php endif; ?>>數學系</option>
                    <option value="ch" <?php if ($this->_tpl_vars['sel_rwo_c_value']['ch'] == '1'): ?>selected<?php endif; ?>>化學系</option>
                    <option value="ls" <?php if ($this->_tpl_vars['sel_rwo_c_value']['ls'] == '1'): ?>selected<?php endif; ?>>生命科學系</option>
                    <option value="dop" <?php if ($this->_tpl_vars['sel_rwo_c_value']['dop'] == '1'): ?>selected<?php endif; ?>>光電工程學系</option>
                </optgroup>
                <optgroup label="工學院">
                    <option value="chme" <?php if ($this->_tpl_vars['sel_rwo_c_value']['chme'] == '1'): ?>selected<?php endif; ?>>化學與材料工程學系</option>
                    <option value="civil" <?php if ($this->_tpl_vars['sel_rwo_c_value']['civil'] == '1'): ?>selected<?php endif; ?>>土木工程學系</option>
                    <option value="me" <?php if ($this->_tpl_vars['sel_rwo_c_value']['me'] == '1'): ?>selected<?php endif; ?>>機械工程學系</option>
                </optgroup>
                <optgroup label="管理學院">
                    <option value="ba" <?php if ($this->_tpl_vars['sel_rwo_c_value']['ba'] == '1'): ?>selected<?php endif; ?>>企業管理學系</option>
                    <option value="im" <?php if ($this->_tpl_vars['sel_rwo_c_value']['im'] == '1'): ?>selected<?php endif; ?>>資訊管理學系</option>
                    <option value="fm" <?php if ($this->_tpl_vars['sel_rwo_c_value']['fm'] == '1'): ?>selected<?php endif; ?>>財務金融學系</option>
                    <option value="eco" <?php if ($this->_tpl_vars['sel_rwo_c_value']['eco'] == '1'): ?>selected<?php endif; ?>>經濟學系</option>
                </optgroup>
                <optgroup label="資電學院">
                    <option value="ee" <?php if ($this->_tpl_vars['sel_rwo_c_value']['ee'] == '1'): ?>selected<?php endif; ?>>電機工程學系</option>
                    <option value="csie" <?php if ($this->_tpl_vars['sel_rwo_c_value']['csie'] == '1'): ?>selected<?php endif; ?>>資訊工程學系</option>
                    <option value="comm" <?php if ($this->_tpl_vars['sel_rwo_c_value']['comm'] == '1'): ?>selected<?php endif; ?>>通訊工程學系</option>
                </optgroup>
                <optgroup label="地球科學學院">
                    <option value="gep" <?php if ($this->_tpl_vars['sel_rwo_c_value']['gep'] == '1'): ?>selected<?php endif; ?>>地球科學系</option>
                    <option value="atm" <?php if ($this->_tpl_vars['sel_rwo_c_value']['atm'] == '1'): ?>selected<?php endif; ?>>大氣科學系</option>
                </optgroup>
            </select>
            <?php endif; ?>
            <span class="column_title">時</span>
            </div>
            </td>
          </tr>
          <tr>
            <td>
            <div id="c_type_result"><span class="column_title">此選項對使用者為</span>
            <select name="rwo_c_type" id="rwo_c_type">
                <option value="" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == ""): ?>selected<?php endif; ?>>--請選擇--</option>
                <option value="20" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '20'): ?>selected<?php endif; ?>>隱藏此項，並必要於其他使用者</option>
                <option value="21" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '21'): ?>selected<?php endif; ?>>隱藏此項，但非並必要於其他使用者</option>
                <option value="01" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '01'): ?>selected<?php endif; ?>>必要，且其他使用者非必要</option>
                <option value="02" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '02'): ?>selected<?php endif; ?>>必要，且其他使用者隱藏此項</option>
                <option value="10" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '10'): ?>selected<?php endif; ?>>非必要，且其他使用者必要</option>
                <option value="12" <?php if ($this->_tpl_vars['opt_dis']['rwo_c_type'] == '12'): ?>selected<?php endif; ?>>非必要，且其他使用者隱藏此項</option>
            </select>
            </div>
            </td>
          </tr>
        </table>
        <?php endif; ?>
        </div>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center"><input type="submit" name="submit" id="submit" value="增加/修改選項" /></td>
      </tr>
      </form>
    </table>
    </td>
    <td valign="top" width="334" class="td_2_full_right">
    <div id="td_2_right_admin"></div>
    <a href="admin_main.php"><img border="0" src="templates/images/admin_btn_opt_manage.gif" alt="管理端首頁" /></a><br />
    <a href="admin_manage_add.php"><img border="0" src="templates/images/admin_btn_opt_add.gif" alt="選項新增" /></a><br />
    <?php if ($this->_tpl_vars['action'] == 'modify'): ?>
    <div id="opt_chk_td_2_content"><br /><br /><img border="0" src="templates/images/admin_overview.gif" /><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['opt_dis']['rwo_description'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
    <?php endif; ?>
    </td>
  </tr>
</table>