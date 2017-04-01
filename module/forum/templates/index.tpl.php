<div id="forum_outer">
	<div id="forum_inner">
		<div id="forum_departlist_block">
			<div id="forum_depl_banner"></div>
			<div id="forum_depl_container">
				<div class="forum_depl" id="depl_liberalart"></div>
				<{section name=loop loop=$forum.libart}>
					<div class="forum_dl_lib"><{$forum.libart[loop]}></div>
				<{/section}>
				<div class="forum_depl" id="depl_science"></div>
				<{section name=loop loop=$forum.sci}>
					<div class="forum_dl_lib"><{$forum.sci[loop]}></div>
				<{/section}>
				<div class="forum_depl" id="depl_engineering"></div>
				<{section name=loop loop=$forum.engineer}>
					<div class="forum_dl_lib"><{$forum.engineer[loop]}></div>
				<{/section}>				
				<div class="forum_depl" id="depl_management"></div>
				<{section name=loop loop=$forum.management}>
					<div class="forum_dl_lib"><{$forum.management[loop]}></div>
				<{/section}>
				<div class="forum_depl" id="depl_information"></div>
				<{section name=loop loop=$forum.info}>
					<div class="forum_dl_lib"><{$forum.info[loop]}></div>
				<{/section}>				
				<div class="forum_depl" id="depl_earth"></div>
				<{section name=loop loop=$forum.earth}>
					<div class="forum_dl_lib"><{$forum.earth[loop]}></div>
				<{/section}>				
			</div>
			<div id="forum_depl_footer"></div>
		</div>

		<div id="forum_clublist_block">
			<div id="forum_cl_banner"></div>
			<div id="forum_cl_container">
			
				<div class="forum_cl" id="cl_hm"></div>
				<div class="list_container">
					<{section name=loop loop=$forum.havemoney}>
						<span class=forum_cl_lib><{$forum.havemoney[loop]}></span>
					<{/section}>
				</div>
				
				<div class="forum_cl" id="cl_haha"></div>
				<div class="list_container">
					<{section name=loop loop=$forum.haha}>
						<span class=forum_cl_lib><{$forum.haha[loop]}></span>
					<{/section}>
				</div>
				<div class="forum_cl" id="cl_help"></div>
				<div class="list_container">
					<{section name=loop loop=$forum.help}>
						<span class=forum_cl_lib><{$forum.help[loop]}></span>
					<{/section}>
				</div>
				<div class="forum_cl" id="cl_learn"></div>
				<div class="list_container">	
					<{section name=loop loop=$forum.learn}>
						<span class=forum_cl_lib><{$forum.learn[loop]}></span>
					<{/section}>
				</div>
				<div class="forum_cl" id="cl_associate"></div>
				<div class="list_container">
					<{section name=loop loop=$forum.asso}>
						<span class=forum_cl_lib><{$forum.asso[loop]}></span>
					<{/section}>
				</div>
			</div>
			<div id="forum_cl_footer"></div>
		</div>
	</div>
</div>