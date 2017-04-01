<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<a href="index.php?Qnew=1"><span id="QA_IhaveQuestion"></span></a>
		<{if !$curruser->isguest()}>
	        <a href="#re"><span id="QA_IReQuestion"></span></a>
		<{/if}>
                <a href="index.php">
                    <img src="templates/images/iconGoback.gif" alt="回上一頁"/></a>
	</div>
	<div class="QA_divideBAR"></div>
		<div class="QA_leftcontent">
		<img class="QA_img" src="../shop/items_pic/<{$QA_Articals.pic}>.jpg"><br />
		<span class="RA_author"><a href="../../msgsend.php?fno=<{$QA_Articals.uno}>"><img src="./templates/images/mailicon.png"></a>寄信給他</span><br />
		<span class="RA_author">帳號:<{$QA_Articals.author}></span> <br />
		<span class="RA_name">暱稱:<{$QA_Articals.name}></span> <br />
		<span class="RA_dep">身分:<{$QA_Articals.dep}></span> <br />
	</div>
	<div class="QA_rightcontent">
		<span class="QA_title">[<{$QA_Articals.cls}>]&nbsp;<{$QA_Articals.title}></span>
		<span class="QA_re">[回應:<{$QA_Articals.reply}>]</span><br class="clear" />
		<span class="QA_content"><{$QA_Articals.content}></span>
		<{if $admin}>
            <a href="delQuest.php?Qno=<{$QA_Articals.num}>"><span class="QA_change">[刪除文章]</span></a>
	    	<a href="index.php?Qchg=1&Qno=<{$QA_Articals.num}>"><span class="QA_change">[修改文章]</span></a>
		<{/if}>
		<span class="QA_time">發表時間:<{$QA_Articals.time}></span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBAR"></div>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<{if $uppages!=-1}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$uppages}>"><span class="QA_page_select"><</span></a>
			<{/if}>
			<{section name=i loop=$pages}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$pages[i]}>">
                <span class="QA_page_select page<{if $currpage==$smarty.section.i.iteration}> QA_currpage<{/if}>">
                    <{$pages[i]}>
                </span></a>
			<{/section}>
			<{if $downpages!=-1}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$downpages}>"><span class="QA_page_select">></span></a>
			<{/if}>
            <span class="QA_page_select2">
                <form action="index.php" method="get">
                    <input name="page" type="text" size="2" value="頁數"/>
                    <input name="QAno" type="hidden" value="<{$QA_Articals.num}>"/>
                </form>
            </span>
		</span>
	</div>
	<div class="QA_divideBARre"></div>
	<{section name=loop loop=$RA_Articals}>
	<div class="QA_leftcontent">
		<img class="QA_img" src="../shop/items_pic/<{$RA_Articals[loop].pic}>.jpg">
		<span class="RA_author">帳號:<{$RA_Articals[loop].author}></span> <br />
		<span class="RA_name">暱稱:<{$RA_Articals[loop].name}></span> <br />
		<span class="RA_dep">身分:<{$RA_Articals[loop].dep}></span> <br />
	</div>
	<div class="QA_rightcontent">
		<span class="RA_floor"><{$RA_Articals[loop].floor}>F</span>
		<span class="RA_content"><{$RA_Articals[loop].content}></span>
		<span class="QA_time">發表時間:<{$RA_Articals[loop].time}></span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBARre"></div>
	<{/section}>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<{if $uppages!=-1}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$uppages}>"><span class="QA_page_select"><</span></a>
			<{/if}>
			<{section name=i loop=$pages}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$pages[i]}>">
                <span class="QA_page_select page<{if $currpage==$smarty.section.i.iteration}> QA_currpage<{/if}>">
                    <{$pages[i]}>
                </span>
            </a>
			<{/section}>
			<{if $downpages!=-1}>
			<a href="index.php?QAno=<{$QA_Articals.num}>&page=<{$downpages}>"><span class="QA_page_select">></span></a>
			<{/if}>
            <span class="QA_page_select2">
                <form action="index.php" method="get">
                    <input name="page" type="text" size="2" value="頁數"/>
                    <input name="QAno" type="hidden" value="<{$QA_Articals.num}>"/> 
                </form>
            </span>
		</span>
	</div>
	<{if !$curruser->isguest()}>
	<a name="re"></a>
	<form action="./newRe.php" method="post" >
	<input name="Qno" type="hidden" value="<{$QA_Articals.num}>" />
	<input name="Rfloor" type="hidden" value="<{$QA_Articals.reply}>" />
		<div style="float:left">回覆文章:</div><br />
			<textarea id="QA_ReplyArea" rows="10" cols="70" name="descript"></textarea><br /><br />
		<div class="QA_submit"><input type="submit" value="送出" /><input name="" type="reset" /></div>
	</form>
	<{/if}>
</div>
