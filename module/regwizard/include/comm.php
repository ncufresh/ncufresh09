<?php
require_once("../../mainfile.php");

// functions of echoing repeat contents
function echo_goback()
{
	echo "<p><a href=\"".URL."/redirect.php?1\">[返回上一頁]</a></p>";
}

function echo_go_regwizard_home()
{
	echo "<a href=\"index.php\">[返回註冊精靈]</a>";
}

function echo_go_regwizard_admin()
{
	echo "<a href=\"admin_main.php\">[返回註冊精靈管理頁面]</a>";
}

// functions of transformation
function date_display_transform($input_date)
{
	return date("n/j",strtotime($input_date));
}

function avail_date_display($input_rwo_datetype, $input_rwo_date_begin, $input_rwo_date_end)
{
	switch($input_rwo_datetype)
	{
		case 0:
			return date_display_transform($input_rwo_date_begin);
			break;
		case 2:
			return date_display_transform($input_rwo_date_begin)."~".date_display_transform($input_rwo_date_end);
			break;
		case (-1):
			return date_display_transform($input_rwo_date_begin)."~";
			break;
		case 1:
			return "隨時可以完成";
			break;
		default:
			echo "ERROR!<br />";
	}
}

// functions of judgement
function judge_freshman($input_sid)
{
	// ------ For beta testing
	return true;
    //global $curruser;
	//return (!strcasecmp("98", substr($input_sid, 0, 2)) || $curruser -> isadmin());
}

function check_deadline($input_rwo_datetype, $output_default, $input_rwo_date_begin, $input_rwo_date_end)
{
	if($input_rwo_datetype==0)
	{
		if($input_rwo_date_begin == date("Y-m-d"))
		{
			return $output_default;
		}
		elseif($input_rwo_date_begin > date("Y-m-d"))
		{
			return "non-begin";
		}
		elseif($input_rwo_date_begin < date("Y-m-d"))
		{
			return "non-complete";
		}
	}
	elseif($input_rwo_datetype==2)
	{
		if($input_rwo_date_begin > date("Y-m-d"))
		{
			return "non-begin";
		}
		elseif($input_rwo_date_begin <= date("Y-m-d") && $input_rwo_date_end >= date("Y-m-d"))
		{
			return $output_default;
		}
		elseif($input_rwo_date_end < date("Y-m-d"))
		{
			return "non-complete";
		}
	}
	elseif($input_rwo_datetype==(-1))
	{
		if($input_rwo_date_begin > date("Y-m-d"))
		{
			return "non-begin";
		}
		elseif($input_rwo_date_begin <= date("Y-m-d"))
		{
			return $output_default;
		}
	}
	elseif($input_rwo_datetype==1)
	{
		return $output_default;
	}
	
}

function check_c_column_value($input_c_column, $input_c_value)
{
	global $curruser;

	switch($input_c_column)
	{
		case "sex":
			$CONS_C_COLUMN = $curruser -> sex;
			break;
		case "department":
			$CONS_C_COLUMN = $curruser -> department;
			break;
		default:
			echo "ERROR! <br />";
	}
	
	$return_bool = false;
	
	$temp_arr = explode(";", $input_c_value);
	
	for($i=0; $i < sizeof($temp_arr); $i++)
	{
		if($CONS_C_COLUMN == $temp_arr[$i])
		{
			$return_bool = true;
			break;
		}
	}
	return $return_bool;
}

function check_display_type_guest($input_var)
{
	switch($input_var['rwo_datetype'])
	{
		case 0:
			return (($input_var['rwo_date_begin'] == date("Y-m-d", mktime())) ? true : false );
			break;
		case 2:
			return (($input_var['rwo_date_begin'] <= date("Y-m-d", mktime()) && $input_var['rwo_date_end'] >= date("Y-m-d", mktime())) ? true : false );
			break;
		case -1:
			return (($input_var['rwo_date_begin'] <= date("Y-m-d", mktime())) ? true : false );
			break;
		case 1:
			return true;
			break;
		default:
			echo "ERROR<br />";
	}
}

