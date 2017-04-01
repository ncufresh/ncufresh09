<div id="FB_MAIN_OUTER">
	<div id="FB_divideBAR"></div>
	<div id="FB_content">
		<form action="<{if $modify}><{$modify.url}><{else}>./newquest.php<{/if}>" method="post" >
		標題:
		<{if $modify.title}>
		<{$modify.title}>
		<{else}>
		<input name="title" type="text" />
		<{/if}><br /><br />
		<div><div id="NQContent">內容:</div>
		<textarea rows="10" cols="90" name="content"><{$modify.content}></textarea><br /><br />
		</div>
	<div id="FB_submit"><input type="submit" value="確定" />
	<{if $modify}>
	<input type="hidden" value="<{$modify.ano}>" name="ANO"/>
	<input type="hidden" value="update" name="mode"/>
	<{/if}>
	<input type="hidden" value="<{$FNO}>" name="FNO"/>
	<input type="submit" name="submitVal" value="取消" /><input name="" type="reset" /></div>
	</form>
	</div>
</div>
