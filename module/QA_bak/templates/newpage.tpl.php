<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<div class="QA_divideBAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<{$QA_Ten_title}></div>
		<div class="QA_content">
		<form action="./newQuest.php" method="post" >
		分類:
			<select name="select">
			<{section name=loop loop=$QA_cls}>
				<option value="<{$QA_cls[loop].num}>"><{$QA_cls[loop].content}></option>
			<{/section}>
			</select><br /><br />
		標題:
			<input name="title" type="text" /><br /><br />
		<div style="float:left">內容:</div>
			<textarea rows="10" cols="70" name="descript"></textarea><br /><br />
		<div class="QA_submit"><input name="submit" type="submit" value="確定" /><input name="submit" type="submit" value="取消" /><input name="" type="reset" /></div>
		</form>
		</div>
	</div>
</div>
