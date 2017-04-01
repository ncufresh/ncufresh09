<?php /* Smarty version 2.6.18, created on 2010-07-01 23:35:58
         compiled from block/search.htm */ ?>
<div id="search_block">  <form method="get" action="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/search.php">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="全站搜尋" name="keyword_input" size="10" maxlength="255" onfocus="if(this.value=='全站搜尋'){this.value=''}" onblur="if(this.value==''){this.value='全站搜尋'}" />&nbsp;<input class="search_button" type="submit" value=" GO " onclick="javascript: search() ;" />
  </form>
</div>