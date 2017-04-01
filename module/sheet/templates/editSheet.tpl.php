<table class="table"><tr><td>
<div class="question">第<{$sheetNum}>份問卷 - <{$topic}></div>
<br/><div class="question">問卷說明：<{$description}></div> 
<br/> 
</a><div class="question">
<a href="<{$newQuestLink}>">
<input type="button"  value="新增問題" />
  </a>
<a href="addSheet.php?sno=<{$sheetNum}>">
<input type="button" value="確認送出"/>
  </a>
<a href="./index.php">
<input type="button" value="以後再作" />
  </a>
<a href="giveupSheet.php?sno=<{$sheetNum}>">
<input type="button" value="放棄了放棄了，砍掉吧._.\~/" /> 
  </a> </div>
<br/>
<{section name=qst loop=$questions}></br></p><br>
		<div><div class="question">問題<{$smarty.section.qst.iteration}>: <{$questions[qst]}>   
    <{if $type[qst]=="radio"}>  <單選題> <{else}> <多選題> <{/if}></div>
    <a href="editQuestion.php?sno=<{$sheetNum}>&sig=<{$smarty.section.qst.iteration}>"><input type="button" value="編輯問題" /></a> 
    <a href="delQuestion.php?sno=<{$sheetNum}>&sig=<{$smarty.section.qst.iteration}>"><input type="button" value="刪除問題" /></a>
       <{section name=choose loop=$choose[qst]}>	
            <div>
            	<div class="chooses">選項<{$smarty.section.choose.iteration}>:<{if $choose[qst][choose]!="others"}>
          		<input name="<{$chsname[qst]}>" type="<{$type[qst]}>" value="<{$choose[qst][choose]}>"><{$choose[qst][choose]}>
          		<{elseif $choose[qst][choose]=="others"}>
          			<input type="<{$type[qst]}>" name="<{$chsname[qst]}>" value="otherson">其他：</div>
          			<textarea name="ans<{$smarty.section.qst.iteration-1}>-TEXT"></textarea>
          		<{/if}>
				
				
			</div><br />
                <{/section}>
		</div>
<{/section}>



</td></tr></table>



