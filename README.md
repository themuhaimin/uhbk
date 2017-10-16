Codeigniter jQuery
==================

<font align="justify">Sedikit berbagi ya walaupun sudah banyak juga yang sudah ngeshare tapi disini saya sajikan dengan 
bahasa yang lebih enak dipahami. Untuk tutorialnya bisa mengunjungi</font>
<br /> [Blog Saya](http://www.dunia14inch.wordpress.com)

![](http://dunia14inch.files.wordpress.com/2013/03/1.png)
<table>
    <tr>
        <td width="980px" align="center"><b>Home View</b></td>
    </tr>
</table>


Sample My Javascript
====================

<pre>
    <code>
        <script>
            $("#btnSimpan").click(function(){                
    				var nim 		= $("#nim").val();
					var nama 		= $("#nama").val();
					var jurusan 	= $("#jurusan").val();
					var angkatan 	= $("#angkatan").val();
				
					if($("#nim").val() == "" || $("#nama").val() == "" || $("#jurusan").val() == "" || $("#angkatan").val() == "")
						$.ajax({
							success: function(html){
								$("#notifikasi").html('Data gagal disimpan');
								$("#notifikasi").fadeIn(1500);
								$("#notifikasi").fadeOut(1500);	
							}						
						});
					else
						$.ajax({
							url : "<?php echo base_url() ?>cmahasiswa/add_mahasiswa",
							type: "POST",
							beforeSend: function(){
												$("#loading").fadeIn(3000).html('<img src="<?php echo base_url(); ?>asset/img/loading51.gif">');
											},
							data    : "nim="+nim+"&nama="+nama+"&jurusan="+jurusan+"&angkatan="+angkatan,
							success:    function(html){
										$("#tombolTambah").show();                                 
										$("#btnKembali").hide();
										$("#btnSimpan").hide();
											$("#data").load("<?php echo base_url() ?>cmahasiswa #data");
											$("#notifikasi").html('Data berhasil disimpan');                                    
											$("#notifikasi").fadeIn(2500);
											$("#notifikasi").fadeOut(2500);                                
										}                
						});            
				});
        </script>
    </code>
</pre>


