<?php /* Smarty version 2.6.18, created on 2009-08-08 22:20:05
         compiled from admin.tpl.htm */ ?>
<div class="a_con">

	<!--影片播放區-->
    <div id="video_bg">
        <div id="video_win">
            <div id="video_title">
                <span class="video_title">影音專區</span>
                <a href="#" onclick="close_video();return false;" class="delete_box">&nbsp;</a>
            </div>
            <iframe id="video_frame" name="video_frame" frameborder="0" width="720" height="540" src="" scrolling="no"></iframe>
        </div>
    </div>
    <!---->

    <?php if ($this->_tpl_vars['perm'] == true): ?>
        <div class="a_adminx">
            <form action="fileget.php" method="post" enctype="multipart/form-data">
            影片名稱：<br /><input type = "text" name="name" /><br /><br />
            上傳影片：(低畫質)<br /><input type = "file" name="low" size="44" /><br /><br />
            上傳影片：(高畫質)<br /><input type = "file" name="video" size="44" /><br /><br />
            上傳圖片：(播放器640x480)<br /><input type = "file" name="image" size="44" /><br /><br />
            內容介紹：(請自行空兩格，全形約60~78字，四行)<br />
            <textarea name="content"rows="4"cols="40"></textarea>
            <input type="hidden" value="true" name="insert"/>
            <input type="submit" value="送出" />
            </form>
        </div>
    <?php endif; ?>
        
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
    
        <div class="a_block">
        
            <div class="a_imagex">
                <input type="image" class="a_image" src="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['image']; ?>
" onClick="admin_video(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
);" />
            </div>
            <div class="a_intro">
            	
                <?php if ($this->_tpl_vars['perm'] == true): ?>
                    <span class="a_admin">
                        <form action="fileget.php" method="post">
                        <input type="hidden" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" name="no"/>
                        <input type="hidden" value="true" name="delete"/>
                        <input type="submit" value="刪除"/>
                        </form>
                        
                        <br /><br /><br />
                        
                        <form>
                        <input type="button" onclick="edit(<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
);" value="修改" />
                        </form>
                    </span>
                <?php endif; ?>
            	
                <?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['name']; ?>
<br />
                瀏覽人次：<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['browse']; ?>
<br />
                影片介紹：<br />
                
             </div>
        </div>
        
        <?php if ($this->_tpl_vars['perm'] == true): ?>
        	<div class="a_edit" id="edit<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
">
            	<div class="a_adminx">
                <form action="fileget.php" method="post" enctype="multipart/form-data">
                影片名稱：<br /><input type = "text" name="name" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['name']; ?>
"/><br /><br />
                上傳影片：(低畫質)<br /><input type = "file" name="low" /><br /><br />
            	上傳影片：(高畫質)<br /><input type = "file" name="video" /><br /><br />
                上傳圖片：(播放器640x480)<br /><input type = "file" name="image" value="-----"/><br /><br />
                內容介紹：(請自行空兩格，全形約60~78字，四行)<br />
                <textarea name="content"rows="4"cols="40" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['content']; ?>
"></textarea>
                <input type="hidden" value="<?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['no']; ?>
" name="no"/>
                <input type="hidden" value="true" name="update"/>
                <input type="submit" value="修改" />								
                </form>
                </div>
            </div>
        <?php endif; ?>
        
    <?php endfor; endif; ?>
    
</div>