<?php
if ($jawab==='A'){
$opt1="checked";
}
else{
	$opt1="";
	}
	
	if ($jawab==='B'){
$opt2="checked";
}
else{
	$opt2="";
	}
	
	if ($jawab==='C'){
$opt3="checked";
}
else{
	$opt3="";
	}
	if ($jawab==='D'){
$opt4="checked";
}
else{
	$opt4="";
	}
	$this->session->unset_userdata('nomor_soal');
	$this->session->set_userdata('nomor_soal',$no);
 echo '<table class="tab">
 <tr><td>	
<div id="questions"> <b> '.$soal.'</b>
</td></tr>
 <tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt1.' value="A" id="RadioGroup1_0" />
     A. '.$a.' </label>
     </td></tr>
     <tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt2.' value="B" id="RadioGroup1_1" />
     B. '.$b.'</label></td></tr>
     <br />
     <tr> <td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt3.' value="C" id="RadioGroup1_2" />
        C. '.$c.'</label></td></tr>
     <br /><tr><td>
     <label>
       <input type="radio" name="RadioGroup1" '.$opt4.' value="D" id="RadioGroup1_3" />
       D. '.$d.'</label></td></tr>
     <br />
  <tr><td>
  
   </div>
   </div>
   </td></tr>
   </table>
   </table>
 ';
 
 
 
 
	//$qry3=mysql_query("insert into testattempt(stdid,testid,quid) values(".$_SESSION['stdid'].",'121',".$fetch['id'].")")
	?>
	<script src="style/jquery/jquery-2.1.3.min.js" > </script>
<script type="text/javascript" src="style/jquery/jquery.countdown.pack.js"></script>
    
    <script type="text/javascript">
    
    //on option click

jQuery("#RadioGroup1_0,#RadioGroup1_1,#RadioGroup1_2,#RadioGroup1_3").change(function(e){
	//alert("clicked")
	//alert(inc+1);
	var click=inc+1;
	$('#nv_'+ click).removeClass('btn-danger');
	$('#nv_'+ click).addClass('btn-primary');
								e.preventDefault();
								
								var formData = jQuery(this).serialize();
								$.ajax({
									
									type:"POST",
									url:"<?php echo base_url().'index.php/soal/optionclick/'; ?>"+ ar[inc]+"/<?php echo $kunci ?>",
									data:formData,
									success: function(html){			
									if(html==0){
								
										//alert("No");
										
										return false;
											
										}else{
											//alert("Yes");	
											//alert(ar[inc]);
											//alert(html);
										}
								}
							});		
});
</script>