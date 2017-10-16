
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CBT EXAM</title>

<script type="text/javascript" src="<?php echo base_url('asset/js/jquery.countdown.pack.js'); ?>"></script>
</head>
<div>
 <table class=" tabel">
 <tr><td>
 <div id="questions">
  </div>
  <form action ="process_ans.php" name="form1" class="login" id="form1" >
  <input name="qn" type="hidden" id="qn"/>
  <input name="qnarray" type="hidden" id="qn1" />
   <input name="qnarray2" type="hidden" id="qn2" />
     <input  name="Preview" type="button" class="prev btn btn-primary" value="<< Mundur" onclick="prev()" />
   <input  name="next" type="Button" class="nextq btn btn-primary" value="Maju >>"    onclick="test()"/> 
 </form>
</td></tr>
</table>
</div>
<?php   
//to count questions
//$qry2=mysql_query("select * from question where qclass='".$_SESSION['class']."' and test='".$_SESSION['test']."'");
$numrows=$this->session->userdata('limit');
//echo $numrows;
?>

<!-- TAB ONE script -->
<script type="text/javascript">

var totalq = <?php echo $numrows; ?>
    
function countdown(){
		var j = $('.jam');
		var m = $('.min');
		var s = $('.sec');
		if(j.html()== 0 && m.html()==0 && parseInt(s.html()) <= 0){
			$('.clock').html('WAKTU HABIS!!');
			$('#questions').hide();
			$('.nextq').hide();
			$('.prev').hide();
			$('#navigasi').hide();
			$('.sub').hide();
			submittest();
		}
		if(parseInt(m.html()) <=0 && j.html()>0 ){
			j.html(parseInt(j.html()-1));
			m.html(60);
		}
		if(parseInt(s.html()) <=0 ){
			m.html(parseInt(m.html()-1));
			s.html(60);
		}
		if(parseInt(s.html()) <=0){
			$('.clock').html('<span class="sec">59</span> seconds. ');
		}
		s.html(parseInt(s.html()-1));
		//menambahkan waktu tiap detiknya
		
		var waktu= parseInt($('.jam').html()*3600)+parseInt($('.min').html()*60) + parseInt($('.sec').html())
		if (waktu>-1){
					var formData = jQuery(this).serialize();
							$.ajax({
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/updatewaktu/'; ?>"+ waktu,
									data:formData,
									success: function(html){			
								}
							});	
							
					}
}
		setInterval ('countdown()', 1000);
		
		var db = '<?php echo $kode_acak ?>';
		
		var inc = -1;
		
				for (var i = 1, ar = []; i <= totalq; i++) {
				var explode = db.split('.');
    ar[i] = explode[i-1];
  }

  // randomize the array
  ar.sort(function () {
    //  return Math.random() - 0.5;
  });
// console.log(ar.pop());
//console.log(ar);
 
			
	
		

function test(){
//alert(ar);

  if(inc > totalq - 3){
   //  code
   //alert("Final")
  $('.nextq').fadeOut()
// $('.prev').fadeOut()
  }
   if(inc < totalq-1 )
   {
  inc++;
  }
  $("#soal_no").html(inc+1);
$('#qn').val(inc);
$('#qn1').val(ar);
console.log(inc);
$('#qn2').val(ar[inc]); 
//alert(stclass);
// To process student answer 
var qn= $('#qn2').val();
var cor =$('#qn3').val();

$(document).ready(function(e){
	//alert(totalq);
	 $('.prev').hide()
	var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/butirsoal/'; ?>"+ ar[inc]+"/"+ inc,
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});	
	
	
	
	//to insert values into database on form load before updating on option click

	$.ajax({
		
		
									type:"POST",
									url:"process_ans.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
							
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
															
										}
							}
						});	
	
	
	
jQuery(".nextq").click(function(e){
	 $('.prev').show()
								e.preventDefault();
								//alert(totalq);
								var formData = jQuery(this).serialize();
								$.ajax({
									
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/butirsoal/'; ?>"+ ar[inc]+"/"+inc,
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});			
							
});
});
}

//previous

function prev(){

  if(inc < 2){
   //  code
   //alert("Final")
 $('.prev').fadeOut()
  }
  if(inc>0){
       inc--;
		}
$("#soal_no").html(inc+1);
$('#qn').val(inc);
$('#qn1').val(ar);
console.log(inc);
$('#qn2').val(ar[inc]); 
//alert(stclass);
// To process student answer 
var qn= $('#qn2').val();
var cor =$('#qn3').val();

$(document).ready(function(e){

	//alert(totalq);
	
	var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/butirsoal/'; ?>"+ ar[inc]+"/"+inc,
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});	
	
	
	
	
	//to insert values into database on form load before updating on option click

	$.ajax({
		
		
									type:"POST",
									url:"process_ans.php?qno="+ ar[inc],
									data:formData,
									success: function(html){			
									if(html==0){
							
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
															
										}
							}
						});	
	
	
	
	
		
jQuery(".prev").click(function(e){
  
								e.preventDefault();
								//alert(totalq);
								 $('.nextq').show()
								var formData = jQuery(this).serialize();
								$.ajax({
									
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/butirsoal/'; ?>"+ ar[inc]+"/"+inc,
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});			
							
});
});
}

//lompat ke soal no
function lompat(e){
	inc = e;
if(inc > totalq - 2){
   $('.nextq').fadeOut()
   $('.prev').fadeIn()
  } else if(inc < 1){
   //  code
	$('.prev').fadeOut()
	$('.nextq').fadeIn()
  } else {
	$('.nextq').fadeIn()
    $('.prev').fadeIn()
	}
  $("#soal_no").html(inc+1);
	// value
	var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/butirsoal/'; ?>"+ ar[e]+"/"+e,
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)
										
										}
								}
							});	
}
//submit
jQuery(".sub").click(function(e){
	$('.clock').html('UJIAN SELESAI');
	$('.prev').hide()
	 $('.nextq').hide()
	  $('.sub').hide()
								e.preventDefault();
								//alert(totalq);
								var formData = jQuery(this).serialize();
								$.ajax({
									
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/kirim/'; ?>",
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//$('#questions').html(html);
									
										//$('#questions').fadeIn()
										$('#questions').text("ANDA TELAH MENYELESAIKAN ULANGAN HARIAN. ANDA AKAN DIARAHKAN KE HASIL ULANGAN HARIAN")
										
										var delay = 3000;
										 setTimeout((function(){ window.location = 'soal/hasil'  }), delay);
										
										
										}
								}
							});			
							
});
function submittest(){
								var formData = jQuery(this).serialize();
								$.ajax({
									
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/kirim/'; ?>",
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("something is wrong");
										
										return false;
											
										}else{
											//alert("everything is alright");	
											//alert(ar[inc]);
											//$('#questions').html(html);
									
										//$('#questions').fadeIn()
										alert("waktu anda habis. klik ok untuk melihat hasil");
										
										var delay = 10;
										 setTimeout((function(){ window.location = 'soal/hasil'  }), delay);
										
										
										}
								}
							});			
}
</script>

