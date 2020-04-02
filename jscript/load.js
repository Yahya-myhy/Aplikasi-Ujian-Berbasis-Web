$(document).ready(function(){
$('.btn').click(function(){
	$('#preview').fadeIn(400).html('<img src="images/loader.gif" align="absmiddle">&nbsp;<span class="loading">sending</span>');
	$("#writemessage").ajaxSubmit({
		target: '#preview'
	});
	$('#writemessage').clearForm()
	})
});


 $(document).ready(function() {
 	 $("#komentar").load("komentar.php");
   var refreshId = setInterval(function() 
      {
      $("#komentar").load('komentar.php?randval='+ Math.random());
      }, 1000);
       });



 $(document).ready(function() {
 	 $("#post").load("post.php");
   var refreshId = setInterval(function() 
      {
      $("#post").load('post.php?randval='+ Math.random());
      }, 1000);
       });