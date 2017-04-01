<?php /* Smarty version 2.6.18, created on 2010-07-02 00:03:07
         compiled from edit_pfile.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'binary_and', 'edit_pfile.htm', 97, false),)), $this); ?>
<script type="text/javascript">
function callHeadicon(headIcon){
    J.ajax({
		url: "headIcon_ajax.php?f_name=" + headIcon + "",
		
		data:
		{
		   content: J('#headicon_chg').val(),
		   type: 'send'
		},
		
		success:function(response)
		{
			J('div#headicon_chg').html(response);
			headicon_chg.scrollTop=headicon_chg.scrollHeight;
		}
    });
	
	J.ajax({
		url: "headIcon_ajax.php?action=detail&f_name=" + headIcon + "",
		
		data:
		{
		   content: J('#headicon_detail').val(),
		   type: 'send'
		},
		
		success:function(response)
		{
			J('div#headicon_detail').html(response);
			headicon_detail.scrollTop=headicon_detail.scrollHeight;
		}
    });
}
</script>
<form method="post" action="" onSubmit="if (!this.name.value) {alert('請輸入姓名'); this.name.focus(); return false;}">
<div id="pa_container">
  <div id="pa_pfile_l">
    <div id="pa_pfile_lu"></div>
    <div id="pa_pfile_ld"></div>
  </div>
  <div id="pa_pfile_r">
    <div id="pa_pfile_ru" style="font-size:20px; font-weight: bold;">
      <div align="left" style="width: 400px; float:left;">個人區</div>
      <div align="right" style="width: 300px; float: left">
      <input type="hidden" name="edit_pfile" value="1" />
      <input type="hidden" name="uno" value="<?php echo $this->_tpl_vars['user']->uno; ?>
" />
      <input type="submit" value="送出" />&nbsp;&nbsp;<input type="reset" value="取消" />
      </div>
    </div>
    <div class="pa_pfile_rd">
    我的秘密<br /><br />
      <div class="col_span_title">帳號</div>
      <div class="col_span_content" style="font-size:12px;"><?php echo $this->_tpl_vars['user']->uid; ?>
</div>
      <br />
      <div class="col_span_title">密碼</div>
      <div class="col_span_content" style="font-size:12px;"><?php if (( $this->_tpl_vars['curruser']->uno == $this->_tpl_vars['user']->uno )): ?><?php if (( ! $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['curruser']->p_handler->getpermvalid()) && ! $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['curruser']->p_handler->getpermdeny()) )): ?><div class="button"><a href="sparc.php" title="計中 e-mail 確認" >E-mail確認</a></div><?php endif; ?><div class="button"><a href="passwd.php" title="修改密碼" >修改密碼</a></div><?php endif; ?></div>
      <br />
      <div class="col_span_title">姓名</div>
      <div class="col_span_content"><?php if (( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['curruser']->p_handler->getpermadmin()) )): ?><input type="text" name="realname" value="<?php echo $this->_tpl_vars['user']->realname; ?>
" size="10" /><?php else: ?><?php echo $this->_tpl_vars['user']->realname; ?>
<?php endif; ?></div>
      <br />
      <div class="col_span_title">暱稱</div>
      <div class="col_span_content"><input type="text" name="name" value="<?php echo $this->_tpl_vars['user']->name; ?>
" size="20" /></div>
      <br />
      <div class="col_span_title">性別</div>
      <div class="col_span_content">
      <?php if (( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['curruser']->p_handler->getpermadmin()) )): ?>
      男<input type="radio" name="sex" value="boy" <?php if (( $this->_tpl_vars['user']->sex == "男" )): ?>checked <?php endif; ?>/>
      女<input type="radio" name="sex" value="girl" <?php if (( $this->_tpl_vars['user']->sex == "女" )): ?>checked <?php endif; ?>/>
      <?php else: ?>
        <?php if (( $this->_tpl_vars['user']->sex == "男" )): ?>
        男
        <?php else: ?>
        女
        <?php endif; ?>
      <?php endif; ?>
      </div>
      <br />
      <div class="col_span_title">學號</div>
      <div class="col_span_content"><input type="text" name="sid" value="<?php echo $this->_tpl_vars['user']->sid; ?>
" size="10" /></div>
      <br />
      <div class="col_span_title">首頁</div>
      <div class="col_span_content"><input type="text" name="website" value="<?php echo $this->_tpl_vars['user']->website; ?>
" size="40" /></div>
      <br />
      <div class="col_span_title">電子信箱</div>
      <div class="col_span_content"><input type="text" name="email" value="<?php echo $this->_tpl_vars['user']->email; ?>
" size="40" /></div>
      <br />
      <div class="col_span_title">自我介紹</div>
      <div class="col_span_content"></div>
      <br class="clear" />
      <textarea class="pa_textrea" name="intro" cols="10" rows="40"><?php echo $this->_tpl_vars['user']->intro; ?>
</textarea>
      <br class="clear" />
      <?php if (( $this->_tpl_vars['curruser']->haveperm($this->_tpl_vars['curruser']->p_handler->getpermadmin()) )): ?>
      <span style="border-bottom: solid 1px;">使用者權限</span><br />
      <span style="font-size: 12px;">
      <?php $_from = $this->_tpl_vars['user']->p_handler->permlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['perm']):
?>
      <input type="checkbox" name="perm[]" value="<?php echo $this->_tpl_vars['perm']['perm_id']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['user']->perm)) ? $this->_run_mod_handler('binary_and', true, $_tmp, $this->_tpl_vars['perm']['perm_id']) : binary_and($_tmp, $this->_tpl_vars['perm']['perm_id']))): ?> checked<?php endif; ?> /> <?php echo $this->_tpl_vars['perm']['perm_desc']; ?>
&nbsp;
      <?php endforeach; endif; unset($_from); ?>
      </span>
      <?php endif; ?>
    </div>
    <div class="pa_pfile_rd">我的頭像
    <br /><br />
    <div id="headicon_chg" style="text-align: center;"><img alt="<?php echo $this->_tpl_vars['curruser']->uid; ?>
" src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/shop/items_pic/<?php echo $this->_tpl_vars['curruser']->pic; ?>
.jpg" /></div>
    <br class="clear" />
    <center>
    <select name="pic" onchange="callHeadicon(this.options[this.selectedIndex].value);">
      <?php unset($this->_sections['hi']);
$this->_sections['hi']['name'] = 'hi';
$this->_sections['hi']['loop'] = is_array($_loop=$this->_tpl_vars['headicon']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['hi']['show'] = true;
$this->_sections['hi']['max'] = $this->_sections['hi']['loop'];
$this->_sections['hi']['step'] = 1;
$this->_sections['hi']['start'] = $this->_sections['hi']['step'] > 0 ? 0 : $this->_sections['hi']['loop']-1;
if ($this->_sections['hi']['show']) {
    $this->_sections['hi']['total'] = $this->_sections['hi']['loop'];
    if ($this->_sections['hi']['total'] == 0)
        $this->_sections['hi']['show'] = false;
} else
    $this->_sections['hi']['total'] = 0;
if ($this->_sections['hi']['show']):

            for ($this->_sections['hi']['index'] = $this->_sections['hi']['start'], $this->_sections['hi']['iteration'] = 1;
                 $this->_sections['hi']['iteration'] <= $this->_sections['hi']['total'];
                 $this->_sections['hi']['index'] += $this->_sections['hi']['step'], $this->_sections['hi']['iteration']++):
$this->_sections['hi']['rownum'] = $this->_sections['hi']['iteration'];
$this->_sections['hi']['index_prev'] = $this->_sections['hi']['index'] - $this->_sections['hi']['step'];
$this->_sections['hi']['index_next'] = $this->_sections['hi']['index'] + $this->_sections['hi']['step'];
$this->_sections['hi']['first']      = ($this->_sections['hi']['iteration'] == 1);
$this->_sections['hi']['last']       = ($this->_sections['hi']['iteration'] == $this->_sections['hi']['total']);
?>
        <?php echo $this->_tpl_vars['headicon'][$this->_sections['hi']['index']]['html']; ?>

      <?php endfor; endif; ?>
    </select>
    </center>
    <br class="clear" />
    <div id="headicon_detail">
    名稱：<br />　　<?php echo $this->_tpl_vars['curruser_headicon']['item']; ?>
<br /><br />
    敘述：<br />　　<?php echo $this->_tpl_vars['curruser_headicon']['deric']; ?>
<br />
    </div>
    </div>
  </div>
</div>