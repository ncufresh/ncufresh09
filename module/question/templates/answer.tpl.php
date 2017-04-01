<div class="table" > 
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
	<{if $anschk==1}><p align="center">請確實填寫問卷內容</p><{/if}>
	<form method="post" action="./importAnswer.php?Qid=<{$SheetNumber}>" >
	<{section name=qst loop=$questions}><br /></p><br>
		<div class="newquestion"><{$smarty.section.qst.iteration}>. <{$questions[qst]}> </div><br/>
                <blockquote>
				<{section name=choose loop=$choose[qst]}>	
				<{if $choose[qst][choose]!="others"}>
          		<div class="chooses"><{$smarty.section.choose.iteration}>.<input name="<{$chsname[qst]}>" type="<{$type[qst]}>" value="<{$choose[qst][choose]}>"><{$choose[qst][choose]}></div>
          		<{elseif $choose[qst][choose]=="others"}>
          			<div style="float:left;"><div class="chooses"><{$smarty.section.choose.iteration}>. <input type="<{$type[qst]}>" name="<{$chsname[qst]}>" value="otherson">其他：<textarea name="ans<{$smarty.section.qst.iteration-1}>-TEXT"></textarea></div></div>
          		<{/if}>
               <{/section}>
			   </blockquote>
			   <br />
	<{/section}>
  <input type="hidden" name="uid" value="<{$uid}>">
  <br />
  <div class = "end" align="center" class ="chooses"><input type="submit" name="submit" value="上一頁"><input type="submit" name="submit" value="送出"></div>
  </form>
  </div>
</div>