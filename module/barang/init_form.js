//setting datatable
$(document).ready(function(){
	// console.log(jQuery.isEmptyObject(urlParams.id));
	// console.log(urlParams);

	var cekEdit = false;

	// cek status form, tambah/edit
	if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
		// edit_barang(urlParams.id);
		cekEdit = true;
	}

	$("#fId_barang").select2();
	$("#fId_warna").select2();

	if(!cekEdit){
		setSelect("id_barang", $("#fId_barang"));
		setSelect("id_warna", $("#fId_warna"));
	}

	if(cekEdit) edit_barang(urlParams.id);

	// event id_barang dan id_warna
		// button tambah id barang onclick
		$("#btn_tambah_idBarang").click(function(){
			// reset pesan error
	        reset_form("#form_modal_idBarang");
	        // tampilkan modal
	        $("#modal_idBarang .modal-title").html("Form Tambah Data Id Barang"); // ganti heade form
	        $("#btn_submit_idBarang").prop("value", "Tambah");
	        $("#modal_idBarang").modal();
		});

		// button tambah id barang onclick
		$("#btn_tambah_idWarna").click(function(){
			// reset pesan error
	        reset_form("#form_modal_idWarna");
	        // tampilkan modal
	        $("#modal_idWarna .modal-title").html("Form Tambah Data Id Warna"); // ganti heade form
	        $("#submit_idWarna").prop("value", "Tambah");
	        $("#modal_idWarna").modal();
		});

		// submit form modal tambah id barang
	    $("#form_modal_idBarang").submit(function(e){
	        e.preventDefault();
	        tambah_idBarang();
	        return false;
	    });

		// submit form modal tambah id barang
	    $("#form_modal_idWarna").submit(function(e){
	        e.preventDefault();
	        tambah_idWarna();
	        return false;
	    });
	// ================================================== //
		
	// onchange id barang
	$("#fId_barang").change(function(){
		if(!cekEdit) setBarang();
	});
	// onchange id warna
	$("#fId_warna").change(function(){
		if(!cekEdit) setBarang();
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

	// submit barang
	$("#form_barang").submit(function(e){
		e.preventDefault();
		submitBarang();

		return false;
	})
	
	console.log(cekEdit);
	
});

// funsgi set isi select id_barang dan id_warna
function setSelect(select, idSelect){
	// reset ulang select
	idSelect.find('option').remove().end();
	var text = "";

	if(select === "id_barang"){
		text = "-- Pilih Id Barang --";
		var firstOption = new Option(text, "");
	} 
	else{
		text = "-- Pilih Id Warna --";
		var firstOption = new Option(text, "");
	} 

	idSelect.append(firstOption);

	$.ajax({
		url: base_url+"module/barang/action.php",
        type: "post",
        dataType: "json",
        data: {
            "select" : select,
            "action" : "getSelect",
        },
        success: function(data){
        	$.each(data, function(index, item){
        		var text = item[1]+" - "+item.nama; 
        		var newOption = new Option(text, item.id);
				idSelect.append(newOption);			
			});
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
            // location.reload();
        }
	})
}

// fungsi kode barang dan nama barang otomatis terisi
function setBarang(){
	var text_idBarang = $("#fId_barang").select2('data')[0].text;
	var text_idWarna = $("#fId_warna").select2('data')[0].text;
	
	var split_idBarang = text_idBarang.split('-');
	var split_idWarna = text_idWarna.split('-');

	if($("#fId_barang").val() !== "" && $("#fId_warna").val() !== ""){
		$("#fKd_barang").val(split_idBarang[0].trim()+"-"+split_idWarna[0].trim());
		$("#fNama_barang").val(split_idBarang[1].trim()+" "+split_idWarna[1].trim());
	}
}

// fungsi get data di form
function getDataForm(){
	var data = new FormData();

	data.append('id', $("#id").val().trim());
	data.append('id_barang', $("#fId_barang").val().trim()); // data id barang
	data.append('id_warna', $("#fId_warna").val().trim()); // data id warna
	data.append('kd_barang', $("#fKd_barang").val().trim()); // data kd barang
	data.append('nama', $("#fNama_barang").val().trim()); // data nama
	data.append('foto', $("#fFoto")[0].files[0]); // data foto
	data.append('ket', $("#fKet").val().trim()); // data ket
	data.append('hpp', $("#fHpp").val().trim()); // data hpp
	data.append('harga_pasar', $("#fHarga_pasar").val().trim()); // data harga pasar
	data.append('market_place', $("#fHarga_market").val().trim()); // data harga market_place
	data.append('harga_ig', $("#fHarga_ig").val().trim()); // data harga ig
	data.append('stokAwal', $("#fStokAwal").val().trim()); // data stok awal
	data.append('action', $("#btn_submit_barang").val().trim()); // submit

	return data;
}

// fungsi submit barang
function submitBarang(){
	var data = getDataForm();

	$.ajax({
		url : base_url+"module/barang/action.php",
		type : "post",
		dataType : "json",
		data: data,
		contentType: false,
	    cache: false,
		processData: false,
		success: function(hasil){
			// cek hasil dari ajax
			// cek status
			if(hasil.status) document.location=base_url+"index.php?m=barang&p=list"; // jika berhasil
			else{ // jika status false
				// cek jenis error
				if(hasil.errorDb){ // jika db error
					swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                    reset_form("#form_barang");
				}
				else{
					// reset form
					// cek apakah duplikat
					if(hasil.duplikat){
						$("#fKd_barang").parent().find('.help-block').text("Kode Barang Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
    					$("#fKd_barang").closest('div').addClass('has-error');
					}
					else{
						// set error
						setError(hasil);
					}
					// set value
					setValue(hasil);
				}

			}

			console.log(hasil);
		},
		error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            reset_form("#form_barang");
            console.log(jqXHR, textStatus, errorThrown);
        }
	})
}

// fungsi get data edit
function edit_barang(id){
	$.ajax({
		url: base_url+"module/barang/action.php",
		type: "post",
		dataType: "json",
		data: {
			"id" : id,
			"action" : "getEdit",
		},
		success: function(data){
			if(!data) document.location=base_url+"index.php?m=barang&p=list";
			else{
				var text_idBarang = data.id_idBarang+" - "+data.nama_idBarang;
        		var option_idBarang = new Option(text_idBarang, data.id_barang, true, true);
        		$("#fId_barang").append(option_idBarang);

        		var text_idWarna = data.id_idWarna+" - "+data.nama_idWarna;
        		var option_idWarna = new Option(text_idWarna, data.id_warna, true, true);
        		$("#fId_warna").append(option_idWarna);

        		var hpp = parseFloat(data.hpp) ? parseFloat(data.hpp) : data.hpp;
				var harga_pasar = parseFloat(data.harga_pasar) ? parseFloat(data.harga_pasar) : data.harga_pasar;
				var harga_ig = parseFloat(data.harga_ig) ? parseFloat(data.harga_ig) : data.harga_ig;
				var market_place = parseFloat(data.market_place) ? parseFloat(data.market_place) : data.market_place;

				$("#fStokAwal").parent().parent().parent().parent().parent().closest('div').css("display", "none");
				$("#id").val(data.id);
				$("#fKd_barang").val(data.kd_barang);
				$("#fNama_barang").val(data.nama);
				$("#fKet").val(data.ket);
				$("#fHpp").val(hpp);
				$("#fHarga_pasar").val(harga_pasar);
				$("#fHarga_market").val(market_place);
				$("#fHarga_ig").val(harga_ig);

				$("#fId_barang").prop("disabled", true);
				$("#fId_warna").prop("disabled", true);
				$("#fKd_barang").prop("readonly", true);
				$("#btn_tambah_idWarna").prop("disabled", true);
				$("#btn_tambah_idBarang").prop("disabled", true);
				$("#field_foto").css("display", "none");
			}
				
			console.log(data);
		},
		error: function (jqXHR, textStatus, errorThrown) { // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
        }
	})
}

function reset_form(form){

    // reset pesan error
    if(form === "#form_barang"){
    	// field id barang
    	$("#fId_barang").parent().find('.help-block').text("");
	    $("#fId_barang").parent().parent().parent().closest('div').removeClass('has-error');

	    // field id warna
	    $("#fId_warna").parent().find('.help-block').text("");
	    $("#fId_warna").parent().parent().parent().closest('div').removeClass('has-error');

	    // kode barang
	    $("#fKd_barang").parent().find('.help-block').text("");
	    $("#fKd_barang").closest('div').removeClass('has-error');

	    // nama baranag
	    $("#fNama_barang").parent().find('.help-block').text("");
	    $("#fNama_barang").closest('div').removeClass('has-error');

	    // foto
	    // $("#fFoto_text").parent().find('.help-block').text("");
	    // $("#fFoto_text").parent().parent().parent().closest('div').removeClass('has-error');

	    // keterangan
	    $("#fKet").parent().find('.help-block').text("");
	    $("#fKet").closest('div').removeClass('has-error');

	    // hpp
	    $("#fHpp").parent().parent().find('.help-block').text("");
	    $("#fHpp").parent().parent().closest('div').removeClass('has-error');

	    // harga pasar
	    $("#fHarga_pasar").parent().parent().find('.help-block').text("");
	    $("#fHarga_pasar").parent().parent().closest('div').removeClass('has-error');
	   	
	   	// market place
	    $("#fHarga_market").parent().parent().find('.help-block').text("");
	    $("#fHarga_market").parent().parent().closest('div').removeClass('has-error');

	    // harga ig
	    $("#fHarga_ig").parent().parent().find('.help-block').text("");
	    $("#fHarga_ig").parent().parent().closest('div').removeClass('has-error');

	    // harga ig
	    $("#fStokAwal").parent().parent().find('.help-block').text("");
	    $("#fStokAwal").parent().parent().closest('div').removeClass('has-error');
    }
    else if(form === "#form_modal_idBarang"){
    	$("#fmId_barang").parent().find('.help-block').text("");
	    $("#fmId_barang").closest('div').removeClass('has-error');
	    $("#fmNama_idBarang").parent().find('.help-block').text("");
	    $("#fmNama_idBarang").closest('div').removeClass('has-error');
	  	 // bersihkan form
    	$(form).trigger('reset');

    }
    else if(form === "#form_modal_idWarna"){
    	$("#fmId_warna").parent().find('.help-block').text("");
	    $("#fmId_warna").closest('div').removeClass('has-error');
	    $("#fmNama_idWarna").parent().find('.help-block').text("");
	    $("#fmNama_idWarna").closest('div').removeClass('has-error');
	    // bersihkan form
    	$(form).trigger('reset');
    }
}

// fungsi set error form barang
function setError(hasil){
	// set error fId_barang
	// jika ada pesan error
	if(!jQuery.isEmptyObject(hasil.pesanError.id_barangError)){
        $("#fId_barang").parent().find('.help-block').text(hasil.pesanError.id_barangError);
        $("#fId_barang").parent().parent().parent().closest('div').addClass('has-error');
        $("#fKd_barang").parent().find('.help-block').text("Kode Barang Harus Diisi");
        $("#fKd_barang").closest('div').addClass('has-error');
    }
    else{
        $("#fId_barang").parent().find('.help-block').text("");
        $("#fId_barang").parent().parent().parent().closest('div').removeClass('has-error');
        $("#fKd_barang").parent().find('.help-block').text("");
        $("#fKd_barang").closest('div').removeClass('has-error');
    }

    // set error fId_warna
	// jika ada pesan error
	if(!jQuery.isEmptyObject(hasil.pesanError.id_warnaError)){
        $("#fId_warna").parent().find('.help-block').text(hasil.pesanError.id_warnaError);
        $("#fId_warna").parent().parent().parent().closest('div').addClass('has-error');
        $("#fKd_barang").parent().find('.help-block').text("Kode Barang Harus Diisi");
        $("#fKd_barang").closest('div').addClass('has-error');
    }
    else{
        $("#fId_warna").parent().find('.help-block').text("");
        $("#fId_warna").parent().parent().parent().closest('div').removeClass('has-error');
        $("#fKd_barang").parent().find('.help-block').text("");
        $("#fKd_barang").closest('div').removeClass('has-error');
    }

    // set error fNama_barang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.namaError)){
        $("#fNama_barang").parent().find('.help-block').text(hasil.pesanError.namaError);
		$("#fNama_barang").closest('div').addClass('has-error');
    }
    else{
    	$("#fNama_barang").parent().find('.help-block').text("");
		$("#fNama_barang").closest('div').removeClass('has-error');
    }

    // set error fFoto
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.fotoError)){
        $("#fFoto_text").parent().parent().find('.help-block').text(hasil.pesanError.fotoError);
		$("#fFoto_text").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fFoto_text").parent().parent().find('.help-block').text("");
		$("#fFoto_text").parent().parent().closest('div').removeClass('has-error');
    }

    // set error fKet
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.ketError)){
		$("#fKet").parent().find('.help-block').text(hasil.pesanError.ketError);
		$("#fKet").closest('div').addClass('has-error');
    }
    else{
    	$("#fKet").parent().find('.help-block').text("");
		$("#fKet").closest('div').removeClass('has-error');
    }

    // set error fHpp
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.hppError)){
		$("#fHpp").parent().parent().find('.help-block').text(hasil.pesanError.hppError);
		$("#fHpp").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fHpp").parent().parent().find('.help-block').text("");
		$("#fHpp").parent().parent().closest('div').removeClass('has-error');
    }

   	// set error harga pasar
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.harga_pasarError)){
		$("#fHarga_pasar").parent().parent().find('.help-block').text(hasil.pesanError.harga_pasarError);
		$("#fHarga_pasar").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fHarga_pasar").parent().parent().find('.help-block').text("");
		$("#fHarga_pasar").parent().parent().closest('div').removeClass('has-error');
    }

    // set error harga market place
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.market_placeError)){
		$("#fHarga_market").parent().parent().find('.help-block').text(hasil.pesanError.market_placeError);
		$("#fHarga_market").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fHarga_market").parent().parent().find('.help-block').text("");
		$("#fHarga_market").parent().parent().closest('div').removeClass('has-error');
    }

    // set error harga ig
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.harga_igError)){
		$("#fHarga_ig").parent().parent().find('.help-block').text(hasil.pesanError.harga_igError);
		$("#fHarga_ig").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fHarga_ig").parent().parent().find('.help-block').text("");
		$("#fHarga_ig").parent().parent().closest('div').removeClass('has-error');
    }

    // set error stok awal
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.stokAwalError)){
		$("#fStokAwal").parent().parent().find('.help-block').text(hasil.pesanError.stokAwalError);
		$("#fStokAwal").parent().parent().closest('div').addClass('has-error');
    }
    else{
    	$("#fStokAwal").parent().parent().find('.help-block').text("");
		$("#fStokAwal").parent().parent().closest('div').removeClass('has-error');
    }
}

