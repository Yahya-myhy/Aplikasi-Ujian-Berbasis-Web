                $(function(){
							jam = $('#jam').val();
                            menit = $('#menit').val();
                            detik = $('#detik').val();
                            $('#h_timer').countdowntimer({
                                        hours : + jam,
                                        minutes : + menit,
										seconds: + detik,														
                                        size : "lg",
						                timeUp : timeisUp
																																					
                                    });
							     });
					
					function timeisUp() {
					alert("Waktu pengerjaan sudah habis");
					
						setTimeout(function() { 
										window.location.href = $("a")[0].href; 
						}, 2000);
						
						ujian = $('#ujian').val();
						//Code to be executed when timer expires.
						window.location='selesai.php?ujian=' + ujian;
					
					}

   $(document).ready(function() {

        // Dock the header to the top of the window when scrolled past the banner.
        // This is the default behavior.

        $('.header').scrollToFixed();
    });

       var container = document.querySelector('#container');
        var msnry = new Masonry( container, {
          //here we define grid system column width to be 320px. This remains constant throughout all viewport sizes. Columns are dropped when they have no space which makes them a responsive grid system similarly columns are added when viewport size increases.
          columnWidth: 55,
          //select all grid boxes
          itemSelector: '.item',
          //gutter property here
          gutter: 17
        });
        
       
 