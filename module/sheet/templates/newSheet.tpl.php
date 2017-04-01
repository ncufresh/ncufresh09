<table class="table"><tr><td>
<div align="center">問卷名稱及問卷說明務必確實填寫</div>
<p>這是第<{$sheetNum}>份問券</p>
<form action="./editSheet.php?sno=<{$sheetNum}>" method="post" >
  問卷名稱：
    <input AUTOCOMPLETE="off" type="text" name="topic">
    <input AUTOCOMPLETE="off" type="hidden" name="sheetNum" value="<{$sheetNum}>">
  <br/><br/>

  <div style="float:left">問卷說明：</div><div>
<textarea AUTOCOMPLETE="off" rows="5" cols="50" name="descript"></textarea></div>
    <p>
    <input type="hidden" name="status" value="new">
    <input type="submit" value="下一步" /></form>
<p>
   <a href="<{$currconfig->url}>/redirect.php?1"><input type="button" name="button" id="button" value="上一頁"></a>
    </p>
<p>&nbsp;尚未完成的問卷：</p>
<{section name=sheet loop=$link}>
<p><a href="<{$link[sheet]}>"><{$linkname[sheet]}></a></p>
<{/section}>
</td></tr></table>