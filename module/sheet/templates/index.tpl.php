<table class="table">
    <td><div align="center"><img src="templates/images/list.gif"/></div>
        <{if $admin}>
        	<blockquote>
        	 <blockquote><a href="newSheet.php"><input type="button" value="點此新增問券" /></a>   
             <a href="publicSet.php"><input type="button" value="管理問卷是否開放作答" /></a><br/>
         	 </blockquote>
        	</blockquote>
        <{/if}>
    <{section name=gb loop=$title}>
      <br/><br/>
      <div style="float:left">
       	<{if $anscheck[gb]==1}><img src="templates/images/yes.gif" alt="問卷已完成~"/>
       	<{else}><img src="templates/images/empty.gif" alt="問卷未完成~"/>
      	<{/if}>
      </div>
      <div style="float:left">第<{$SN[gb]}>份問卷：<a href="answer.php?sno=<{$SN[gb]}>"><{$title[gb]}></a></div>
      <{if $admin}><div style="float:right"><a href="showStatics.php?sno=<{$SN[gb]}>">觀看回答數據</a></div><{/if}>
      <{if $anscheck[gb]==1}><div style="float:right">(已完成)</div><{/if}>
    <{sectionelse}>
      目前沒有問券~
  	<{/section}> <br />
        <br />
    <div><{$SU}></div></td>
</table>
