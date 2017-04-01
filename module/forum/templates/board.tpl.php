<div id="forum_board_outer">
	<div id="forum_board_banner">
	<div id="fb_left">
		<{$ForAdmin.upload}>
		<div id="fb_name">
			<{$BoardInfo.pic}><br />
			<a href="<{$BoardInfo.Link}>">
			<{$BoardInfo.board_cname}><br />
			<span id="fb_engname"><{$BoardInfo.board_ename}></span>
			</a>
		</div>
	</div>
	<div id="fb_right">
		<span id="fb_right_container">
			<{$BoardInfo.descripe}>	
			<{$ForAdmin.edit}>
			<{$ForAdmin.editContent}>
		</span>
	</div>
	</div>
	
	<form id="forum_board_content" method="post" action="board_admin.php">
		<div id="FBC_Banner">
			<!---<a href="newquest.php?fno=<{$BoardInfo.FNO}>"><img src="./templates/images/departButton01.gif"/></a>-->
			<{if $ForAdmin.isAdmin}>
                <input type="submit" value="切換置頂" name="submit"/>
		    	<input type="submit" value="刪除" name="submit"/>
		    	<input type="hidden" value="<{$BoardInfo.FNO}>" name="FNO">
            <{/if}>
			<span class="pageBar"><{$pager}></span>
		</div>
		<{section name=loop loop=$BoardContent}>
        <div class="<{$BoardContent[loop].ListType}>">
			<div class="FBC_ChkboxAndSN">
				<{if $ForAdmin.isAdmin}>
					<div class="FBC_CheckBox"><input type="checkbox" value="<{$BoardContent[loop].SNinF}>" name="selector[]" /></div>
				<{/if}>
				<div class="<{if $ForAdmin.isAdmin}>FBC_SN_Admin<{else}>FBC_SN<{/if}>"><{$BoardContent[loop].SN}></div>
			</div>
			<div class="FBC_HeadIcon">
				<{$BoardContent[loop].HeadIcon}>
			</div>
            <div class="FBC_Content">
           <!-- <a href="<{$BoardContent[loop].Link}>"><span>-->
				<div class="FBC_Title"><a href="<{$BoardContent[loop].Link}>" style="display: block;"><{$BoardContent[loop].title}></a></div>
				<span>作者：<{$BoardContent[loop].uid}>(<{$BoardContent[loop].name}>)</span>
			</div>
			<div class="FBC_TimeAndReply">
				<div class="<{$BoardContent[loop].ReadStatus}>">
					<span class="FBC_Reply_inner">
						[回應:<{$BoardContent[loop].replys}>]
					</span>
				</div>
				<div class="clearboth"></div>
				<div class="FBC_Time">
					<span class="FBC_Reply_inner">
						發表時間：<{$BoardContent[loop].time}>
					</span>
				</div>
                <!--</span></a>-->
			</div>
		</div>
		<{/section}>
	</form>
    <{if !$BoardContent}>
         <div class="FBCListTop" style="text-align:center;padding-top:20px;">
            現在沒有文章，你可利用左上角 [發表文章] 的功能來新增第一篇文章
         </div>
    <{/if}>
</div>
<div style="clear:both;width:900px">
	<span class="pageBar"><{$pager}></span>
</div>
