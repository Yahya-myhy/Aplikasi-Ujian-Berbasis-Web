$(function(){
   $('#isi').load('home.php');	
});

function show_detail(ujian){
   $('#isi').load('detail.php?ujian='+ujian);	
}
function show_nilai(ujian){
   $('#isi').load('nilai.php?ujian='+ujian);	
}

function show_petunjuk(ujian){
   $('#isi').load('petunjuk.php?ujian='+ujian);		
}

function show_ujian(ujian){
   $('#isi').load('ujian.php?ujian='+ujian);	
   return false;
}

function selesai_ujian(ujian){
   $.ajax({
      url: "ajax_ujian.php?action=selesai_ujian",
      type: "POST",
      data: "ujian="+ujian,
      success: function(data){
         if(data=="ok"){
            $('#modal-selesai').modal('hide');
            $('#modal-selesai').on('hidden.bs.modal', function(){
               $('#isi').load('home.php');
            });	
         }else{
            alert(data);
         }
      },
      error: function(){
         alert('Tidak dapat memproses nilai!');
      }
   });
   return false;
}