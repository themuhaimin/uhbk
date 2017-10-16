	$().ready(function(){                        
            $("#tombolTambah").click(function(){
                $.ajax({
                    url : "cmahasiswa/add_mahasiswa",
                    beforeSend: function(){
                                        $("#loading").fadeOut(10000).html("<img src='asset/img/loading51.gif'>");
                                    },
                    success:    function(html){
                                    $("#data").html(html);
                                    $("#btnSimpan").show();
                                    $("#btnKembali").show();
                                    $("#tombolTambah").hide();
                                }                
                });            
            });        
            
            $("#btnSimpan").click(function(){                
                var nim 		= $("#nim").val();
                var nama 		= $("#nama").val();
                var jurusan 	= $("#jurusan").val();
                var angkatan 	= $("#angkatan").val();                
                
                $.ajax({
                    url : "cmahasiswa/add_mahasiswa",
                    type: "POST",
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },
                    data    : "nim="+nim+"&nama="+nama+"&jurusan="+jurusan+"&angkatan="+angkatan+"&ipk="+ipk,
                    success:    function(html){
                                $("#tombolTambah").show();                                 
                                 $("#btnSimpan").hide();                                 
                                    $("#data").load("cmahasiswa/index/ #data");
                                    $("#notifikasi").html('Data berhasil disimpan');                                    
                                    $("#notifikasi").fadeIn(2500);
                                    $("#notifikasi").fadeOut(2500);                                
                                }                
                });            
            });
            
			
				$("#btnKembali").click(function(){                                
					$.ajax({
						url : "cmahasiswa",
						beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },                
						success:    function(html){
									$("#tombolTambah").show();
									$("#btnSimpan").hide();  
									$("#btnKembali").hide();																		                                
									$("#data").load("cmahasiswa #data");                                                                                                    
                                }                
					});            
				});
                        
                $("#tombolUpdate").click(function(){                    
                    var nim = $("#nim").val();
                    var nama = $("#nama").val();
                    var jurusan = $("#jurusan").val();
                    var angkatan = $("#angkatan").val();
                    var ipk = $("#ipk").val();                    
                    $.ajax({
                        url : "cmahasiswa/update",
                        type: "POST",
                        beforeSend: function(){
                                            $("#data").html("Loading...");
                                        },
                        data    : "nim="+nim+"&nama="+nama+"&jurusan="+jurusan+"&angkatan="+angkatan+"&ipk="+ipk,
                        success:    function(html){
                                    $("#tombolTambah").show();                                 
                                     $("#tombolUpdate").hide();                                 
                                        $("#data").load("index.php/cmahasiswa/index/ #data");
                                        $("#notifikasi").html('Data berhasil diedit');                                    
                                        $("#notifikasi").fadeIn(2500);
                                        $("#notifikasi").fadeOut(2500);                
                                    }                
                    });            
                });                                        
        });
        
        function edit(nim){
            $().ready(function(){                                        
                $.ajax({
                    url : "cmahasiswa/edit/"+nim,        
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },                
                    success:    function(html){
                                $("#tombolUpdate").show();                                 
                                 $("#tombolTambah").hide();                                 
                                    $("#data").html(html);                                                                                                    
                                }                
                });                    
            });        
        }
        
        function hapus(nim){
            if(confirm('Yakin Menghapus?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "cmahasiswa/delete/"+nim,        
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },                                                
                    success:    function(html){
                                $("#tombolUpdate").hide();                                 
                                 $("#tombolTambah").show();                                 
                                    $("#data").load('index.php/conmahasiswa/index/ #data');                                                                                                    
                                }                
                });                    
            });    
        }        
        }