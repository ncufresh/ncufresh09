//var J=jQuery.noConflict(); 

function sub_menu(which){
    J("#cp_introduce").show();
	J("#cp_submenu").show();
    J("#CP_Icon").hide();
	J("#cp_editsele").html("");
	J("#cp_intro_content").html("");
	J.ajax(
        {
            url: 'campus_submenu_selector.php',
            data:{
			    selection: which
		    },
		    error: function(xhr,ajaxOptions,thrownError){
				//alert(xhr.status);
				//alert('喔喔～出現錯誤了，請將遇到的情形回報給知訊網團隊，謝謝^^');
                //alert(thrownError);
		    },	
		
		    success: function(response){
			    J("#cp_submenu").html(response);
                //J("#spannnn").html(response);
		    }
	});
	var select = which;
	J(".buildings").css("opacity","0.1");		
	switch(select){
		case 1:
			J(".campus_adm").css("opacity","1.0");	
			break;
		case 2:
			J(".campus_view").css("opacity","1.0");
			break;
		case 3:
			J(".campus_depart").css("opacity","1.0");
			J("#cp_intro_content").html("<li><a href=\"templates/images/depart.gif\" title=\"HAHA\" onclick=\"J(this).lightbox({start:true,events:false}); return false;\" rel=\"lightbox\"> <img height=\"600\" alt=\"\" src=\"templates/images/depart.gif\"/></a><li>");
			break;
		case 4:
			J(".campus_learn").css("opacity","1.0");
			break;
		case 5:
			J(".campus_sport").css("opacity","1.0");
			break;
		default:
			J(".buildings").css("opacity","1.0");
			break;
	};
	if(select==3)
		J("#cp_submenu").css("margin-left","150px");
	else
		J("#cp_submenu").css("margin-left","250px");
		
	if(select==6){
		J("#cp_introduce").hide();
		J("#campus_center_block").css("background","url('templates/images/allmap234.jpg')");
		J("#campus_center_block").css("height","1151px");
		J(".buildings").css("opacity","0");
	}
	else{
		J("#campus_center_block").css("background","url('templates/images/background2.jpg')");
		J("#campus_center_block").css("height","797px");
	}
}

function showContent(CSMno){
    J("#CP_Icon").css("display","inline-block");
	J.ajax({
		url: 'campus_content_selector.php',
		data:{
			selection: CSMno
		},
		error: function(xhr){
				//alert('?\???X?{???~?A?ثe?t?κ??@???A?еy???I');
		},	
		
		success:function(response){
			var arr = response.split("|||");
			J("#cp_intro_content").html(arr[0]);
			J("#cp_editsele").html(arr[1]);
			J("#CP_Icon").html(arr[2]);
		}
	});
}

