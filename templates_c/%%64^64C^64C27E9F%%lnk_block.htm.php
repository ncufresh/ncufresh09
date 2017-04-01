<?php /* Smarty version 2.6.18, created on 2010-07-01 23:35:58
         compiled from block/lnk_block.htm */ ?>
<script type="text/javascript">
function get_lnk_content(btn_type)
{
	J.ajax({
		url: "lnk_block_ajax.php?request_id=" + btn_type + "",
		data:
		{
			content: J('#r_block').val(),
			type: 'send'
		},
		
		success:function(response){
			J('div#r_block').html(response);
			r_block.scrollBlock = r_block.scrollHeight;
		}
	});
	
}

function get_lnk(btn_type)
{
	var btn1;
	var btn2;
	var bgimage;
	
	if(btn_type == 1)
	{
		btn1 = "url(templates/images/lnk_1_hover.gif)";
		btn2 = "url(templates/images/lnk_2_a.gif)";
		bgimage = "url(templates/images/lnk_block_background_1.gif)";
	}
	else
	{
		btn1 = "url(templates/images/lnk_1_a.gif)";
		btn2 = "url(templates/images/lnk_2_hover.gif)";
		bgimage = "url(templates/images/lnk_block_background_2.gif)";
	}
	
	get_lnk_content(btn_type);
	
	J("#r_block").css({backgroundImage: bgimage});
	J("#r_block_button_l").css({backgroundImage: btn1});
	J("#r_block_button_r").css({backgroundImage: btn2});
	
}
</script>

<div id="r_block_button">
  <a onclick="get_lnk(1);"><div id="r_block_button_l"></div></a>
  <a onclick="get_lnk(2);"><div id="r_block_button_r"></div></a>
</div>
<div id="r_block"></div>
<script type="text/javascript">get_lnk(1);</script>