<?php /* Smarty version 2.6.18, created on 2009-07-29 22:35:50
         compiled from fuckingindex.tpl.html */ ?>

<yoyo>
<!--bottom dock -->
<div class="dock" id="dock2">
  <div class="dock-container2">
  <a class="dock-item2" href="#"><span>Home</span><img src="images/home.png" alt="home" /></a> 
  <a class="dock-item2" href="#"><span>Contact</span><img src="images/email.png" alt="contact" /></a> 
  <a class="dock-item2" href="#"><span>Portfolio</span><img src="images/portfolio.png" alt="portfolio" /></a> 
  <a class="dock-item2" href="#"><span>Music</span><img src="images/music.png" alt="music" /></a> 
  <a class="dock-item2" href="#"><span>Video</span><img src="images/video.png" alt="video" /></a> 
  <a class="dock-item2" href="#"><span>History</span><img src="images/history.png" alt="history" /></a> 
  <a class="dock-item2" href="#"><span>Calendar</span><img src="images/calendar.png" alt="calendar" /></a> 
  <a class="dock-item2" href="#"><span>Links</span><img src="images/link.png" alt="links" /></a> 
  <a class="dock-item2" href="#"><span>RSS</span><img src="images/rss.png" alt="rss" /></a> 
  <a class="dock-item2" href="#"><span>RSS2</span><img src="images/rss2.png" alt="rss" /></a> 
  </div>
</div>

<!--dock menu JS options -->
<script type="text/javascript">
	
	$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

</script>
</yoyo>