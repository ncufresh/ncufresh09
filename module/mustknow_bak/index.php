<?
require_once("../../mainfile.php");
$result_cate = $currdb->query("select * from `".$currdb->prefix("must_category").
														"` where hsn = 0 and origin='1' order by ord");
$cate = array();											
while($temp_cate = $currdb->fetch_array($result_cate)){
	$cate[] = $temp_cate;

	$result_cate_son = $currdb->query("select * from `".$currdb->prefix("must_category"). "` where hsn = '".$temp_cate["csn"]."' order by ord");
	while($temp_cate_son = $currdb->fetch_array($result_cate_son)){
		$cate[] = $temp_cate_son;

		$result_cate_grandson = $currdb->query("select * from `".$currdb->prefix("must_category").
														      "` where hsn = '".$temp_cate_son["csn"]."'  and origin = '1' order by ord");
		while($temp_cate_grandson = $currdb->fetch_array($result_cate_grandson)){
			$cate[] = $temp_cate_grandson;
		}
	}
}

$currtpl->assign("cate",$cate);

$result_main_default = $currdb->query("select csn from `".$currdb->prefix("must_category")."` where csn='28' order by allord;");
$default = $currdb->fetch_array($result_main_default);

if(empty($_GET["csn"])){
	$_GET["csn"] = $default["csn"];
}
if(!empty($_GET["edit"]) && $currmodule->isadmin($curruser)){
	$currtpl->assign("edit",$_GET["edit"]);
}
if(!empty($_GET["edit_done"]) && $currmodule->isadmin($curruser) && !empty($_POST["edit_main"])){
	$currdb->query("update `".$currdb->prefix("must_main")."` set main = '".$_POST["edit_main"]."' where csn = '".$_GET["csn"]."';");
}

$result_main = $currdb->query("select m.*,c.title from `".$currdb->prefix("must_main")."` m
															 left join `".$currdb->prefix("must_category")."` c 
															 on m.csn = c.csn 
															 where m.csn = '".$_GET["csn"]."';");
$main = $currdb->fetch_array($result_main);

$currtpl->assign("main",$main);
$currtpl->assign("title",$title[title]);
$currtpl->display("index.htm");
?>