function check_display_type($input_var)
{
	// globalize $currdb and $curruser in order to access the database in function
	global $currdb, $curruser;

	// Check if the user finished the option or not
	$u_data_chk = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_data"))."` WHERE uno=".($curruser -> uno)." AND rwoID=".$input_var['rwoID']."");
	
	if($currdb -> num_rows($u_data_chk) != 0)
	{
		// count of data != 0, return complete
		return "complete";
	}
	else
	{
		// Check display type first, and check the available date interval
		if($input_var['rwo_type']==2)
		{
			$bool_c_column_value = check_c_column_value($input_var['rwo_c_column'], $input_var['rwo_c_value']);
			$bool_c_muser = substr($input_var['rwo_c_type'],0,1);
			$bool_c_ouser = substr($input_var['rwo_c_type'],1,1);
			
			if($bool_c_column_value)
			{
				switch($bool_c_muser)
				{
					case "0":
						return (check_deadline($input_var['rwo_datetype'], "necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
						break;
					case "1":
						return (check_deadline($input_var['rwo_datetype'], "non-necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
						break;
					case "2":
						return "hidden";
						break;
					default:
						echo "ERROR! <br />";
				}
			}
			else
			{
				switch($bool_c_ouser)
				{
					case "0":
						return (check_deadline($input_var['rwo_datetype'], "necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
						break;
					case "1":
						return (check_deadline($input_var['rwo_datetype'], "non-necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
						break;
					case "2":
						return "hidden";
						break;
					default:
						echo "ERROR! <br />";
				}
			}
		}
		elseif($input_var['rwo_type']==0)
		{
			// rwo_type == 0, necessary type
			return (check_deadline($input_var['rwo_datetype'], "necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
		}
		elseif($input_var['rwo_type']==1)
		{
			// rwo_type == 0, non-necessary type
			return (check_deadline($input_var['rwo_datetype'], "non-necessary", $input_var['rwo_date_begin'], $input_var['rwo_date_end']));
		}
		else
		{
			echo "ERROR! <br />";
		}
	}
}

function check_necessary($input_var)
{
	if($input_var['rwo_type']==2)
	{
		$bool_c_column_value = check_c_column_value($input_var['rwo_c_column'], $input_var['rwo_c_value']);
		$bool_c_muser = substr($input_var['rwo_c_type'],0,1);
		$bool_c_ouser = substr($input_var['rwo_c_type'],1,1);
		
		if($bool_c_column_value)
		{
			switch($bool_c_muser)
			{
				case "0":
					return "necessary";
					break;
				case "1":
					return "non-necessary";
					break;
				case "2":
					return "hidden";
					break;
				default:
					echo "ERROR! <br />";
			}
		}
		else
		{
			switch($bool_c_ouser)
			{
				case "0":
					return "necessary";
					break;
				case "1":
					return "non-necessary";
					break;
				case "2":
					return "hidden";
					break;
				default:
					echo "ERROR! <br />";
			}
		}
	}
	elseif($input_var['rwo_type']==1)
	{
		return "non-necessary";
	}
	elseif($input_var['rwo_type']==0)
	{
		return "necessary";
	}
	else
	{
		echo "ERROR! <br />";
	}
}

function check_level($input_complete_opt, $input_all_opt)
{
	$c_percent = ($input_complete_opt / $input_all_opt);
	
	if($c_percent > 0.8)
	{
		return 5;
	}
	else
	if($c_percent > 0.55)
	{
		return 4;
	}
	else
	if($c_percent > 0.3)
	{
		return 3;
	}
	else
	if($c_percent > 0.02)
	{
		return 2;
	}
	else
	if($c_percent >= 0 && $c_percent <= 0.02)
	{
		return 1;
	}
	
}
?>
