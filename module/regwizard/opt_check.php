<?php
require_once ("../../mainfile.php");

$islogin = ($curruser -> isguest()) ? 0 : 1;

if($_GET['action']=="process")
{
	$opt = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_opt"))."` WHERE rwoID=".$_GET['rwoID']."");
	
	if((judge_freshman($curruser -> sid)) && isset($_GET['rwoID']) && ($currdb -> num_rows($opt) != 0))
	{
		$opt_array = $currdb -> fetch_array($opt);
		
		if(check_display_type($opt_array) == "necessary" || check_display_type($opt_array) == "non-necessary")
		{
			$currdb -> query("INSERT INTO `".($currdb -> prefix("regwizard_data"))."` (uno, rwoID, finish, finish_datetime) VALUES ('".($curruser -> uno)."','".($_GET['rwoID'])."','1','".mktime()."')");
		
			_redirect("index.php?action=finished");
		}
		else
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			echo_goback();
		}
	}
	else
	{
		echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
		echo_goback();
	}
}
else
{
	if(!isset($_GET['rwoID']))
	{
		echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
		echo_goback();
	}
	else
	{
		$opt = $currdb -> query("SELECT * FROM `".$currdb -> prefix("regwizard_opt")."` WHERE rwoID = ".($_GET['rwoID'])." ");
		
		if(($currdb -> num_rows($opt)) != 0)
		{
			$opt_dis = $currdb -> fetch_array($opt);
			
			$request_month;
			if((int)substr($opt_dis['rwo_date_begin'], 5, 2) != 0)
			{
				$request_month = (!empty($_GET['request_month'])) ? $_GET['request_month'] : (int)substr($opt_dis['rwo_date_begin'], 5, 2) ;
			}
			else
			{
				$request_month = (!empty($_GET['request_month'])) ? $_GET['request_month'] : (int)date("n", mktime()) ;
			}
			
			$opt_dis['opt_necessary'] = check_necessary($opt_dis);
			$opt_dis['dis_type'] = check_display_type($opt_dis);
			
			// Use 'dis_type' to judge displaying the relative data or not
			// The data would be displayed when 'dis_type' not equal to "hidden"
			if($opt_dis['dis_type'] != "hidden")
			{
				// Processing relative links
				$opt_rel_links = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_rel_links") )."` WHERE rwoID = ".$opt_dis['rwoID']." ORDER BY rel_l_ID ASC");
				
				$opt_rel_links_display = array();
				
				while($opt_rel_links_processing = $currdb -> fetch_array($opt_rel_links))
				{
					array_push($opt_rel_links_display, $opt_rel_links_processing);
				}
				
				// Processing the array to be displayed
				// --- Output the template ---
				$opt_dis['rwo_date_display'] = avail_date_display($opt_dis['rwo_datetype'], $opt_dis['rwo_date_begin'], $opt_dis['rwo_date_end']);
				
				
				// ---
				// Process the right-side wizard
				$opt_list = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_opt"))."` ORDER BY `rwo_date_begin` ASC");
				
				$opt_list_dis = array();	// $opt_list_dis is a 2-D array.
				$opt_nums_total = 0;		// Count the numbers of all non-hidden options.
				$opt_nums_complete = 0;		// Count the numbers of options user completed.
				
				if($islogin == 1)
				{
					while($opt_list_dis_processing = $currdb -> fetch_array($opt_list))	// $opt_list_dis_processing is an 1-D array.
					{
						$opt_list_dis_processing['dis_type'] = check_display_type($opt_list_dis_processing);
						
						if($opt_list_dis_processing['dis_type'] == "complete")
						{
							$opt_nums_complete++;
						}
					
						if($opt_list_dis_processing['dis_type'] != "hidden")
						{
							$opt_nums_total++;
							
							$opt_list_dis_processing['rwo_date_display'] = avail_date_display($opt_list_dis_processing['rwo_datetype'], $opt_list_dis_processing['rwo_date_begin'], $opt_list_dis_processing['rwo_date_end']);
							
							switch($opt_list_dis_processing['dis_type'])
							{
								case "non-begin":
									$opt_list_dis_processing['rwo_img_alt'] = 1; //"時間未到不可執行工作";
									break;
								case "necessary":
									$opt_list_dis_processing['rwo_img_alt'] = 2; //"[必要] 尚為完成";
									break;
								case "non-necessary":
									$opt_list_dis_processing['rwo_img_alt'] = 3; //"[非必要] 尚未完成";
									break;
								case "complete":
									$opt_list_dis_processing['rwo_img_alt'] = 4; //"已完成";
									break;
								case "non-complete":
									$opt_list_dis_processing['rwo_img_alt'] = 5; //"未於時間內完成";
									break;
								default:
									echo "ERROR! <br />";
							}
							
							//array_push($opt_list_dis, $opt_list_dis_processing);
							if($opt_list_dis_processing['rwo_img_alt'] == 2 || $opt_list_dis_processing['rwo_img_alt'] == 3)
							{
								array_push($opt_list_dis, $opt_list_dis_processing);
							}
						}
					}
				}
				
				
				$c_dis = array();
				if($islogin == 1)
				{
					switch(check_level($opt_nums_complete, $opt_nums_total))
					{
						case 1:
							$c_dis['id'] = 1;
							$c_dis['desc'] = "baby";
							break;
						case 2:
							$c_dis['id'] = 2;
							$c_dis['desc'] = "child";
							break;
						case 3:
							$c_dis['id'] = 3;
							$c_dis['desc'] = "student";
							break;
						case 4:
							$c_dis['id'] = 4;
							$c_dis['desc'] = "teenager";
							break;
						case 5:
							$c_dis['id'] = 5;
							$c_dis['desc'] = "adult";
							break;
						default:
							echo "ERROR<br />";
					}
				}
				// ---
				
				$curr_opt_msg;
				$form_complete_submit = NULL;
				
				if(judge_freshman($curruser -> sid))
				{
					switch(check_display_type($opt_dis))
					{
						case "non-begin":
							$curr_opt_msg = "此一行程尚未開始進行喔！";
							break;
						case "necessary":
							$curr_opt_msg = "此一行程為必要行程，如果已經完成，請點選「我已閱讀完畢！」";
							$form_complete_submit = "<center><input name=\"submit\" type=\"submit\" value=\"我已閱讀完畢！\" /></center>";
							break;
						case "non-necessary":
							$curr_opt_msg = "此一行程為非必要行程，如果已經完成，請點選「我已閱讀完畢！」";
							$form_complete_submit = "<center><input name=\"submit\" type=\"submit\" value=\"我已閱讀完畢！\" /></center>";
							break;
						case "complete":
							$curr_opt_msg = "您已經完成此一工作囉！";
							break;
						case "non-complete":
							$curr_opt_msg = "喔喔！您並未於時間內完成此行程 T^T";
							break;
						case "hidden":
							$curr_opt_msg = "您並非大一新生，或您尚未登入，故無法完成註冊精靈選項喔！";
							break;
						default:
							echo "ERROR! <br />";
					}
				}
				else
				{
					$curr_opt_msg = "您並非大一新生，或您尚未登入，故無法完成註冊精靈選項喔！";
				}
				
				// -- nav bar ---
				$curr_addr = array();
				
				$curr_addr['name'] = $opt_dis['rwo_name'];
				$curr_addr['url'] = $currconfig -> url."/module/regwizard/opt_check.php?rwoID=".$opt_dis['rwoID']."#reg_content";
				array_push($currsite, $curr_addr);
				// -- nav bar ---
				
				$currtpl -> assign('curr_opt_msg', $curr_opt_msg);
				$currtpl -> assign('form_complete_submit', $form_complete_submit);
				
				
				$currtpl -> assign('opt_rel_links_display', $opt_rel_links_display);
				$currtpl -> assign('opt_dis', $opt_dis);
				
				$currtpl -> assign('curr_rwoID', $_GET['rwoID']);
				$currtpl -> assign('request_month', $request_month);
				$currtpl -> assign('islogin', $islogin);
				$currtpl -> assign('c_dis', $c_dis);
				
				$currtpl -> display("opt_check.tpl.htm");
			}
			else
			{
				echo "找不到對應的註冊精靈選項，或該選項不可使用；請返回上一頁重試。";
				echo_goback();
			}
		}
		else
		{
			echo "找不到對應的註冊精靈選項，或該選項不可使用；請返回上一頁重試。";
			echo_goback();
		}
	}
}

?>
