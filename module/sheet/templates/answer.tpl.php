<table class="table"> 
<tr><td>
	<div align="center"><img src="templates/images/Topic.gif"/></div>
		<blockquote>
   	 		<blockquote>
      			<{$topic}>
    		</blockquote>
  		</blockquote>
  	<div align="center"><img src="templates/images/info.gif"/></div>
  		<blockquote>
    		<blockquote>
      			<p><{$description}>        </p>
                <{if $anschk==1}><p align="center">請確實填寫問卷內容</p><{/if}>
    		</blockquote>
  		</blockquote>
	<form method="post" action="./importAnswer.php?sno=<{$SheetNumber}>" >
	<{section name=qst loop=$questions}></br></p><br>
		<div><div class="question">問題<{$smarty.section.qst.iteration}> : <{$questions[qst]}> </div><br/>
                <{section name=choose loop=$choose[qst]}>	
            <div>
            	<div class="chooses">選項<{$smarty.section.choose.iteration}>:<{if $choose[qst][choose]!="others"}>
          		<input name="<{$chsname[qst]}>" type="<{$type[qst]}>" value="<{$choose[qst][choose]}>"><{$choose[qst][choose]}>
          		<{elseif $choose[qst][choose]=="others"}>
          			<input type="<{$type[qst]}>" name="<{$chsname[qst]}>" value="otherson">其他：</div>
          			<div><textarea name="ans<{$smarty.section.qst.iteration-1}>-TEXT"></textarea></div>
          		<{/if}>
			</div><br />
                <{/section}>
		</div>
	<{/section}>
  <a href="<{$currconfig->url}>/redirect.php?1"><input type="button" name="button" id="button" value="上一頁"></a>
  <input type="hidden" name="uid" value="<{$uid}>">
  <input type="submit" value="送出"></form>
</td></tr></table>