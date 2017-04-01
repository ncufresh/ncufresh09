<?php /* Smarty version 2.6.18, created on 2010-07-02 08:50:51
         compiled from video_case.tpl.htm */ ?>

<div id="video_container">																						     <!--影片位置-->


	<div id="video_block" style="text-align:center;">
        <div id="video_swf" style="display:inline-block;">
            <embed 
			src="<?php echo $this->_tpl_vars['swf_url']; ?>
?config=%7B
			
			
			
			videoFile%3A%27%2E%2E%2F<?php echo $this->_tpl_vars['play']['video']; ?>
%27%2C
			
			
			controlBar
			
			autoPlay%3A<?php echo $this->_tpl_vars['is_auto_play']; ?>
%7D" 
            width="<?php echo $this->_tpl_vars['frame_width']; ?>
" 
			height="<?php echo $this->_tpl_vars['frame_height']; ?>
" 
			
			bgcolor="111111" 
			
			allowFullScreen="true" 
			allowScriptAccess="always" 
			allowNetworking="all" 
			pluginspage="http://www.macromedia.com/go/getflashplayer">
            </embed>
        </div>
    </div>
    
	<?php if ($this->_tpl_vars['quality'] == '0'): ?>
    <?php endif; ?>
    
    
    <?php if ($this->_tpl_vars['quality'] == 'high'): ?>
    <span id="video_info_right" style="border-top: 0px; float:right; margin-right:10%;">
		<a href="video_case.php?no=<?php echo $this->_tpl_vars['play']['no']; ?>
&quality=low">
        <img style="border:0px;" src="templates/LQ.gif" >
        </a></span>
	<?php endif; ?>
    
	
    <?php if ($this->_tpl_vars['quality'] == 'low'): ?>
    <span id="video_info_right" style="border-top: 0px; float:right; margin-right:10%;">
		<a href="video_case.php?no=<?php echo $this->_tpl_vars['play']['no']; ?>
&quality=high">
        <img style="border:0px;" src="templates/HQ.gif" >
        </a></span>
    <?php endif; ?>

    
</div>
