<table class="table"><tr><td>
<p>題號：第<{$QuestionNum}>題</p>
<form method="get" action="newQuestion.php">
	<input type="hidden" name="sno" value="<{$sno}>">
<p>選項數：<input autocomplete="off" name="ChooseNum" id="ChooseNum" type="text" />
<input type="submit" value="確定"></p>
</form>

<form method="post" action="importQuestions.php?sno=<{$sno}>&ChooseNum=<{$ChooseNum}>&status=new">
<p>題型：
  <select name="select" id="select">
  <option value="1" selected="selected">單選題</option>
  <option value="2">多選題</option>
  </select>
</p>
<input type="hidden" name="sno" value="<{$sno}>">
<input type="hidden" name="SNinGrp" value="<{$QuestionNum}>">
<p>問題敘述：
  <input autocomplete="off" type="text" name="question" id="textfield" />
</p>

<{section name=choose loop=$ChooseNum}>
  <div><{$smarty.section.choose.iteration}>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input autocomplete="off" name="choose[]" type="text" /></div>
        <{sectionelse}>
        <{/section}>
        <br/>
        <input type="checkbox" name="others" value="others" /> 是否有「其他」選項
        <br/>
        
<input type="submit" value="送出">

        <a href="editSheet.php?sno=<{$sno}>"><input type="button" value="回到問卷"></a>
</form>
</td></tr></table>