//var J = jQuery.noConflict();
function editMode(CSMno){
	J.ajax({
		url:'editmode.php',
		data:{
			selection: CSMno
		},
		error: function(xhr){
				alert('AJAX error!!');
		},	
		
		success:function(response){
			var arr = response.split("|||");
			J("#cp_intro_content").html(arr[0]);
			J("#cp_editsele").html(arr[1]);
		}
	});
}
function saveMode(CSMno){
	J.ajax({
		url:'editmode.php',
		data:{
			selection: CSMno,
			type: 'save',
			newcontent : J("#cp_editcontent").val()
		},
		error: function(xhr){
				alert('AJAX error!!');
		},	
		
		success:function(response){
			var arr = response.split("|||");
			J("#cp_intro_content").html(arr[0]);
			J("#cp_editsele").html(arr[1]);
		}
	});
}