// fungsi set value error form barang
function setValue(hasil){
	// set value
	var hpp = parseFloat(hasil.set_value.hpp) ? parseFloat(hasil.set_value.hpp) : hasil.set_value.hpp;
	var harga_pasar = parseFloat(hasil.set_value.harga_pasar) ? parseFloat(hasil.set_value.harga_pasar) : hasil.set_value.harga_pasar;
	var harga_ig = parseFloat(hasil.set_value.harga_ig) ? parseFloat(hasil.set_value.harga_ig) : hasil.set_value.harga_ig;
	var market_place = parseFloat(hasil.set_value.market_place) ? parseFloat(hasil.set_value.market_place) : hasil.set_value.market_place;
	var stokAwal = parseFloat(hasil.set_value.stokAwal) ? parseFloat(hasil.set_value.stokAwal) : hasil.set_value.stokAwal;

	$("#fId_barang").select2().val(hasil.set_value.id_barang).trigger('change');
	$("#fId_warna").select2().val(hasil.set_value.id_warna).trigger('change');
	$("#fKd_barang").val(hasil.set_value.kd_barang);
	$("#fNama_barang").val(hasil.set_value.nama);
	$("#fKet").val(hasil.set_value.ket);
	$("#fHpp").val(hpp);
	$("#fHarga_pasar").val(harga_pasar);
	$("#fHarga_market").val(market_place);
	$("#fHarga_ig").val(harga_ig);
	$("#fStokAwal").val(stokAwal);
}

