<?php /* Smarty version 2.6.18, created on 2010-07-01 23:44:10
         compiled from viewboard.tpl.php */ ?>
﻿<div id="VB_Outer">
	<div class="VB_PostData">
		<div class="VB_UserInfoSide">
			<div class="VB_HeadIcon">
				<?php echo $this->_tpl_vars['TopPoster']['HeadIcon']; ?>

			</div>
			<div class="VB_UserInfo">
			<a href="<?php echo $this->_tpl_vars['TopPoster']['Mail']; ?>
"><img src="templates/images/mail.png"/></a>寄信給他<br />
            帳號：<?php echo $this->_tpl_vars['TopPoster']['uid']; ?>
<br />
			暱稱：<?php echo $this->_tpl_vars['TopPoster']['name']; ?>
<br />
			系級：<?php echo $this->_tpl_vars['TopPoster']['department']; ?>
<br />
			</div>
		</div>
		<div id="VB_TopArticalPlace">
			<div id="VB_Artical_title"><?php echo $this->_tpl_vars['TopPoster']['title']; ?>
</div>
			<div id="VB_Replys">
				<?php if ($this->_tpl_vars['TopPoster']['admin']): ?><a href="modify.php?ano=<?php echo $this->_tpl_vars['ano']; ?>
&forum=<?php echo $this->_tpl_vars['fno']; ?>
">[修改文章]</a><?php endif; ?>[回應:<?php echo $this->_tpl_vars['TopPoster']['replys']; ?>
]
			</div>
			<div class="clearboth"></div>
			<div class="VB_Content">
				<?php echo $this->_tpl_vars['TopPoster']['content']; ?>

			</div>
			<div class="clearboth"></div>

			
			<div class="VB_PostTime">
				發表時間:<?php echo $this->_tpl_vars['TopPoster']['time']; ?>

			</div>
		</div>
	</div>
	<div class="clearboth"></div>
	<div id="VB_Navigate">
		<a href="board.php?forum=<?php echo $this->_tpl_vars['fno']; ?>
"><img src="./templates/images/departButton03.gif"/></a>
		<!---<a href="newquest.php?fno=<?php echo $this->_tpl_vars['BoardInfo']['FNO']; ?>
"><img src="./templates/images/departButton01.gif"/></a>-->
		<!---<a href="#ReplyArea"><img src="./templates/images/departButton02.gif"/></a>-->
		<span class="pageBar"><?php echo $this->_tpl_vars['pager']; ?>
</span>
	</div>
	
	<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['VBReply']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div class="VB_PostData">
		<div class="VB_UserInfoSide">
			<div class="VB_HeadIcon">
				<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['HeadIcon']; ?>

			</div>
			<div class="VB_UserInfo">
				帳號：<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['uid']; ?>
<br />
				暱稱：<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['name']; ?>
<br />
				系級：<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['department']; ?>
<br />
			</div>
		</div>
		<div class="ArticalPlace">
			
			<div class="VB_Floors">
				<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['floor']; ?>

			</div>
			
			<div class="VB_Content">
				<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['content']; ?>

			</div>
			<div class="VB_PostTime">
				發表時間:<?php echo $this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['time']; ?>

			</div>
		</div>
	</div>
	<div class="clearboth diver">
		<?php if ($this->_tpl_vars['VBReply'][$this->_sections['loop']['index']]['Last'] == 1): ?>
			<span class="pageBar"><?php echo $this->_tpl_vars['pager']; ?>
</span>
		<?php endif; ?>
	</div>
	<?php endfor; endif; ?>
	
	<a name="ReplyArea"></a>
	<!---<div id="VB_ReplyArea">
		回覆文章：<br />
		<form action="reply.php" method="post">
		<textarea name="content" cols="172" rows="10"></textarea>
		<input class="VB_RA_BTN" type="reset" value="重填"/>
		<input class="VB_RA_BTN" type="submit" value="回覆"/>
		<input name="ano" value="<?php echo $this->_tpl_vars['ano']; ?>
" type="hidden"/>
		<input name="fno" value="<?php echo $this->_tpl_vars['fno']; ?>
" type="hidden"/>
		
		</form>
	</div>-->
	<div class="clearboth diver"></div>
</div>












