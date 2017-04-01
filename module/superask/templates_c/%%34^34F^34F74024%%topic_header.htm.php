<?php /* Smarty version 2.6.18, created on 2009-07-27 15:01:43
         compiled from topic_header.htm */ ?>
<div class="header">
<div class="select_club select<?php if ($this->_tpl_vars['club'] == 0 && $this->_tpl_vars['_WikiTopic']->cno <= 30): ?>1<?php else: ?>2<?php endif; ?>"><a href="index.php" title="進入系學會介紹" class="select_menu">進入系學會介紹</a></div>
<div class="select_club select<?php if ($this->_tpl_vars['club'] == 0 && $this->_tpl_vars['_WikiTopic']->cno <= 30 || $this->_tpl_vars['_WikiTopic']->tno == 217): ?>2<?php else: ?>1<?php endif; ?>"><a href="club.php" title="進入社團介紹" class="select_menu">進入社團介紹</a></div>
<div class="select_club select<?php if ($this->_tpl_vars['_WikiTopic']->tno == 217): ?>1<?php else: ?>2<?php endif; ?>"><a href="view.php?tno=217" title="進入學生會介紹" class="select_menu">進入學生會介紹</a></div>
</div>