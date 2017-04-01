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
    <blockquote>
	<div style="float:left"><form action="<{$newQuestLink}>" method="post" ><input type="submit" value="新增問題" /></form></div>
	<div style="float:left"><form action="addSheet.php?Qid=<{$sheetNum}>" method="post" ><input type="submit" value="確認送出" /></form></div>
	<div style="float:left"><form action="./index.php" method="post" ><input type="submit" value="以後再作" /></form></div>
	<div style="float:left"><form action="giveupSheet.php?Qid=<{$sheetNum}>" method="post" ><input type="submit" value="放棄 刪除" /></form></div>
	<br/>
    </blockquote>
		
<{section name=qst loop=$questions}></br></p><br>
	<div class="newquestion"><{$smarty.section.qst.iteration}>. <{$questions[qst]}>   
    <{if $type[qst]=="radio"}>  <單選題> <{else}> <多選題> <{/if}></div>
		<blockquote>
		<{section name=choose loop=$choose[qst]}>	
            	<div class="chooses"><{$smarty.section.choose.iteration}>. <{if $choose[qst][choose]!="others"}>
          		<input name="<{$chsname[qst]}>" type="<{$type[qst]}>" value="<{$choose[qst][choose]}>"><{$choose[qst][choose]}></div>
          		<{elseif $choose[qst][choose]=="others"}>
          			<input type="<{$type[qst]}>" name="<{$chsname[qst]}>" value="otherson">其他：</div>
          			<div class="chooses"><textarea name="ans<{$smarty.section.qst.iteration-1}>-TEXT"></textarea></div>
          		<{/if}>
         <{/section}>
		 </blockquote>
	<blockquote>
	<div style="float:right"><form action="delQuestion.php?Qid=<{$sheetNum}>&sig=<{$smarty.section.qst.iteration}>" method="post" ><input type="submit" value="刪除問題" /></form></div>
    <div style="float:right"><form action="editQuestion.php?Qid=<{$sheetNum}>&sig=<{$smarty.section.qst.iteration}>" method="post" ><input type="submit" value="編輯問題" /></form></div>
	</blockquote>
<{/section}>

</div>



