<div class="table">
<div align="center">問卷名稱及問卷說明務必確實填寫</div>
<p>這是第<{$sheetNum}>份問券</p>
<form action="./editSheet.php?Qid=<{$sheetNum}>" method="post" >
  問卷標題：
    <input AUTOCOMPLETE="off" type="text" name="topic">
    <input AUTOCOMPLETE="off" type="hidden" name="sheetNum" value="<{$sheetNum}>">
  <br/><br/>

  <div style="float:left">問卷概述：</div><div>
<textarea AUTOCOMPLETE="off" rows="5" cols="50" name="descript"></textarea></div>
    <p>
    <input type="hidden" name="status" value="new">
    <input type="submit" value="下一步" /></form>
<p>
	<div style="float:left"><form action="<{$currconfig->url}>/redirect.php?1" method="post" ><input type="submit" name="button" id="button" value="上一頁"></form></div>
    </p>
<br />
<br />
<br />
<p>&nbsp;尚未完成的問卷：</p>
<{section name=sheet loop=$link}>
<p><a href="<{$link[sheet]}>">&nbsp;<{$linkname[sheet]}></a></p>
<{/section}>
</div>