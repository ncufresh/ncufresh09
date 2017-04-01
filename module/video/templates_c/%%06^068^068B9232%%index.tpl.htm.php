<?php /* Smarty version 2.6.18, created on 2009-07-28 22:38:16
         compiled from index.tpl.htm */ ?>
<div id="background" >
	<img src="movArea.gif" width="421" height="371" />

    <div class="bold"><?php echo $this->_tpl_vars['data']['name']; ?>
</div>
        <script type="text/javascript" src="swfobject.js"></script>
        <script type="text/javascript">
            swfobject.registerObject("player","9.0.98","expressInstall.swf");
        </script>
    
        <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" class="video">
            <param name="movie" value="player-viral.swf" />
            <param name="allowfullscreen" value="true" />
            <param name="allowautoplay" value="true" />
            <param name="allowscriptaccess" value="always" />
            <param name="flashvars" value="file=<?php echo $this->_tpl_vars['play']['video']; ?>
&image=<?php echo $this->_tpl_vars['play']['image']; ?>
" />
            <object type="application/x-shockwave-flash" data="player-viral.swf" class="video">
                <param name="movie" value="player-viral.swf" />
                <param name="allowfullscreen" value="true" />
                <param name="allowscriptaccess" value="always" />
                <param name="flashvars" value="file=<?php echo $this->_tpl_vars['play']['video']; ?>
&image=<?php echo $this->_tpl_vars['play']['image']; ?>
" />
                <p><a href="http://get.adobe.com/flashplayer">Get Flash</a> to see this player.</p>
            </object>
        </object> 
    
    
    <div class="block" >
    	<form action="index.php" method="post" >
    	<input type="submit" class="admin" name="up" value="up" width="20" height="40" onclick="up()" />
        <input type="text" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
        </form>
    
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
" class="image" type="image" src="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['image']; ?>
" onmouseover="over(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
)" onmouseout="out(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
)" />
            <input type="hidden" name="no" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" />
            </form>
        
        <?php endfor; endif; ?>
        
        <form action="index.php" method="post" >
        <input type="submit" class="admin" name="down" value="down" width="20" height="40" onclick="down()" />
        <input type="text" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
        </form>
    
    </div>

</div>
