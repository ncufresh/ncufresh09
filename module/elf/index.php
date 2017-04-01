<?php

require_once '../../mainfile.php';

if(elf_keycheck())
{
	$catchpic = substr($_GET['pwd'],0,1);

	elf_save($catchpic, $_SESSION['elf_url']);

	if(count(array_diff(elf_get(), array('R'))) >= 10 && !elf_ismailed()) 
	{
		elf_mail();
		$mail = '親愛的使用者，您好：

　　恭喜您蒐集滿十隻小精靈，現在至右上角個人專區的「個人資料」內的「點我選擇頭像」應已可以看到有十隻可愛的小精靈供您選擇為顯示的圖像！

	若您為中大大一新生，且已經到「個人資料」進行「e-mail 確認」，我們已將您加入至參與抽獎的名單中，預計將於９／３０抽獎

	抽獎結果將會公布於「最新消息」！';

		msgsend($curruser->uid, '恭喜您蒐集到十隻小精靈！', $mail, 'System');
	}

	$currtpl->assign('pic', $catchpic);
	$currtpl->display('congratulation.htm');
}
else
{
	_redirect('elfroom.php');
}

?>