// fungsi submit modal id barang
function tambah_idBarang(){
	var id = $("#id_barang").val().trim();
    var id_barang = $("#fmId_barang").val().trim();
    var nama = $("#fmNama_idBarang").val().trim();
    var submit = $("#btn_submit_idBarang").val();

    // request action
    $.ajax({
        url: base_url+"module/id_barang/action.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "id_barang" : id_barang,
            "nama" : nama,
            "action" : submit,
        },
        success: function(hasil){

            // cek hasil dari ajax
            // cek statusnya
            if(hasil.status){ // jika status true
                reset_form("#form_modal_idBarang"); 
                $("#modal_idBarang").modal('hide');
                // cek jenis actionya
                alertify.success('Data Id Barang Berhasil Ditambah'); // jika tambah
                setSelect("id_barang", $("#fId_barang")); // reload select
            }
            else{ // jika status false
                // cek jenis error
                if(hasil.errorDb){ // jika ada error database
                    swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                    reset_form("#form_modal_idBarang");
                    $("#form_modal_idBarang").modal('hide');
                }
                else{
                    reset_form("#form_modal_idBarang");
                    // cek apakah duplikat
                    if(hasil.duplikat){ // jika duplikat
                        $("#fmId_barang").parent().find('.help-block').text("Id Barang Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
                        $("#fmId_barang").closest('div').addClass('has-error');
                    }
                    else setError_idBarang(hasil);
                    setValue_idBarang(hasil);
                }   
            }
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $("#modal_idBarang").modal('hide');
            reset_form("#form_modal_idBarang");
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

// fungsi submit modal id warna
function tambah_idWarna(){
	var id = $("#id_warna").val().trim();
    var id_warna = $("#fmId_warna").val().trim();
    var nama = $("#fmNama_idWarna").val().trim();
    var submit = $("#submit_idWarna").val();

   	// request action
    $.ajax({
        url: base_url+"module/id_warna/action.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "id_warna" : id_warna,
            "nama" : nama,
            "action" : submit,
        },
        success: function(hasil){

            // cek hasil dari ajax
            // cek statusnya
            if(hasil.status){ // jika status true
                reset_form("#form_modal_idWarna");
                $("#modal_idWarna").modal('hide');
                // cek jenis actionya
                alertify.success('Data Id Warna Berhasil Ditambah'); // jika tambah
                setSelect("id_warna", $("#fId_warna")); // reload select
            }
            else{ // jika status false
                // cek jenis error
                if(hasil.errorDb){ // jika ada error database
                    swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                    setSelect("id_warna", $("#fId_warna"));
                    $("#form_modal_idWarna").modal('hide');
                }
                else{
                    // cek apakah duplikat
                    if(hasil.duplikat){ // jika duplikat
                        $("#fmId_warna").parent().find('.help-block').text("Id Warna Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
                        $("#fmId_warna").closest('div').addClass('has-error');
                    }
                    else setError_idWarna(hasil);
                    setValue_idWarna(hasil);
                }   
            }

            console.log(hasil);
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $("#modal_idWarna").modal('hide');
            reset_form("#form_modal_idWarna");
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

function setError_idBarang(hasil){
	if(!jQuery.isEmptyObject(hasil.pesanError.id_barangError)){
        $("#fmId_barang").parent().find('.help-block').text(hasil.pesanError.id_barangError);
        $("#fmId_barang").closest('div').addClass('has-error');
    }
    else{
        $("#fmId_barang").parent().find('.help-block').text("");
        $("#fmId_barang").closest('div').removeClass('has-error');
    }
    
    // set error fmNama_idBarang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.namaBarangError)){
        $("#fmNama_idBarang").parent().find('.help-block').text(hasil.pesanError.namaBarangError);
        $("#fmNama_idBarang").closest('div').addClass('has-error');
    }
    else{
        $("#fmNama_idBarang").parent().find('.help-block').text("");
        $("#fmNama_idBarang").closest('div').removeClass('has-error');
    }   
}

function setValue_idBarang(hasil){
	$("#fmId_barang").val(hasil.set_value.id_barang);
    $("#fmNama_idBarang").val(hasil.set_value.namaBarang);
}

function setError_idWarna(hasil){
	if(!jQuery.isEmptyObject(hasil.pesanError.id_warnaError)){
        $("#fmId_warna").parent().find('.help-block').text(hasil.pesanError.id_warnaError);
        $("#fmId_warna").closest('div').addClass('has-error');
    }
    else{
        $("#fmId_warna").parent().find('.help-block').text("");
        $("#fmId_warna").closest('div').removeClass('has-error');
    }
    
    // set error fNama_idBarang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.namaWarnaError)){
        $("#fmNama_idWarna").parent().find('.help-block').text(hasil.pesanError.namaWarnaError);
        $("#fmNama_idWarna").closest('div').addClass('has-error');
    }
    else{
        $("#fmNama_idWarna").parent().find('.help-block').text("");
        $("#fmNama_idWarna").closest('div').removeClass('has-error');
    }   
}

function setValue_idWarna(hasil){
	$("#fmId_warna").val(hasil.set_value.id_warna);
    $("#fmNama_idWarna").val(hasil.set_value.namaWarna);
}