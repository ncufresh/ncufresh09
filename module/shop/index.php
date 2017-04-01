<?php
require_once'../../mainfile.php';
$currtpl->setndisplay();
if(!$curruser->isguest())    //確認已登入
{
if($currmodule->isadmin($curruser))
  $admin=1;
}
else
 _savePage(URL.'/include/user.php?login_form=1');	
$currtpl -> assign('admin',$admin);
$currtpl -> assign('coins', $curruser->coins);
$currtpl -> addcss(ROOT_PATH.'/module/'.$currmodule->name.'/index.css');
$currtpl -> display('index.tpl.htm');
?>