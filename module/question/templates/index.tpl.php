<div class="table">
    <div align="center"><img src="templates/images/list.gif"/></div>
        <{if $admin}>
        	<blockquote>
        	 <blockquote>
			 <div style="float:left"><form action="newSheet.php" method="post" ><input type="submit" value="點此新增問券" /></form></div>
			 <div style="float:right"><form action="publicSet.php" method="post" ><input type="submit" value="管理問卷是否開放作答" /></form></div>
			 <br/>
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
     <{if $anscheck[gb]==1}><div style="float:left">第<{$num[gb]}>份問卷：<a href="answer.php?Qid=<{$id[gb]}>&anscheck=1"><{$title[gb]}></a></div>
	  <{else}><div style="float:left">第<{$num[gb]}>份問卷：<a href="answer.php?Qid=<{$id[gb]}>&anscheck=0"><{$title[gb]}></a></div><{/if}>
      <{if $admin}><div style="float:right"><a href="showStatics.php?Qid=<{$id[gb]}>">觀看回答數據</a></div><{/if}>
      <{if $anscheck[gb]==1}><div style="float:right">(已完成)</div><{/if}>
    <{sectionelse}>
      目前沒有問券~
  	<{/section}> <br />
        <br />
    <div><{$SU}></div>
</div>
