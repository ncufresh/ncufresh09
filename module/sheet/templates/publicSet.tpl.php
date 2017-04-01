
<table class="table">
  <td>
    <div align="center"><img src="templates/images/list.gif"/></div>
        <blockquote>
          <blockquote><br/>
          </blockquote>
        </blockquote>
    <{section name=gb loop=$title}>
      <br/><br/>
      <div style="float:left">
       	<{if $pubcheck[gb]==1}><img src="templates/images/yes.gif" alt="問卷開放中"/>
       	<{else}><img src="templates/images/no.gif" alt="問卷未開放"/>
      	<{/if}>
      </div>
      <div style="float:left">第<{$SN[gb]}>份問卷：<a href="answer.php?sno=<{$SN[gb]}>"><{$title[gb]}></a></div>
      <div style="float:right"><a href="switchPublic.php?sno=<{$SN[gb]}>">切換此份問卷是否開放</a></div>
  	<{/section}> <br />
        <br />
         <a href="index.php"><input type="button" name="button" id="button" value="上一頁"></a>
  </td>
</table>
