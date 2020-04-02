//Ketika item nomor soal atau item navigasi diklik
function tampil_soal(no){
   $('.blok-soal').removeClass('active');	
   $('.soal-'+no).addClass('active');
    $('.item').removeClass('biru');	
   $('.item-'+no).addClass('biru');
   
}

//Ketika ragu-ragu dicentang
function ragu_ragu(no){
   if($('.item-'+no).hasClass('yellow')){
      $('.item-'+no).removeClass('yellow');
   }else{
      $('.item-'+no).addClass('yellow');
	   $('.item').removeClass('biru');
   }
}

//Ketika ujian selesai
function selesai(){
   $('#modal-selesai').modal({
      'show' : true,
      'backdrop' : 'static'
   });
}

//Ketika memilih jawaban
function kirim_jawaban(index, jawab){
   ujian = $('#ujian').val();
   var huruf = ["0", "A", "B", "C", "D", "E"];
   $.ajax({
      url: "ajax_ujian.php?action=kirim_jawaban",
      type: "POST",
      data: "ujian=" + ujian + "&index=" + index + "&jawab=" + jawab,
      success: function(data){
         if(data=="ok"){
            no = index+1;
            $('.item-'+no).addClass("ijo");
			var pilja = document.getElementById("pilja"+no);
			pilja.innerHTML = huruf[+ jawab];
         }else{
            alert(data);
         }
      },
      error: function(){
         alert('Tidak dapat mengirim jawaban!');
      }
   });

}


function AlertIt() {
$("#awal").css("display", "block");
$("#ahir").css("display", "none");	
if($("#slideMenu").hasClass('closed')){
				$("#slideMenu").animate({right:0}, 200, function(){
					$(this).removeClass('closed').addClass('opened');
					document.getElementById("kakisoal").style.width = '74%';					
					$("a#toggleLink").removeClass('toggleBtn').addClass('toggleBtnHighlight');
				});
$("#awal").css("display", "block");
$("#ahir").css("display", "none");					
//e.preventDefault();
		//return false;
			}//if close
			if($("#slideMenu").hasClass('opened')){
			
			if ( $(window).width() > 739) {      
				$("#slideMenu").animate({right:-400}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '97.7%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
			} else if ( $(window).width() > 409) {      
				$("#slideMenu").animate({right:-200}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '97.7%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
			
			} else {
				$("#slideMenu").animate({right:-240}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '97.7%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
}

				

$("#awal").css("display", "none");
$("#ahir").css("display", "block");					
//e.preventDefault();
			}//if close
}


          $('.some-class-name2').jfontsize({
                            btnMinusClasseId: '#jfontsize-m2',
                            btnDefaultClasseId: '#jfontsize-d2',
                            btnPlusClasseId: '#jfontsize-p2',
                            btnMinusMaxHits: 1,
                            btnPlusMaxHits: 1,
                            sizeChange: 5
                        });
						 $('.pilihanjawaban').jfontsize({
                            btnMinusClasseId: '#jfontsize-m2',
                            btnDefaultClasseId: '#jfontsize-d2',
                            btnPlusClasseId: '#jfontsize-p2',
                            btnMinusMaxHits: 1,
                            btnPlusMaxHits: 1,
                            sizeChange: 5
                        });
						 $('.jawab').jfontsize({
                            btnMinusClasseId: '#jfontsize-m2',
                            btnDefaultClasseId: '#jfontsize-d2',
                            btnPlusClasseId: '#jfontsize-p2',
                            btnMinusMaxHits: 1,
                            btnPlusMaxHits: 1,
                            sizeChange: 5
                        });
