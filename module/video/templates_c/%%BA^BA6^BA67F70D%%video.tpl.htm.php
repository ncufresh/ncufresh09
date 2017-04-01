<?php /* Smarty version 2.6.18, created on 2010-07-01 23:24:52
         compiled from block/video.tpl.htm */ ?>
<script type="text/javascript" src="module/video/templates/js.js"></script>


<div class="l_area">

<!--影片播放區-->
<div id="video_bg">
    <div id="video_win">
        <div id="video_title">
            <span class="video_title">影音專區</span>
            <a href="#" onclick="close_video();return false;" class="delete_box">&nbsp;</a>
        </div>
        <iframe id="video_frame" name="video_frame" frameborder="0" width="800" height="580" src="" scrolling="no" style="background-color:#000000;"></iframe>
		<!--<iframe id="video_frame" name="video_frame" frameborder="0" width="720" height="500" src="" scrolling="no"></iframe>-->
    </div>
</div>
<!---->

	<?php if ($this->_tpl_vars['block']['perm'] == true): ?>
        <div class="l_admin">
            <form action="module/video/admin.php">
            <input type="submit" value="Admin" style="float:left;" />
            </form>
        </div>
    <?php endif; ?>
    <input type="hidden" id="page" name="page" value="<?php echo $this->_tpl_vars['block']['page']; ?>
" />
    
    <div class="l_tittle">
    	<span class="l_name">
            <?php echo $this->_tpl_vars['block']['data']['0']['name']; ?>

        </span>
    </div>
    
	<div class="l_block">
        <span class="l_preview">
            <input type="image" id="image" src="module/video/<?php echo $this->_tpl_vars['block']['data']['0']['image']; ?>
" width="240" height="180" onClick="open_video();" />
            <input type="hidden" id="no" name="no" value="<?php echo $this->_tpl_vars['block']['data']['0']['no']; ?>
" />
        </span>
    </div>
    
    
    <div class="l_intro">
        <?php echo $this->_tpl_vars['block']['data']['0']['content']; ?>

    </div>
    
    
    <div class="l_list">
        <input type="image" class="l_button" src="module/video/templates/movAreaL.png" onClick="page('U');" onMouseOver="button('U');" onMouseOut="button('A');" />           
        <input type="image" class="l_button2" src="module/video/templates/movAreaR.png" onClick="page('D');" onMouseOver="button('D');" onMouseOut="button('B');" />

		<div class="l_block">
            <div class="l_images">
                <img id="l_imagel" class="l_image" src="module/video/<?php echo $this->_tpl_vars['block']['data']['0']['image']; ?>
" onMouseOver="over('l'); quick('l');" onMouseOut="out('l');" >
                <input type="hidden" id="l_imagexl" value="<?php echo $this->_tpl_vars['block']['data']['0']['no']; ?>
" />
                <img id="l_imagec" class="l_image" src="module/video/<?php echo $this->_tpl_vars['block']['data']['1']['image']; ?>
" onMouseOver="over('c'); quick('c');" onMouseOut="out('c');" >
                <input type="hidden" id="l_imagexc" value="<?php echo $this->_tpl_vars['block']['data']['1']['no']; ?>
" />
                <img id="l_imager" class="l_image" src="module/video/<?php echo $this->_tpl_vars['block']['data']['2']['image']; ?>
" onMouseOver="over('r'); quick('r');" onMouseOut="out('r');" >
                <input type="hidden" id="l_imagexr" value="<?php echo $this->_tpl_vars['block']['data']['2']['no']; ?>
" />
            </div>
        </div>
    </div>
</div>