<div id="campus_all">
	<!--<div id="campus_main_menu">
        main_menu
    </div>-->
	<div id="campus_center_block" <{$SpecialCase}>  >
		<div id="cp_introduce" class="<{$Switcher.CSM}>" >
			<div id="cp_intro_top">
				<span id="cp_editsele"></span>
				<span id="cp_submenu"<{$SpecialCase2}>><{$campus_submenu}></span>
				<span id="CP_Icon"></span>
			</div>
			<div id="cp_intro_content_outer">
				<div id="cp_intro_content">
					<{$campus_intro}>
				</div>
			</div>
			<div id="cp_intro_bottom"></div>
		</div>
		<NoScript><span id="pleaseUseJS">請開啟JavaScript功能以獲得完整的功能</span></NoScript>
		<{section name=loop loop=$buildingContent}>
			<a href="#" onclick="return false;"><div <{$buildingContent[loop]}>"></div></a>
		<{/section}>
		
	</div>
</div>

<div id="spannnn">
<!--<a href="templates/images/depart.jpg" title="HAHA" rel="lightbox"><img height="600" alt="" src="templates/images/depart.jpg"/></a>-->
</div>



