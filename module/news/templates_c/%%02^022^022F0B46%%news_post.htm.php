<?php /* Smarty version 2.6.18, created on 2009-08-21 10:02:16
         compiled from news_post.htm */ ?>
<div>
	<form action="news_do.php?newpost=1&action=1" method="post" enctype="multipart/form-data">
		<table border="0">
			<tr>
			<td>標題：</td><td align="left"><input type="text" name="title"></td>
			</tr>
			<tr>
			<td>置頂：</td><td align="left"><input type="radio" name="top" value="1">是<input type="radio" name="top" value"0" checked>否</td>
			</tr>
			<tr>
			<td valign="top">內容：</td><td><textarea rows="20" cols="140" name="content"></textarea></td>
			</tr>
			<tr>
			<td>上傳檔案：</td><td align="left"><input type="file" name="upfile"></td>
			</tr>
            <tr>
            <td>寄發站內信？</td><td><input type="checkbox" name="sendmail" /></td>
            </tr>
			<tr>
			<td colspan="2" align="center"><input type="submit" value="送出"><input type="reset" value="重填"><input type="button" onClick="history.go(-1)" value="放棄"></td>
			</tr>
		</table>
	</form>
</div>