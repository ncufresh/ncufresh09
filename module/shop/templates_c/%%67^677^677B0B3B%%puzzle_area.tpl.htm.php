<?php /* Smarty version 2.6.18, created on 2009-08-11 06:37:42
         compiled from puzzle_area.tpl.htm */ ?>
<div style="clear:both;height:630px;">

<script language="javascript">
var btn=".draggable";
function k($i){
	J(btn+$i).draggable();
};

var divNo = document.getElementsByTagName("div").length;
//alert(divNo);
function changeIndex(me){
	if(changeIndex.top)
		changeIndex.top.style.zIndex="";
	me.style.zIndex=100;
	changeIndex.top=me;
}

J(document).ready(function(){
    var box = {
        width: 150,
        height: 150
    };

    var score = 0;    

    J('.dest').droppable({
        drop: function(event, ui) {
            if (ui.draggable.attr('id') ==  J(this).attr('id')){
                ui.draggable
                    .css('left', J(this).css('left'))
                    .css('top', J(this).css('top'));
                
                ui.draggable.draggable('disable');
                ++score;
                if (score == 16){
                    alert('Good Job');
					location.href="http://localhost/work_v11/module/shop/<?php echo $this->_tpl_vars['lazy_p']; ?>
"
                }
            }

        }				
    });
});



</script>


<style rel="stylesheet"  href="game.css" type="text/css" media="screen">
	.ui-draggable{ 
	width: 150px;
	height:150px;
	}
	
	#block {
	display:inline-block;
	position:absolute;
	}
	
	 .dest{
	position:absolute; 
	background-color: #CCFF33;
	width: 150px;
	height: 150px;
	}
</style>
	
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['puzzle_area']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<a href="puzzle_area.php?ino=<?php echo $this->_tpl_vars['puzzle_area'][$this->_sections['i']['index']]['ino']; ?>
"><?php echo $this->_tpl_vars['puzzle_area'][$this->_sections['i']['index']]['item']; ?>
</a>   
<?php endfor; endif; ?>
<br />

<div id="block">
	<div>
		<div>
			<span id="clip1" class="dest ui-droppable" style="border-style: groove; left: 250px; top: 10px;"></span>
			<span id="clip2" class="dest ui-droppable" style="border-style: groove; left: 400px; top: 10px;"></span>
			<span id="clip3" class="dest ui-droppable" style="border-style: groove; left: 550px; top: 10px;"></span>
			<span id="clip4" class="dest ui-droppable" style="border-style: groove; left: 700px; top: 10px;"></span>
		</div>
		<div>
			<span id="clip5" class="dest ui-droppable" style="border-style: groove; left: 250px; top: 160px;"></span>
			<span id="clip6" class="dest ui-droppable" style="border-style: groove; left: 400px; top: 160px;"></span>
			<span id="clip7" class="dest ui-droppable" style="border-style: groove; left: 550px; top: 160px;"></span>
			<span id="clip8" class="dest ui-droppable" style="border-style: groove; left: 700px; top: 160px;"></span>
		</div>
		<div>
			<span id="clip9" class="dest ui-droppable" style="border-style: groove; left: 250px; top: 310px;"></span>
			<span id="clip10" class="dest ui-droppable" style="border-style: groove; left: 400px; top: 310px;"></span>
			<span id="clip11" class="dest ui-droppable" style="border-style: groove; left: 550px; top: 310px;"></span>
			<span id="clip12" class="dest ui-droppable" style="border-style: groove; left: 700px; top: 310px;"></span>
		</div>
		<div>
			<span id="clip13" class="dest ui-droppable" style="border-style: groove; left: 250px; top: 460px;"></span>
			<span id="clip14" class="dest ui-droppable" style="border-style: groove; left: 400px; top: 460px;"></span>
			<span id="clip15" class="dest ui-droppable" style="border-style: groove; left: 550px; top: 460px;"></span>
			<span id="clip16" class="dest ui-droppable" style="border-style: groove; left: 700px; top: 460px;"></span>
		</div>
	</div>


	<span id="clip1" class="draggable<?php echo $this->_tpl_vars['puzzle'][0]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['1']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['1']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][0]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][0]['ino']; ?>
)"/>
	</span>

	<span id="clip2" class="draggable<?php echo $this->_tpl_vars['puzzle'][1]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['2']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['2']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][1]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][1]['ino']; ?>
)"/>
	</span>

	<span id="clip3" class="draggable<?php echo $this->_tpl_vars['puzzle'][2]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['1']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['3']['v']; ?>
px; " onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][2]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][2]['ino']; ?>
)"/>
	</span>

	<span id="clip4" class="draggable<?php echo $this->_tpl_vars['puzzle'][3]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['4']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['4']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][3]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][3]['ino']; ?>
)"/>
	</span>

	<span id="clip5" class="draggable<?php echo $this->_tpl_vars['puzzle'][4]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['5']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['5']['v']; ?>
px; " onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][4]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][4]['ino']; ?>
)"/>
	</span>

	<span id="clip6" class="draggable<?php echo $this->_tpl_vars['puzzle'][5]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['6']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['6']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][5]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][5]['ino']; ?>
)"/>
	</span>

	<span id="clip7" class="draggable<?php echo $this->_tpl_vars['puzzle'][6]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['7']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['7']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][6]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][6]['ino']; ?>
)"/>
	</span>

	<span id="clip8" class="draggable<?php echo $this->_tpl_vars['puzzle'][7]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['8']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['8']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][7]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][7]['ino']; ?>
)"/>
	</span>

	<span id="clip9" class="draggable<?php echo $this->_tpl_vars['puzzle'][8]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['9']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['9']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][8]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][8]['ino']; ?>
)"/>
	</span>

	<span id="clip10" class="draggable<?php echo $this->_tpl_vars['puzzle'][9]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['10']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['10']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][9]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][9]['ino']; ?>
)"/>
	</span>

	<span id="clip11" class="draggable<?php echo $this->_tpl_vars['puzzle'][10]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['11']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['11']['v']; ?>
px; " onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][10]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][10]['ino']; ?>
)"/>
	</span>

	<span id="clip12" class="draggable<?php echo $this->_tpl_vars['puzzle'][11]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['12']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['12']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][11]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][11]['ino']; ?>
)"/>
	</span>


	<span id="clip13" class="draggable<?php echo $this->_tpl_vars['puzzle'][12]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['13']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['13']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][12]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][12]['ino']; ?>
)"/>
	</span>
	
	<span id="clip14" class="draggable<?php echo $this->_tpl_vars['puzzle'][13]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['14']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['14']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][13]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][13]['ino']; ?>
)"/>
	</span>

	<span id="clip15" class="draggable<?php echo $this->_tpl_vars['puzzle'][14]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['15']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['15']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][14]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][14]['ino']; ?>
)"/>
	</span>

	<span id="clip16" class="draggable<?php echo $this->_tpl_vars['puzzle'][15]['ino']; ?>
 ui-draggable" style="position: absolute; top:<?php echo $this->_tpl_vars['block']['16']['h']; ?>
px; left: <?php echo $this->_tpl_vars['block']['1']['v']; ?>
px;" onMouseDown="changeIndex(this)">
		<img  width="150px" height="150px" src="./items_pic/<?php echo $this->_tpl_vars['puzzle'][15]['pic']; ?>
" onMouseDown="k(<?php echo $this->_tpl_vars['puzzle'][15]['ino']; ?>
)"/>
	</span>
	<br />
	<?php if ($this->_tpl_vars['check'] != 0): ?>
		<a href="javascript:if(confirm('確定就這樣不拼拼圖了嗎？ 其實你只是按錯了吧!!')) location.href='<?php echo $this->_tpl_vars['lazy_p']; ?>
'">不想拼了</a><br /><br />
	<?php endif; ?>
		<a href="items.php?uid=<?php echo $this->_tpl_vars['curruser']->uid; ?>
">回商品區</a>
	</div>
</div>