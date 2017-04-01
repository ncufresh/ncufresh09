<table class="table"><tr><td>
<p>題號：第<{$QuestionNum}>題</p>
<form method="get" action="editQuestion.php">
	<input type="hidden" name="sno" value="<{$sno}>">
   	<input type="hidden" name="sig" value="<{$QuestionNum}>">
<p>選項數：<input autocomplete="off" name="ChooseNum" id="ChooseNum" type="text" />
<input type="submit" value="確定"></p>
</form>

<form method="post" action="importQuestions.php?sno=<{$sno}>&ChooseNum=<{$ChooseNum}>&status=edit">
<p>題型：
  <{if $type=="1"}>
  <input type="hidden" name="SNinGrp" value="<{$QuestionNum}>">
  <select name="select" id="select">
  <option value="1" selected="selected">單選題</option>
  <option value="2">多選題</option>
  </select>
  <{elseif $type=="2"}>
  <input type="hidden" name="SNinGrp" value="<{$QuestionNum}>">
  <select name="select" id="select">
  <option value="1">單選題</option>
  <option value="2" selected="selected">多選題</option>
  </select>
  <{/if}>

</p>

<div style="float:left">問題敘述：</div>
  <div style="float:left"><textarea autocomplete="off" name="question" id="textfield"><{$qst}></textarea></div>
<p><p>
<br>
<br>
<br>
</p></p>

<{section name=choose loop=$ChooseNum}>
  <div><{$smarty.section.choose.iteration}>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input autocomplete="off" name="choose[]" type="text" value="<{$Chooses[choose]}>" /></div>
         <input type="hidden" name="oldchses[]" value="<{$Chooses[choose]}>">
        <{sectionelse}>
        <{/section}>
        <br/>
        <{if $others==1}><input type="checkbox" name="others" value="others" checked /> 
        <{else}><input type="checkbox" name="others" value="others" />
        <{/if}>
        是否有「其他」選項
        <br/>

<input type="submit" value="送出">
        <a href="editSheet.php?sno=<{$sno}>"><input type="button" value="回到問卷"></a>
</form>
</td></tr></table>