function ShowResult_c_column(res)
{
	$('c_column_result').innerHTML=res.responseText;
}

function ShowResult_c_value(res)
{
	$('c_value_result').innerHTML=res.responseText;
}

function ShowResult_c_type(res)
{
	$('c_type_result').innerHTML=res.responseText;
}

function ShowResult_datetype(res)
{
	$('datetype_result').innerHTML=res.responseText;
}

function request_html_column(type)
{
	if(type=="c_column")
	{
		$('c_column_result').innerHTML="";
		
		// c_column_result�O��rwo_type��value=custom�ɤ~�I�s
		// �i��n��value
		if($F('rwo_type') == '2')
		{
			var rwo_c_column_Url='admin_ajax.php';
			var rwo_c_column_Par='action=admin_ajax_c_column';
			
			// �Q��id=c_column_result�F�ϥ�div��ܵ��G
			var res = new Ajax.Request(rwo_c_column_Url,{method: 'get', parameters: rwo_c_column_Par, onComplete: ShowResult_c_column});
			return false;
		}
		else
		{
			$('c_column_result').innerHTML="";
		}
	}
	else
	if(type=="c_value")
	{
		$('c_value_result').innerHTML="";
		
		// c_value_result�O�̾�rwo_c_column�����G�I�s
		if($F('rwo_c_column') != "")
		{
			var rwo_c_value_Url='admin_ajax.php';
			var rwo_c_value_Par='action=admin_ajax_c_value&rwo_c_column='+$F('rwo_c_column');
			
			// �Q��id=c_value_result�F�ϥ�div��ܵ��G
			var res = new Ajax.Request(rwo_c_value_Url,{method: 'get', parameters: rwo_c_value_Par, onComplete: ShowResult_c_value});
			return false;
		}
		else
		{
			$('c_value_result').innerHTML="";
		}
	}
	else
	if(type=="c_type")
	{
		$('c_type_result').innerHTML="";
		
		// c_type_result�O�brwo_c_value���ȫ�~�I�s
		if($F('rwo_c_value[]').length > 0)
		{
			var rwo_c_type_Url='admin_ajax.php';
			var rwo_c_type_Par='action=admin_ajax_c_type';
			
			// �Q��id=c_type_result�F�ϥ�div��ܵ��G
			var res = new Ajax.Request(rwo_c_type_Url,{method: 'get', parameters: rwo_c_type_Par, onComplete: ShowResult_c_type});
			return false;
		}
		else
		{
			$('c_type_result').innerHTML="";
		}
	}
	else
	if(type=="datetype")
	{
		$('datetype_result').innerHTML="";
		
		if($F('rwo_datetype') != "")
		{
			var rwo_datetype_Url='admin_ajax.php';
			var rwo_datetype_Par='action=admin_ajax_datetype&rwo_datetype='+$F('rwo_datetype');
			
			var res = new Ajax.Request(rwo_datetype_Url,{method: 'get', parameters: rwo_datetype_Par, onComplete: ShowResult_datetype});
			return false;
		}
		else
		{
			$('datetype_result').innerHTML="";
		}
	}
}