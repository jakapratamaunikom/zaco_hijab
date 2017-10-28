$(document).ready(function(){
	if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
		var id = urlParams.id;
		getView(id);
	}
	// else document.location=base_url+"index.php?m=barang&p=list";

	//setting datatable
	var tabel_stok = $("#tabel_stok").DataTable({
		"language" : {
            "lengthMenu": "Tampilkan _MENU_ data/page",
            "zeroRecords": "Data Tidak Ada",
            "info": "Menampilkan _START_ s.d _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 s.d 0 dari 0 data",
            "search": "Pencarian:",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "lengthMenu": [ 25, 50, 75, 100 ],
        "pageLength": 25,
        order: [],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url+"app/controllers/Barang.php",
            type: 'POST',
            data: {
            	"id" : urlParams.id,
                "action" : "listStok",
            }
        },
        "columnDefs": [
            {
                "targets":[0], // disable order di kolom 1 dan 3
                "orderable":false,
            }
        ],
    });

	// onchange foto
		$(document).on('click', '#close-preview', function(){ 
		    $('.image-preview').popover('hide');
		    // Hover befor close the preview
		    $('.image-preview').hover(
		        function () {
		           $('.image-preview').popover('show');
		        }, 
		         function () {
		           $('.image-preview').popover('hide');
		        }
		    );    
		});
		// Create the close button
	    var closebtn = $('<button/>', {
	        type:"button",
	        text: 'x',
	        id: 'close-preview',
	        style: 'font-size: initial;',
	    });
	    closebtn.attr("class","close pull-right");
	    // Set the popover default content
	    $('.image-preview').popover({
	        trigger:'manual',
	        html:true,
	        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
	        content: "Tidak Ada Foto",
	        placement:'bottom'
	    });
	    // Clear event
	    $('.image-preview-clear').click(function(){
	        $('.image-preview').attr("data-content","").popover('hide');
	        $('.image-preview-filename').val("");
	        $('.image-preview-clear').hide();
	        $('.image-preview-input input:file').val("");
	        $(".image-preview-input-title").text("Pilih Foto"); 
	    }); 
	    // Create the preview image
	    $("#fFoto").change(function (){
	        var img = $('<img/>', {
	            id: 'dynamic',
	            width:250,
	            height:200
	        });      
	        var file = this.files[0];
	        var reader = new FileReader();
	        // Set preview image into the popover data-content
	        reader.onload = function (e) {
	            $(".image-preview-input-title").text("Ganti");
	            $(".image-preview-clear").show();
	            $("#fFoto_text").val(file.name);            
	            img.attr('src', e.target.result);
	            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
	        }        
	        reader.readAsDataURL(file);
	    });
	// ================================================= //

    // on click btn ganti foto
    $("#btn_gantiFoto").click(function(){
    	// swal("Button Ganti Foto Di Click");
    	$("#modal_foto .modal-title").html("Ganti Foto");
    	$("#modal_foto").modal();

    });

    // on click btn hapus foto
    $("#btn_hapusFoto").click(function(){
    	// tampilkan confirm
    	swal({
	    		title: "Apakah Anda Yakin ?",
	    		text: "Gambar Yang Sudah Dihapus Tidak Dapat Dikembalikan",
	    		type: "warning",
	    		showCancelButton: true,
	    		confirmButtonColor: "#DD6B55",
	    		confirmButtonText: "Ya, Hapus!",
	    		closeOnConfirm: false,
    		},function(){ // saat confirm
    			$.ajax({
		    		url: base_url+"app/controllers/Barang.php",
					type: "post",
					dataType: "json",
					data: {
		            	"id" : urlParams.id,
		                "action" : "hapus_foto",
		            },
					success: function(hasil){
						if(hasil.status){
							if(hasil.statusHapus){
								swal({
										title: "Pesan",
										text: "Foto Berhasil Dihapus",
										type: "success",
									}, function(){
										location.reload();
									}
								);
							}
							else swal("Pesan", "Tidak Ada Foto Yang Dihapus", "success");
						}
						else swal("Pesan!", "Foto Gagal Dihapus, Coba Lagi", "error");
						console.log(hasil);
					},
					error: function (jqXHR, textStatus, errorThrown) { // error handling
			            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }
		    	})
    		}
    	);
    });

    $("#form_foto").submit(function(e){
    	e.preventDefault();

    	var data = getFoto(id);

    	$.ajax({
    		url: base_url+"app/controllers/Barang.php",
			type: "post",
			dataType: "json",
			data: data,
			contentType: false,
		    cache: false,
			processData: false,
			success: function(hasil){
				// jika upload gagal
				if(!hasil.statusUpload) swal("Pesan Error", hasil.pesanError, "error");
				else location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) { // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            console.log(jqXHR, textStatus, errorThrown);
	        }
    	})

    	return false;
    });

});

function getFoto(id){
	var data = new FormData();

	data.append('id', id);
	data.append('foto', $("#fFoto")[0].files[0]);
	data.append('action', "edit_foto");

	return data;
}

function getView(id){
	$.ajax({
		url: base_url+"app/controllers/Barang.php",
		type: "post",
		dataType: "json",
		data: {
			"id" : id,
			"action" : "getView",
		},
		success: function(data){
			if(!data) document.location=base_url+"index.php?m=barang&p=list";
			else{
				setValue(data);
			}
			console.log(data);	
		},
		error: function (jqXHR, textStatus, errorThrown) { // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
        }

	})
}

function setValue(data){
	$("#nama_barang").text(data.nama); // set nama barang
	$("#kd_barang").text(data.kd_barang); // set nama kd barang
	$("#id_barang").text(data.id_barang); // set id barang
	$("#id_warna").text(data.id_warna); // set id warna
	$("#hpp").text(data.hpp); // set hpp
	$("#harga_pasar").text(data.harga_pasar); // set harga pasar 
	$("#market_place").text(data.market_place); // set harga market
	$("#harga_ig").text(data.harga_ig); // set harga harga ig
	$("#ket").text(data.ket); // set keterangan
	// set foto
	$("#foto").children().attr("href", base_url+"assets/gambar/"+data.foto);
	$("#foto").children().attr("data-title", data.nama);
	$("#foto").children().find('img').attr("src", base_url+"assets/gambar/"+data.foto);
}