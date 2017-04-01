<body>
	<form>
		<table border="1" bordercolor="bbccdd" width="400">
			<{section name=post loop=$post}>
				<tr><td width="30%"><a target="_blank" href="view.php?pno=<{$post[post].pno}>"><{$post[post].title}></a></td><td width="30%"><{$post[post].poster_id}></td><td width="30%"><{$post[post].impeach_id}></td><td width="10%"><a href="de_impeach.php?tno=<{$post[post].tno}>">取消</a></td></tr>
			<{/section}>
		</table>
	</form>
</body>
