<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<div class="QA_divideBAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<{$QA_Ten_title}></div>
		<div class="QA_content">
		<form action="./chgQuest.php" method="post" >
		分類:
			<select name="select" value="<{$QA_Articals.cls}>">
			<{section name=loop loop=$QA_cls}>
				<option value="<{$QA_cls[loop].num}>"><{$QA_cls[loop].content}></option>
			<{/section}>
			</select><br /><br />
		標題:
			<input name="title" type="text" value="<{$QA_Articals.title}>"/><br /><br />
		<div style="float:left">內容:</div>
			<textarea rows="10" cols="70" name="descript"><{$QA_Articals.content}></textarea><br /><br />
			<input name="Qno" type="hidden" value="<{$QA_Articals.num}>">
		<div class="QA_submit"><input type="submit" value="確定" /><input type="submit" value="取消" /><input name="" type="reset" /></div>
		</form>
		</div>
	</div>
</div>