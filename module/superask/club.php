<?php
require_once("../../mainfile.php");
$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='9' ORDER BY ord");
while($tmp = $currdb->fetch_array($result)){
    $result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."` WHERE cno='".$tmp["cno"]."' ORDER BY tno ASC");
    while($tmp2 = $currdb->fetch_array($result2)){
      if($tmp2["tno"] == 217) continue;
      $tmp["child"][] = $tmp2;
    }
    $cate[] = $tmp;
}
$currtpl->assign("club","1");
$currtpl->assign("cate",$cate);
$currtpl->display("department.htm");
?>
