<?php /* Smarty version 2.6.18, created on 2009-07-31 00:11:49
         compiled from index11.tpl.htm */ ?>
﻿
<div class="area">
    
    <script type="text/javascript" src="swfobject.js"></script>
    <script type="text/javascript">
        swfobject.registerObject("player","9.0.98","expressInstall.swf");
    </script>
    
    
    <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" class="l_video">
        <param name="movie" value="player-viral.swf" />
        <param name="allowfullscreen" value="true" />
        <param name="allowautoplay" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="flashvars" value="file=<?php echo $this->_tpl_vars['play']['video']; ?>
&image=<?php echo $this->_tpl_vars['play']['image']; ?>
" />
        <object type="application/x-shockwave-flash" data="player-viral.swf" class="l_video">
            <param name="movie" value="player-viral.swf" />
            <param name="allowfullscreen" value="true" />
            <param name="allowscriptaccess" value="always" />
            <param name="flashvars" value="file=<?php echo $this->_tpl_vars['play']['video']; ?>
&image=<?php echo $this->_tpl_vars['play']['image']; ?>
" />
            <p><a href="http://get.adobe.com/flashplayer">Get Flash</a> to see this player.</p>
        </object>
    </object> 
    
    
    <div class="l_list">
        
        <form action="index.php" method="post" class="l_button" >
        <input type="submit" value=" " onclick="up()" />
        <input type="hidden" name="up" value="up" />
        <input type="hidden" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
        </form>
        
        <form action="index.php" method="post" class="l_button2" >
        <input type="submit" value=" " onclick="down()" />
        <input type="hidden" name="down" value="down" />
        <input type="hidden" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
        </form>
        
        <div class="l_images">
            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <form action="index.php" method="post" >
                <input id="image<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" class="l_image" type="image" src="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['image']; ?>
" onmouseover="over(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
)" onmouseout="out(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
)" />
                <input type="hidden" name="no" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" />
                </form>
            <?php endfor; endif; ?>
        </div>

    </div>
    
    <div class="l_list2">
    
    	<div class="l_intro">
            <span class="l_bold"><?php echo $this->_tpl_vars['play']['name']; ?>
</span><br />
			<br />
            <span class="l_right"><?php echo $this->_tpl_vars['play']['browse']; ?>
</span><br />
            <span class="l_right"><?php echo $this->_tpl_vars['play']['date']; ?>
</span><br />
        </div>
        
        <div class="l_content">
			<?php echo $this->_tpl_vars['play']['content']; ?>

        </div>
    
    </div>

</div>