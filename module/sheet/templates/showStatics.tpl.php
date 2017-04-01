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
<{section name=qst loop=$questions}></br>
</p><br>
<table width="600" border="0">
  <tr>
    <td><div class="question">
    		<div style="float:left">問題<{$smarty.section.qst.iteration}> : <{$questions[qst]}> 
    		<{if $type[qst]=="radio"}>
    			<單選題>
    		<{elseif $type[qst]=="checkbox"}>
    			<多選題>
    		<{/if}>
			</div>
        </div>
		<div style="float:right"><a href="./showStatics.php?sno=<{$sno}>&qis=<{$smarty.section.qst.iteration}>">顯示詳細資料</a> </div>
    <br/>
    <{section name=choose loop=$choose[qst]}> 
    	<div class="chooses">選項<{$smarty.section.choose.iteration}>:
        	<{if $choose[qst][choose]!="others"}>
          		<{$choose[qst][choose]}>&nbsp;&nbsp;出現&nbsp;&nbsp;
          		<{if $anscount[$smarty.section.qst.iteration][$smarty.section.choose.iteration]!=0}>
          			<{$anscount[$smarty.section.qst.iteration][$smarty.section.choose.iteration]}>
          		<{else}>0
            	<{/if}>&nbsp;&nbsp;次
          	<{elseif $choose[qst][choose]=="others"}>其他&nbsp;&nbsp;出現&nbsp;&nbsp;
          <{if $othercount[$smarty.section.qst.iteration]!=0}>
          <{$othercount[$smarty.section.qst.iteration]}>
          <{else}>0<{/if}>&nbsp;&nbsp;次<{/if}>
          </div><br/><{/section}> </td>

  </tr>
</table>

<{/section}><br /><br /><br />

  <a href="index.php"><input type="button" name="button" id="button" value="上一頁"></a>
</td></tr></table>