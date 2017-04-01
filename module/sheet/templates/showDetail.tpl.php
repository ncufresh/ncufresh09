<script type="text/javascript">
	function switchgraph()
	{
		if ($('graph_0').style.display == 'block')
		{
			$('graph_0').style.display = 'none';
			$('graph_1').style.display = 'block';
		}
		else
		{
			$('graph_0').style.display = 'block';
			$('graph_1').style.display = 'none';
		}
	}
	
</script>



    <table class="table"><td><div class="question" style="float:left">
	問題<{$qis}> : <{$questions[$qqis]}> 
    <{if $type[$qis]=="radio"}>
    	<單選題>
    <{elseif $type[$qis]=="checkbox"}>
    	<多選題>
    <{/if}>
	</div>
	<div id="graph_0" style="display:<{$graphdisplay[0]}>" ><div class="chart_1st"><{$graphpie}></div></div>
    <div id="graph_1" style="display:<{$graphdisplay[1]}>" ><div class="chart"><{$graphsketch}></div></div>
	<br/><br/><br/>
	<{section name=choose loop=$choose[$qqis]}> 
    <div class="chooses">
	 選項<{$smarty.section.choose.iteration}>:
     	  <{if $choose[$qqis][choose]!="others"}>
          	<{$choose[$qqis][choose]}>&nbsp;&nbsp;出現&nbsp;&nbsp;
          	<{if $anscount[$qis][$smarty.section.choose.iteration]!=0}>
          		<{$anscount[$qis][$smarty.section.choose.iteration]}>
          	<{else}>0<{/if}>&nbsp;&nbsp;次
          <{elseif $choose[$qqis][choose]=="others"}>其他&nbsp;&nbsp;出現&nbsp;&nbsp;
          	<{if $othercount[$qis]!=0}>
          	<{$othercount[$qis]}>
          	<{else}>0<{/if}>&nbsp;&nbsp;次
          <{/if}>
	</div><br/><{/section}> 
	<br/><br/>
	<{if $othercontent!=NULL}>
    以下是諸位使用者的怒吼：<br /><br /><br />
		<{section name=times loop=$othercontent[$qis]}>
  			<{$othercontent[$qis][times]|default:"<這茶包居然沒有留下他的意見>"}><br/><br />--------------------------------------------------<br /><br />
  		<{/section}>
    <{else}>
		<{if $otheraru==1}>
			沒有使用者想要怒吼<br />
		<{/if}>
	<{/if}><br /><br />
  <div style="float:left;clear:both"> <a href="showStatics.php?sno=<{$sno}>"><input type="button" name="button" id="button" value="上一頁"/></a></div>
    <a onclick="switchgraph();return false;" href="showStatics.php?sno=<{$sno}>&qis=<{$qis}>&show=<{$switch}>"><div style="float:right;clear:both"> <input type="button" name="button" id="button" value="切換圖表" ></a></div>
</td></table>