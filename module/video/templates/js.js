//var J = jQuery.noConflict();


function open_video(){
	var v_sn = J('#no').val();
	document.getElementById("video_bg").style.display = "block";
	document.getElementById("video_frame").src="module/video/video_case.php?no="+v_sn+"&quality=0";
}
function close_video(){
	document.getElementById("video_frame").src="";
	document.getElementById("video_bg").style.display = "none";
}
function admin_video(i){
	var v_sn = i;
	document.getElementById("video_bg").style.display = "block";
	document.getElementById("video_frame").src="video_case.php?no="+v_sn;
}
function over(i){
	J(".l_image").animate({width:"80px", height:"60px"}, 150);
	J("#l_image"+i).animate({width:"100px", height:"75px"}, 150);
}

function out(i){
	J("#l_image"+i).animate({width:"80px", height:"60px"}, 150);
}

function quick(i){
    J.ajax(
        {
            url: 'module/video/video_get.php',
			//url: 'getvideo.php',
            data: {
			   act: 'Q',
               no: J('#l_imagex'+i).val(),
               type: 'send'
            },
            error: function(xhr){
                alert('AJAX error!!');
            },
            success:function(response){
				var arr = response.split("||");
				var lin = 'module/video/';
				var ppp = '" />';
				J('#no').attr({value:arr[0]});
				J('.l_name').html(arr[1]);
				J('.l_intro').html(arr[2]);
				J('#image').attr({src:'module/video/' + arr[3]});
			}
    });
}

function page(i){
    J.ajax(
        {
            url: 'module/video/video_get.php',
			//url: 'getvideo.php',
            data: {
               act: i,
			   page: J('#page').val(),
               type: 'send'
            },
            error: function(xhr){
                alert('AJAX error!!');
            },
            success:function(response){
				var arr = response.split("||");
				J('#page').val(arr[0]);
				J('#l_imagel').attr({src:"module/video/" + arr[1]});
				J('#l_imagec').attr({src:"module/video/" + arr[2]});
				J('#l_imager').attr({src:"module/video/" + arr[3]});
				J('#l_imagexl').val(arr[4]);
				J('#l_imagexc').val(arr[5]);
				J('#l_imagexr').val(arr[6]);
			}
    });
}

function button(i)
{
	switch (i)
	{
		case'U':
			J('.l_button').attr({src:"module/video/templates/movAreaLH.png"});
			break;
		case'D':
			J('.l_button2').attr({src:"module/video/templates/movAreaRH.png"});
			break;
		case'A':
			J('.l_button').attr({src:"module/video/templates/movAreaL.png"});
			break;
		case'B':
			J('.l_button2').attr({src:"module/video/templates/movAreaR.png"});
			break;
	}
}

function edit(i){
	J("#edit"+i).toggle('slow');
}
