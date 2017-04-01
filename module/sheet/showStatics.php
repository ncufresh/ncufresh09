<?php
require_once ("../../mainfile.php");


if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$sno=$_GET['sno']; // Sheet Number
$qis=$_GET['qis'];
$graph=$_GET['graph'];
$show=$_GET['show'];

if($show=='sketch'){
	$graphdisplay[0]='none';
	$graphdisplay[1]='block';
	$switch='pie';
}
else{
	$graphdisplay[1]='none';
	$graphdisplay[0]='block';
	$switch='sketch';
}

echo $graphdisplay[sketch];

if(empty($graph)){
	include_once 'include/OpenFlash/php-ofc-library/open_flash_chart_object.php';
	$graphpie=open_flash_chart_object_str( 300, 300, 'showStatics.php?sno='.$sno.'&qis='.$qis.'&graph=pie',false);
	$graphsketch=open_flash_chart_object_str( 300, 300, 'showStatics.php?sno='.$sno.'&qis='.$qis.'&graph=sketch',false);
}
function ISother($answer, $SNofQst){
	global $currdb;
	$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$SNofQst."' AND content = '".$answer."' ");
	if($currdb->num_rows($chsdb)!=0)
		return 0;
	else
		return 1;
}//檢查回答是否為"其他"

function CHS_NOinQst($answer, $SNofQst){
	global $currdb;
	$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$SNofQst."' AND content = '".$answer."' ");
	$chs=$currdb->fetch_array($chsdb);
	return $chs['SNinQst'];
	
}//取得選項在問題中的序號

$anscount = array();
$othercount = array();

$ansdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_answer")."` WHERE SNofGrp ='".$sno."'");//抓出所有人對問卷1的回答

for($row=$currdb->num_rows($ansdb);$row>0;$row--){//$row代表目前抓到第幾份回答
	$ansrows=$currdb->fetch_array($ansdb);
	$answers=unserialize($ansrows['answer']); //取出答案本體
	
	/*開始判斷這份試卷的題數*/	
		$qstdb=$currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."'");
		$qstdb=$currdb->fetch_array($qstdb);
	/*結束判斷這份試卷的題數 => $qstdb['COUNT(*)']*/
	
	
	/*開始分解answers*/	
	
		for($i=1,$j=0;$i<=$qstdb['COUNT(*)'];$i++,$j++){//i=題號,j=unserialize後的答案中的回答編號
			/*判斷是單選還是多選題*/
			$qst=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp = '".$i."'");
			$qst=$currdb->fetch_array($qst);
			if($qst['type']==1){//單選題
				if(ISother($answers[$j],$qst['qid'])){//檢查回答是否為"其他"
					$othercount[$i]++;
					if(!isset($othercontent[$i]))
						$othercontent[$i] = array();
					array_push($othercontent[$i],$answers[$j]);
					$otheraru = 1;
					//echo "others 出現 ".$othercount[$i]." 次<br/>";
				}
				
				else{
					$temp=CHS_NOinQst($answers[$j],$qst['qid']);
					$anscount[$i][$temp]++;
					//echo $answers[$j]." 出現 "./*${$answers[$j]}[$i]*/$anscount[$i][$temp]." 次<br/>";
				}
				
				
			}
			
			else{	//多選題
				$multicount = 0;
				while(1){
					if(empty($answers[$j][$multicount]))
						break;
					
					if(ISother($answers[$j][$multicount],$qst['qid'])){//回答是"其他"
						$othercount[$i]++;
						if(!isset($othercontent[$i]))
							$othercontent[$i] = array();
						array_push($othercontent[$i],$answers[$j][$multicount]);
						//echo "others 出現 ".$othercount[$i]." 次<br/>";
					}
					
					else{
						$temp=CHS_NOinQst($answers[$j][$multicount],$qst['qid']);
						$anscount[$i][$temp]++;
						//echo $answers[$j][$multicount]." 出現 ".$anscount[$i][$temp]." 次<br/>";
					}
					$multicount++;
				}
			}
		}
}

$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE SN='".$sno."'");
$a=$currdb->fetch_array($a);
$topic=$a['Topic'];
$description=$a['description'];//讀取問卷主題及敘述

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."'");
$question=array();
$type=array();

for($row1=$currdb->num_rows($qstdb),$i=0;$i<$row1;$i++){
	$qstary=$currdb->fetch_array($qstdb);
	$temp=$qstary['question'];
	array_push($question,$temp);
	switch($qstary['type']){
		case 1:array_push($type,"radio"); $s="ans".$i; break;
		case 2:array_push($type,"checkbox");break;
	}//讀取問券問題
	$qid=$qstary['qid'];	
	
	$choose[$i] = array();
	$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst='".$qid."'");
	for($row2=$currdb->num_rows($chsdb),$j=0;$j<$row2;$j++){
		$chsary=$currdb->fetch_array($chsdb);
		if($qstary['qid']==$chsary['SNofQst']){
			$temp=$chsary['content'];
			array_push($choose[$i],$temp);
		}
	}//讀取問券選項
}


if($graph=="sketch"){

	$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp = '".$qis."'");
	$qstdb=$currdb->fetch_array($qstdb);
	$qid = $qstdb['qid'];
	$chsdb=$currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$qid."'");
	$chsdb=$currdb->fetch_array($chsdb);
	
	$data = array();
	$chooses = array();
	$y_max=0;
	for($i=1;$i<=$chsdb['COUNT(*)'];$i++){
		if($choose[$qis-1][$i-1]=="others"){
			$choose[$qis-1][$i-1]="其他";
			array_push($data,$othercount[$qis]);
			array_push($chooses,$choose[$qis-1][$i-1].'('.$othercount[$qis].')');
		}
		if($anscount[$qis][$i]==NULL)
			$anscount[$qis][$i]=0;
		if($anscount[$qis][$i]>$y_max)
			$y_max = $anscount[$qis][$i];
		array_push($data,$anscount[$qis][$i]);
		array_push($chooses,$choose[$qis-1][$i-1].'('.$anscount[$qis][$i].')');
	}
		
	$color = array();
	for($i=0;$i<$chsdb['COUNT(*)'];$i++){
		$coloro = mt_rand('0','255');
		$color1 = dechex($coloro);
		$coloro = mt_rand('0','255');
		$color2 = dechex($coloro);
		$coloro = mt_rand('0','255');
		$color3 = dechex($coloro);
		echo $color1.$color2.$color3;
		array_push($color,$color1.$color2.$color3);
	}

	include_once( 'include/OpenFlash/php-ofc-library/open-flash-chart.php' );

	// generate some random data

	$bar = new bar_sketch( 55, 6, '#1012FF', '#000000' );
	$bar->key( '', 0 );

    $bar->data = $data;

	$graphtitle=$question[$qis-1];
	$g = new graph();
	$g->title( $graphtitle , '{font-size:20px; color: #ffffff; margin:10px; background-color: #d070ac; padding: 5px 15px 5px 15px;}' );
	$g->bg_colour = '#FFFFFF';

//
// add the bar object to the graph
//
	$g->data_sets[] = $bar;

	$g->x_axis_colour( '#e0e0e0', '#e0e0e0' );
	$g->set_x_tick_size( 9 );
	$g->y_axis_colour( '#e0e0e0', '#e0e0e0' );

	$g->set_x_labels( $chooses );
	$g->set_x_label_style( 11, '#303030', 2 );
	$g->set_y_label_style( 11, '#303030', 2 );
	
	$y_max += $y_max/2; 
	$g->set_y_max( $y_max );
	$g->y_label_steps( 5 );
	echo $g->render();
}

else if($graph=="pie"){
	$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp = '".$qis."'");
	$qstdb=$currdb->fetch_array($qstdb);
	$qid = $qstdb['qid'];
	$chsdb=$currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$qid."'");
	$chsdb=$currdb->fetch_array($chsdb);
	$temp = array();
	$chooses = array();
	for($i=1;$i<=$chsdb['COUNT(*)'];$i++){
		if($choose[$qis-1][$i-1]=="others"){
			$choose[$qis-1][$i-1]="其他";
			if($othercount[$qis]==NULL)
				$othercount[$qis]=0;
			array_push($temp,$othercount[$qis]);
			array_push($chooses,$choose[$qis-1][$i-1].'('.$othercount[$qis].')');
		}
		if($anscount[$qis][$i]==NULL)
			$anscount[$qis][$i]=0;
		array_push($temp,$anscount[$qis][$i]);
		if(($i>1 && $anscount[$qis][$i]==0 && $anscount[$qis][$i+1]==0) || ($i>1 && $anscount[$qis][$i]==0 && $othercount[$qis]==0)){
			array_push($chooses,'');
			continue;
		}
		array_push($chooses,$choose[$qis-1][$i-1].'('.$anscount[$qis][$i].')');
	}
	$sum = 0;
	for($i=0;$i<$chsdb['COUNT(*)'];$i++)
		$sum = $sum + $temp[$i];	
		
	$data = array();
	$color = array();
	for($i=0;$i<$chsdb['COUNT(*)'];$i++){
		$tem=($temp[$i]/$sum)*100;
		array_push($data,$tem);
		$coloro = mt_rand('0','255');
		$color1 = dechex($coloro);
		$coloro = mt_rand('0','255');
		$color2 = dechex($coloro);
		$coloro = mt_rand('0','255');
		$color3 = dechex($coloro);
		echo $color1.$color2.$color3;
		array_push($color,$color1.$color2.$color3);
	}
	include_once( 'include/OpenFlash/php-ofc-library/open-flash-chart.php' );
	$g = new graph();

//
// PIE chart, 60% alpha
//
	$g->bg_colour = '#FFFFFF';
	$g->pie(80,'#550055','{font-size: 12px; color: #000000');
// pie( 透明度 , '邊框顏色' , ' {字的大小 顏色}');
//
// pass in two arrays, one of data, the other data labels
//
	$g->pie_values( $data, $chooses );
//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//	
	
	$g->pie_slice_colours( $color );

	$g->set_tool_tip( '#val#%' );
	$graphtitle=$question[$qis-1];
	$g->title( $graphtitle, '{font-size:16px; color: #d01f3c}' );
	echo $g->render();
}


else{
	$currtpl->assign("type",$type);//問題形式 1:單選 2:多選
	$currtpl->assign("graphpie",$graphpie);//輸出圖表
	$currtpl->assign("graphsketch",$graphsketch);
	$currtpl->assign("choose",$choose);//選項名稱
	$currtpl->assign("questions",$question);//問題敘述
	$currtpl->assign("topic",$topic);//主題
	$currtpl->assign("switch",$switch);//切換按鈕用
	$currtpl->assign("graphdisplay",$graphdisplay);//圖表狀態(none or block)
	$currtpl->assign("description",$description);//問卷敘述
	$currtpl->assign("anscount",$anscount);//各選項回答的次數
	$currtpl->assign("othercount",$othercount);//有幾個其他
	$currtpl->assign("othercontent",$othercontent);//"其他"內容
	$currtpl->assign("otheraru",$otheraru);//問卷編號	
	$currtpl->assign("sno",$sno);//問卷編號
	$currtpl->assign("qis",$qis);//問題在問卷中的序號
	if(isset($qis)){
		$qqis=$qis-1;
		$currtpl->assign("qqis",$qqis);//問題在問卷中的序號Special*/
		$currtpl->display('showDetail.tpl.php');
	}
	else
		$currtpl->display('showStatics.tpl.php');
}

?>
