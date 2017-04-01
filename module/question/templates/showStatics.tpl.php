<div class="table"> 
		<div class = "header" >
		<br />
		<br />
		<br />
			<div style="font-size:120%;">
			&nbsp;&nbsp;&nbsp;問卷標題:<{$topic}><br /><br />
			&nbsp;&nbsp;&nbsp;問卷概述:
			<blockquote>
				<p><{$description}>        </p>
			</blockquote>		
			<img src="templates/images/QuBar.gif"/>
		</div>
		<br />
	<{if $anschk==1}><p align="center">請確實填寫問卷內容</p><{/if}>
<{section name=qst loop=$questions}></br>
</p><br>
	<div class="newquestion">
    		<{$smarty.section.qst.iteration}>. <{$questions[qst]}> 
    		<{if $type[qst]=="radio"}>
    			<單選題>
    		<{elseif $type[qst]=="checkbox"}>
    			<多選題>
    		<{/if}>
			</div>
        <br /><br />
		<div style="float:right"><a href="./showStatics.php?Qid=<{$Qid}>&qis=<{$smarty.section.qst.iteration}>">顯示詳細資料</a> </div>
    <{section name=choose loop=$choose[qst]}> 
    	<div class="chooses"><{$smarty.section.choose.iteration}>.
        	<{if $choose[qst][choose]!="others"}>
          		<{$choose[qst][choose]}>&nbsp;&nbsp;出現&nbsp;&nbsp;
          		<{if $anscount[$smarty.section.qst.iteration][$smarty.section.choose.iteration]!=0}>
          			<{$anscount[$smarty.section.qst.iteration][$smarty.section.choose.iteration]}>
          		<{else}>0
            	<{/if}>&nbsp;&nbsp;次
          	<{elseif $choose[qst][choose]=="others"}>其他&nbsp;&nbsp;出現&nbsp;&nbsp;
          <{if $othercount[$smarty.section.qst.iteration]!=0}>
          <{$othercount[$smarty.section.qst.iteration]}>
          <{else}>0<{/if}>&nbsp;&nbsp;次<{/if}>
          </div><br/><{/section}> 

<{/section}><br /><br /><br />
  <div align="center"><form action="index.php" method="post" ><input type="submit" name="button" id="button" value="上一頁"></form></div>
</div>
</div>