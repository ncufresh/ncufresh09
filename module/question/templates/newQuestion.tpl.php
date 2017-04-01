<div class="table">
<p>題號：第<{$QuestionNum}>題</p>
<form method="get" action="newQuestion.php">
	<input type="hidden" name="Qid" value="<{$Qid}>">
<p>選項數：<input autocomplete="off" name="ChooseNum" id="ChooseNum" type="text" />
<input type="submit" value="確定"></p>
</form>

<form method="post" action="importQuestions.php?Qid=<{$Qid}>&ChooseNum=<{$ChooseNum}>&status=new">
<p>題型：
  <select name="select" id="select">
  <option value="1" selected="selected">單選題</option>
  <option value="2">多選題</option>
  </select>
</p>
<input type="hidden" name="Qid" value="<{$Qid}>">
<input type="hidden" name="gid" value="<{$QuestionNum}>">

<div style="float:left">問題敘述：</div>
	<div style="float:left"><textarea autocomplete="off" name="question" id="textfield"><{$qst}></textarea></div>
<p><p>
<br>
<br>
<br>
</p></p>

<{section name=choose loop=$ChooseNum}>
  <div><{$smarty.section.choose.iteration}>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input autocomplete="off" name="choose[]" type="text" /></div>
        <{sectionelse}>
        <{/section}>
        <br/>
        <input type="checkbox" name="others" value="others" /> 是否有「其他」選項
        <br/>
        
<input type="submit" value="送出"></form>
<div style="float:left"><form action="editSheet.php?Qid=<{$Qid}>" method="post" ><input type="submit" value="回到問卷" /></form></div>

</div>