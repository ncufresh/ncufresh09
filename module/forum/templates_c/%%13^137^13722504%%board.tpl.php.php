<?php /* Smarty version 2.6.18, created on 2010-07-01 23:25:30
         compiled from board.tpl.php */ ?>
<div id="forum_board_outer">
	<div id="forum_board_banner">
	<div id="fb_left">
		<?php echo $this->_tpl_vars['ForAdmin']['upload']; ?>

		<div id="fb_name">
			<?php echo $this->_tpl_vars['BoardInfo']['pic']; ?>
<br />
			<a href="<?php echo $this->_tpl_vars['BoardInfo']['Link']; ?>
">
			<?php echo $this->_tpl_vars['BoardInfo']['board_cname']; ?>
<br />
			<span id="fb_engname"><?php echo $this->_tpl_vars['BoardInfo']['board_ename']; ?>
</span>
			</a>
		</div>
	</div>
	<div id="fb_right">
		<span id="fb_right_container">
			<?php echo $this->_tpl_vars['BoardInfo']['descripe']; ?>
	
			<?php echo $this->_tpl_vars['ForAdmin']['edit']; ?>

			<?php echo $this->_tpl_vars['ForAdmin']['editContent']; ?>

		</span>
	</div>
	</div>
	
	<form id="forum_board_content" method="post" action="board_admin.php">
		<div id="FBC_Banner">
			<!---<a href="newquest.php?fno=<?php echo $this->_tpl_vars['BoardInfo']['FNO']; ?>
"><img src="./templates/images/departButton01.gif"/></a>-->
			<?php if ($this->_tpl_vars['ForAdmin']['isAdmin']): ?>
                <input type="submit" value="切換置頂" name="submit"/>
		    	<input type="submit" value="刪除" name="submit"/>
		    	<input type="hidden" value="<?php echo $this->_tpl_vars['BoardInfo']['FNO']; ?>
" name="FNO">
            <?php endif; ?>
			<span class="pageBar"><?php echo $this->_tpl_vars['pager']; ?>
</span>
		</div>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['BoardContent']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <div class="<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['ListType']; ?>
">
			<div class="FBC_ChkboxAndSN">
				<?php if ($this->_tpl_vars['ForAdmin']['isAdmin']): ?>
					<div class="FBC_CheckBox"><input type="checkbox" value="<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['SNinF']; ?>
" name="selector[]" /></div>
				<?php endif; ?>
				<div class="<?php if ($this->_tpl_vars['ForAdmin']['isAdmin']): ?>FBC_SN_Admin<?php else: ?>FBC_SN<?php endif; ?>"><?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['SN']; ?>
</div>
			</div>
			<div class="FBC_HeadIcon">
				<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['HeadIcon']; ?>

			</div>
            <div class="FBC_Content">
           <!-- <a href="<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['Link']; ?>
"><span>-->
				<div class="FBC_Title"><a href="<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['Link']; ?>
" style="display: block;"><?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['title']; ?>
</a></div>
				<span>作者：<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['uid']; ?>
(<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['name']; ?>
)</span>
			</div>
			<div class="FBC_TimeAndReply">
				<div class="<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['ReadStatus']; ?>
">
					<span class="FBC_Reply_inner">
						[回應:<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['replys']; ?>
]
					</span>
				</div>
				<div class="clearboth"></div>
				<div class="FBC_Time">
					<span class="FBC_Reply_inner">
						發表時間：<?php echo $this->_tpl_vars['BoardContent'][$this->_sections['loop']['index']]['time']; ?>

					</span>
				</div>
                <!--</span></a>-->
			</div>
		</div>
		<?php endfor; endif; ?>
	</form>
    <?php if (! $this->_tpl_vars['BoardContent']): ?>
         <div class="FBCListTop" style="text-align:center;padding-top:20px;">
            現在沒有文章，你可利用左上角 [發表文章] 的功能來新增第一篇文章
         </div>
    <?php endif; ?>
</div>
<div style="clear:both;width:900px">
	<span class="pageBar"><?php echo $this->_tpl_vars['pager']; ?>
</span>
</div>