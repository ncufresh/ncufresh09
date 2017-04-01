<div id="VB_Outer">
	<div class="VB_PostData">
		<div class="VB_UserInfoSide">
			<div class="VB_HeadIcon">
				<{$TopPoster.HeadIcon}>
			</div>
			<div class="VB_UserInfo">
			<a href="<{$TopPoster.Mail}>"><img src="templates/images/mail.png"/></a>寄信給他<br />
            帳號：<{$TopPoster.uid}><br />
			暱稱：<{$TopPoster.name}><br />
			系級：<{$TopPoster.department}><br />
			</div>
		</div>
		<div id="VB_TopArticalPlace">
			<div id="VB_Artical_title"><{$TopPoster.title}></div>
			<div id="VB_Replys">
				<{if $TopPoster.admin}><a href="modify.php?ano=<{$ano}>&forum=<{$fno}>">[修改文章]</a><{/if}>[回應:<{$TopPoster.replys}>]
			</div>
			<div class="clearboth"></div>
			<div class="VB_Content">
				<{$TopPoster.content}>
			</div>
			<div class="clearboth"></div>

			
			<div class="VB_PostTime">
				發表時間:<{$TopPoster.time}>
			</div>
		</div>
	</div>
	<div class="clearboth"></div>
	<div id="VB_Navigate">
		<a href="board.php?forum=<{$fno}>"><img src="./templates/images/departButton03.gif"/></a>
		<!---<a href="newquest.php?fno=<{$BoardInfo.FNO}>"><img src="./templates/images/departButton01.gif"/></a>-->
		<!---<a href="#ReplyArea"><img src="./templates/images/departButton02.gif"/></a>-->
		<span class="pageBar"><{$pager}></span>
	</div>
	
	<{section name=loop loop=$VBReply}>
	<div class="VB_PostData">
		<div class="VB_UserInfoSide">
			<div class="VB_HeadIcon">
				<{$VBReply[loop].HeadIcon}>
			</div>
			<div class="VB_UserInfo">
				帳號：<{$VBReply[loop].uid}><br />
				暱稱：<{$VBReply[loop].name}><br />
				系級：<{$VBReply[loop].department}><br />
			</div>
		</div>
		<div class="ArticalPlace">
			
			<div class="VB_Floors">
				<{$VBReply[loop].floor}>
			</div>
			
			<div class="VB_Content">
				<{$VBReply[loop].content}>
			</div>
			<div class="VB_PostTime">
				發表時間:<{$VBReply[loop].time}>
			</div>
		</div>
	</div>
	<div class="clearboth diver">
		<{if $VBReply[loop].Last==1}>
			<span class="pageBar"><{$pager}></span>
		<{/if}>
	</div>
	<{/section}>
	
	<a name="ReplyArea"></a>
	<!---<div id="VB_ReplyArea">
		回覆文章：<br />
		<form action="reply.php" method="post">
		<textarea name="content" cols="172" rows="10"></textarea>
		<input class="VB_RA_BTN" type="reset" value="重填"/>
		<input class="VB_RA_BTN" type="submit" value="回覆"/>
		<input name="ano" value="<{$ano}>" type="hidden"/>
		<input name="fno" value="<{$fno}>" type="hidden"/>
		
		</form>
	</div>-->
	<div class="clearboth diver"></div>
</div>













