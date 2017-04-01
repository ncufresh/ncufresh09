<?
require_once("../../mainfile.php");

if(!empty($_POST["edit_nav_done"]) && $currmodule->isadmin($curruser)){
	for($i=1;$i <= $_POST["biggest_csn"];$i++){
		$currdb->query("update `".$currdb->prefix("must_category")."` 
									  set title = '".$_POST["title-".$i]."' , 
												ord =	'".$_POST["ord-".$i]."' , 
												hyperlink = '".$_POST["url-".$i]."' ,
												allord = '".$_POST["allord-".$i]."'
										where csn = '".$i."';");
		
		if($_POST["hsn-".$i] == 0){
			$currdb->query("update `".$currdb->prefix("must_category")."` 
											set hsn = '".$_POST["hsn-".$i]."' ,
													level='1' 
											where csn = '".$i."';");			
		}else{
			$result_hsn_level = $currdb->query("select level from `".$currdb->prefix("must_category")."` where csn='".$_POST["hsn-".$i]."'");
			$hsn_level = $currdb->fetch_array($result_hsn_level);
			if($hsn_level["level"] == "1"){
				$currdb->query("update `".$currdb->prefix("must_category")."` set hsn='".$_POST["hsn-".$i]."' , level='2' where csn = '".$i."';");			
			}else{
				$currdb->query("update `".$currdb->prefix("must_category")."` set hsn='".$_POST["hsn-".$i]."', level='3' where csn = '".$i."';");
			}
		}
	}
		$currtpl->assign("edit_message","修改完成");
}
if(!empty($_GET["new"]) && $currmodule->isadmin($curruser)){
	$result_test_last = $currdb->query("select csn from `".$currdb->prefix("must_category")."` where  origin='1' order by csn desc");
	$test_last = $currdb->fetch_array($result_test_last);
	$last = $test_last["csn"];

	$result_test_allnums = $currdb->query("select csn from `".$currdb->prefix("must_category")."` where level='1' and origin='1'");
	$test_allnums = $currdb->num_rows($result_test_allnums);
	for($i=1;$i<=$_GET["new"];$i++){
		$last++;
		$test_allnums++;
		$currdb->query("insert into `".$currdb->prefix("must_category")."` (csn,title,hsn,ord,level,hyperlink) values ('".$last."','新分類','0','".$test_allnums."','1','index.php?csn=".$last."')" );
		$currdb->query("insert into `".$currdb->prefix("must_main")."` (csn,main) values ('".$last."','空的')");
	}
	$edit_message = $i."個欄位已新增";
	$currtpl->assign("edit_message",$edit_message);
}

for($i = 1 ; $i <= $_POST["biggest_csn"] ; $i++){
	if($_POST["kill-".$i] != 1){
		continue;	}
	$currdb->query("delete from `".$currdb->prefix("must_category")."` where csn = '".$i."'");
	$currdb->query("delete from `".$currdb->prefix("must_main")."` where csn = '".$i."'");
	$currtpl->assign("edit_message","已刪除");
}

$result_cate = $currdb->query("select * from `".$currdb->prefix("must_category").
														"` where hsn = 0 and origin='1' order by ord");
$cate = array();
$i = 0;
while($temp_cate = $currdb->fetch_array($result_cate)){
	$cate[$i] = $temp_cate; 
	$cate[$i]["hyperlink"] = htmlencode($cate[$i]["hyperlink"]);
	$cate[$i]["allord"] = $i+1;
	$i++;
	
	$result_cate_son = $currdb->query("select * from `".$currdb->prefix("must_category").
														      "` where hsn = '".$temp_cate["csn"]."' order by ord");
	while($temp_cate_son = $currdb->fetch_array($result_cate_son)){
		$cate[$i] = $temp_cate_son; 
		$cate[$i]["hyperlink"] = htmlencode($cate[$i]["hyperlink"]);
		$cate[$i]["allord"] = $i+1;
		$i++;
		
		$result_cate_grandson = $currdb->query("select * from `".$currdb->prefix("must_category").
														      "` where hsn = '".$temp_cate_son["csn"]."' order by ord");
		while($temp_cate_grandson = $currdb->fetch_array($result_cate_grandson)){
			$cate[$i] = $temp_cate_grandson; 
			$cate[$i]["hyperlink"] = htmlencode($cate[$i]["hyperlink"]);
			$cate[$i]["allord"] = $i+1;
			$i++;
		}
	}
}
$result_biggest_csn = $currdb->query("select max(csn) from `".$currdb->prefix("must_category")."` where origin='1'");
$biggest_csn = $currdb->fetch_array($result_biggest_csn);
$currtpl->assign("biggest_csn",$biggest_csn["max(csn)"]);
$currtpl->assign("cate",$cate);
$currtpl->display("edit_nav.htm");
?>
