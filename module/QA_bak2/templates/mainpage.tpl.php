<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<a href="index.php?Qnew=1"><span id="QA_IhaveQuestion"></span></a>
			<span class="QA_cataselect">
			文章分類檢視:
				<select name="select" onChange="location.href=this.options[this.selectedIndex].value;">
					<option value="#">分類</option>
				<{section name=loop loop=$QA_cls}>
					<option value="index.php?select=<{$QA_cls[loop].num}>"<{if ($smarty.get.select==$QA_cls[loop].num)}>selected="selected"<{/if}>><{$QA_cls[loop].content}></option>
				<{/section}>
				</select>
			</span>
		<span id="QA_pageNavigate">
			<{if $uppages!=-1}>
			<a href="index.php?page=<{$uppages}>"><span class="QA_page_select"><</span></a>
			<{/if}>
			<{section name=i loop=$pages}>
			<a href="index.php?page=<{$pages[i]}>">
                <span class="QA_page_select page<{if $currpage==$smarty.section.i.iteration}> QA_currpage<{/if}>">
                    <{$pages[i]}>
                </span>
            </a>
			<{/section}>
			<{if $downpages!=-1}>
			<a href="index.php?page=<{$downpages}>"><span class="QA_page_select">></span></a>
			<{/if}>
            <span class="QA_page_select2"><form action="index.php" method="get"><input name="page" size="2" type="text" value="頁數"/></form></span>
		</span>
	</div>
	<div class="QA_divideBAR"></div>
	<{section name=loop loop=$QA_Articals}>
	<div class="QA_leftcontent">
		<img class="QA_img" src="../shop/items_pic/<{$QA_Articals[loop].pic}>.jpg">
	</div>
	<div class="QA_rightcontent">	
		<a href="index.php?QAno=<{$QA_Articals[loop].num}>">
		<span class="QA_title_a">[<{$QA_Articals[loop].cls}>] <{$QA_Articals[loop].title}>
		<{ if $QA_Articals[loop].point == 1 }> 
			...
		<{/if}>
		</span>
		</a>
		<{if $QA_Articals[loop].new == 1}>
		<span class="QA_reNew">[回應:<{$QA_Articals[loop].reply}>]</span>
		<{else}>
		<span class="QA_re">[回應:<{$QA_Articals[loop].reply}>]</span>
		<{/if}>
		<span class="QA_author">作者:<{$QA_Articals[loop].author}></span>
		<span class="QA_time">發表時間:<{$QA_Articals[loop].time}></span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBAR"></div>
	<{/section}>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<{if $uppages!=-1}>
			<a href="index.php?page=<{$uppages}>"><span class="QA_page_select"><</span></a>
			<{/if}>
			<{section name=i loop=$pages}>
			<a href="index.php?page=<{$pages[i]}>">
                <span class="QA_page_select page<{if $currpage==$smarty.section.i.iteration}> QA_currpage<{/if}>">
                    <{$pages[i]}>
                </span>
            </a>
			<{/section}>
			<{if $downpages!=-1}>
			<a href="index.php?page=<{$downpages}>"><span class="QA_page_select">></span></a>
			<{/if}>
            <span class="QA_page_select2"><form action="index.php" method="get">
                <input id="QA_page_inputor" name="page" size="2" type="text" value="頁數"/> </form></span>
		</span>
	</div>
</div>
