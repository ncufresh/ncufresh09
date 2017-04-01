<?php
require_once("../../mainfile.php");

$currtpl -> setndisplay();

if($_GET['action']=="admin_ajax_c_column")
{
	$currtpl -> display("admin_ajax.c_column.html");
}
else
if($_GET['action']=="admin_ajax_c_value")
{	
	switch($_GET['rwo_c_column'])
	{
		case "sex":
			$currtpl -> display("admin_ajax.c_value.sex.html");
			break;
			
		case "department":
			$currtpl -> display("admin_ajax.c_value.department.html");
			break;
			
		default:
			echo "";
	}
}
else
if($_GET['action']=="admin_ajax_c_type")
{
	$currtpl -> display("admin_ajax.c_type.html");
}
else
if($_GET['action']=="admin_ajax_datetype")
{
	if($_GET['rwo_datetype']==2)
	{
		$currtpl -> display("admin_ajax.datetype.double.html");
	}
	else
	if($_GET['rwo_datetype']==0 || $_GET['rwo_datetype']==-1)
	{
		$currtpl -> display("admin_ajax.datetype.single.html");
	}
	else
	if($_GET['rwo_datetype']==1)
	{
		echo "";
	}
	else
	{
		echo "";
	}
}
else
{
	echo "參數傳遞錯誤，請勿使用此路徑執行本程式";
}
?>