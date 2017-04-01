<?
require_once("./mainfile.php");

if ($currconfig->openreg && $curruser->isguest())
{
	if (isset($_POST["register_user"]))
	{
		$_POST["uid"] = trim($_POST["uid"]);

		$user = new User();

		$chk = true;

		if (!$_POST["uid"])
		{
			$chk = false;
			$errmsg =  "請確認帳號名稱";
		}
		else if (!preg_match("/^[a-z][a-z0-9_]*$/i", $_POST["uid"]))
		{
			$chk = false;
			$errmsg =  "帳號請使用英文字母及數字&nbsp;&nbsp;";
		}
		else if(preg_file(ROOT_PATH.'/etc/badid', $_POST['uid']))
		{
			$chk = false;
			$errmsg = "此帳號禁止使用&nbsp;&nbsp;";
		}

		if(trim($_POST['name']) != $_POST['name'] || preg_file(ROOT_PATH.'/etc/badname', $_POST['name']))
		{
			$chk = false;
			$errmsg = '此暱稱禁止使用&nbsp;&nbsp;';
		}
		
		if (!$chk)
		{
			$user = $user->u_handler->getuserbyid($_POST["uid"]);

			if ($user->uno > 0)
			{
				$chk = false;
				$errmsg = "此帳號已有人使用&nbsp;&nbsp;";
			}
		}

		if (strlen($_POST["pwd"]) < 6)
		{
			$chk = false;
			$errmsg .= "密碼長度需大於 6 個字元&nbsp;&nbsp;";
		}

		if ($_POST["pwd"] != $_POST["pwd_i"])
		{
			$chk = false;
			$errmsg .= "兩次密碼輸入不相同&nbsp;&nbsp;";
		}

		if (empty($_POST["realname"]) || empty($_POST["name"]) || empty($_POST["sex"]) || empty($_POST["department"]))
		{
			$chk = false;
			$errmsg .= "請檢查必填欄位&nbsp;&nbsp;";
		}

		if ($chk)
		{
			$user->u_handler->registeruser($_POST["uid"], _encrypt($_POST["pwd"]));
			$user = $user->u_handler->getuserbyid($_POST["uid"]);

			$criteria = new CriteriaCompo(new Criteria("name", htmlencode($_POST["name"])));
			$criteria->add(new Criteria("realname", htmlencode($_POST["realname"])));
			$criteria->add(new Criteria("name", htmlencode($_POST["name"])));
			$criteria->add(new Criteria("sex", ($_POST["sex"] == "boy") ? "男" : "女"));
			$criteria->add(new Criteria("department",  htmlencode($_POST["department"])));
			$criteria->add(new Criteria("website", str_replace("http://", "", htmlencode($_POST["website"]))));
			$criteria->add(new Criteria("email", (!empty($_POST["email"]) && strpos($_POST["email"], "@") > 0) ? htmlencode($_POST["email"]) : ""));
			$criteria->add(new Criteria("intro", htmlencode($_POST["intro"])));

			//if(!in_array($_POST['face'],array('A','B','C','D','E','F','G','H','I','J')))$_POST['face'] = 'A';
			$criteria->add(new Criteria("pic",$_POST['pic']));

			$user->u_handler->modifyuser($user->uno, $criteria);

			$_SESSION["user_uid"] = $user->uid;
			$curruser = $curruser->u_handler->getuserbyid($_SESSION["user_uid"]);

			$curruser->g_handler->memberAdd($curruser->g_handler->getGroupByEngName($_POST['department']),$curruser->uno,1);
			$curruser->g_handler->memberAdd($curruser->g_handler->getGroupByEngName('ncuuser'),$curruser->uno,1);
			
			/* -----
			Add a new item into shop_personal
			------ */
			$item_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("shop"))."` ORDER BY `ino` ASC");
			$item_arr = array();
			while($item_single = $currdb -> fetch_array($item_src))
			{
				array_push($item_arr, $item_single);
			}
			
			$curr_ino = -1;
			for($i=0; $i<count($item_arr); $i++)
			{
				if($item_arr[$i]['pic'] == (($curruser -> pic).".jpg"))
				{
					$curr_ino = $i + 1;
					break;
				}
			}
			
			if($curr_ino == -1)
			{
				$curr_ino = 1;
			}
			
			$currdb -> query("INSERT INTO `".($currdb -> prefix("shop_personal"))."` (`uid`, `ino`, `much`, `type`) VALUES ('".$curruser->uid."', '".$curr_ino."', '1', 'head')");
			// -----
			
			echo "註冊成功&nbsp;&nbsp;";

			if (!empty($_POST["sid"]) && !empty($_POST["spwd"]))
			{
				require_once('sparc.php');
				/*if (do_valid($_POST["sid"], $_POST["spwd"]))
				{
					$criteria = new CriteriaCompo(new Criteria("sid", $_POST["sid"]));
					$user->u_handler->modifyuser($user->uno, $criteria);

					$user->u_handler->activeuser($user->uno);
					echo "sparc 確認成功&nbsp;&nbsp;";
				}
				else
					echo "sparc 確認失敗&nbsp;&nbsp;";*/
			}
			else
				echo "計中 e-mail 未確認";
				
			$wel_mail = '親愛的使用者，您好：
			
					　　歡迎使用2009大一生活知訊網，知訊網為大一新生彙集了中大校園及鄰近生活的各項資訊，還有貼心設計的「註冊精靈」及「史卡舅」將協助提醒大一新生順利完成各項註冊程序，一路陪你迎接豐富多元的大學生活！

					　　「2009大一生活知訊網」開啟您大學生最青春的一頁，請盡情善加運用吧！';

			msgsend($curruser->uid,'歡迎來到大一生活知訊網',$wel_mail,'NCUFresh');
		}
		else{
			require_once(ROOT_PATH."/dep.php");

			$currtpl->assign("dep", $dep);

			//$faces = array("A"=>"A","B"=>"B","C"=>"C","D"=>"D","E"=>"E","F"=>"F","G"=>"G","H"=>"H","I"=>"I","J"=>"J"); 
			//$currtpl->assign("faces",$faces);

			$currtpl->assign("errmsg",$errmsg);
			$currtpl->display("register.htm");
//				echo '<br /><a href="'.URL.'/register.php" title="回上一頁">回上一頁</a>';
		}
	}
	else if (isset($_POST["agreerule"]))
	{
		require_once(ROOT_PATH."/dep.php");

		$currtpl->assign("dep", $dep);

		//$faces = array("A"=>"A","B"=>"B","C"=>"C","D"=>"D","E"=>"E","F"=>"F","G"=>"G","H"=>"H","I"=>"I","J"=>"J"); 
		//$currtpl->assign("faces",$faces);
		//$_POST['face'] = 'A';

		$currtpl->display("register.htm");
	}
	else
		$currtpl->display("userule.htm");
}
else 
	_redirect();

?>
