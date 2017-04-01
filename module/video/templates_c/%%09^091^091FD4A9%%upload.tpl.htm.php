<?php /* Smarty version 2.6.18, created on 2009-07-23 22:28:33
         compiled from upload.tpl.htm */ ?>
<form action="fileget.php" method="post" enctype="multipart/form-data">
影片名稱：<br /><input type = "text" name="name" /><br /><br />
上傳影片：(640*480)<br /><input type = "file" name="video" /><br /><br />
上傳圖片：(640*480)<br /><input type = "file" name="image" /><br /><br />
內容介紹：(四行以內，請自己空兩格全形xD)<br /><textarea name="content"rows="5"cols="32"></textarea>
<input type="hidden" value="insert" name="insert"/>
<input type="submit" value="送出" />