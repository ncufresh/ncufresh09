<div id="QA_Ten_ALL">
	<div id="QA_Ten_banner"></div>
	<div id="QA_Ten_container">
		<{section name=loop loop=$QA_Ten_List}>
		<a href="<{$QA_Ten_List[loop].Link}>">
			<div class="QA_Ten_List">
				<span class="QA_Ten_Pic">
					<img src="templates/images/<{$QA_Ten_List[loop].Pic}>">
				</span>
				<span class="QA_Ten_Text">
					<{$QA_Ten_List[loop].Text}>
				</span>
			</div>
		</a>
		<{/section}>
	</div>
	<div id="QA_Ten_footer"></div>
</div>