$(document).ready(function(){
 	// btn tambah id barang onclick
    $("#btn_tambahIdWarna").click(function(){
        // reset pesan error
        reset_form();
        // tampilkan modal
        $("#modal_idWarna .modal-title").html("Form Tambah Data Id Warna"); // ganti heade form
        $("#submit_idWarna").prop("value", "Tambah");
        $("#modal_idWarna").modal();
    });

    // submit form modal tambah id barang
    $("#form_modal_idWarna").submit(function(e){
        e.preventDefault();
        submit();
        return false;
    });
});

function submit(){
	var id = $("#id_idWarna").val().trim();
    var id_warna = $("#id_warna").val().trim();
    var nama = $("#nama_idWarna").val().trim();
    var submit = $("#submit_idWarna").val();

   // request action
    $.ajax({
        url: base_url+"app/controllers/Id_warna.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "id_warna" : id_warna,
            "nama" : nama,
            "action" : submit,
        },
        beforeSend: function(){
            setLoading();
        },
        success: function(hasil){
            setLoading(false);
            // cek hasil dari ajax
            // cek statusnya
            if(hasil.status){ // jika status true
                reset_form(); 
                $("#modal_idWarna").modal('hide');
                // cek jenis actionya
                if(submit.toLowerCase()==="edit") alertify.success('Data Berhasil Diedit'); // jika edit
                else alertify.success('Data Berhasil Ditambah'); // jika tambah
                $("#tabel_id_warna").DataTable().ajax.reload(); // reload tabel
            }
            else{ // jika status false
                // cek jenis error
                if(hasil.errorDb){ // jika ada error database
                    swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                    reset_form();
                    $("#form_modal_idWarna").modal('hide');
                }
                else{
                    reset_form();
                    // cek apakah duplikat
                    if(hasil.duplikat){ // jika duplikat
                        $("#fmId_warna").parent().find('.help-block').text("Id Warna Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
                        $("#fmId_warna").closest('div').addClass('has-error');
                    }
                    else{
                        if(submit.toLowerCase()==="edit") $("#fmId_warna").prop("disabled", true);
                        setError(hasil.pesanError);
                    }
                    // set value
                    setValue(hasil.set_value);
                }   
            }

            console.log(hasil);
        },
        error: function (jqXHR, textStatus, errorThrown) // error handling
        {
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $("#modal_idWarna").modal('hide');
            reset_form();
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

// fungsi get data edit
function edit_id_warna(id){
    $.ajax({
        url: base_url+"app/controllers/Id_warna.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "action" : "getEdit",
        },
        beforeSend: function(){
            setLoading();
        },
        success: function(data){
            setLoading(false);
            // reset modal
            reset_form();
            // tampilkan modal
            $("#modal_idWarna .modal-title").html("Form Edit Data Id Warna");
            $("#id_warna").val(data.id);
            $("#fmId_warna").val(data.id_warna);
            $("#fmNama_idWarna").val(data.nama);
            $("#fmId_warna").prop("disabled", true);
            $("#submit_idWarna").prop("value", "Edit");
            $("#modal_idWarna").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) // error handling
        {
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $(".overlay").css("display", "none");
            $("#modal_idWarna").modal('hide');
            reset_form();
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

function reset_form(){
    // reset pesan error
    $("#fmId_warna").parent().find('.help-block').text("");
    $("#fmId_warna").closest('div').removeClass('has-error');
    $("#fmNama_idWarna").parent().find('.help-block').text("");
    $("#fmNama_idWarna").closest('div').removeClass('has-error');
    // bersihkan form
    $('#form_modal_idWarna').trigger('reset');
    $("#fmId_warna").prop("disabled", false);
}

// fungsi set error
function setError(error){
    // set error fId_barang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(error.id_warnaError)){
        $("#fmId_warna").parent().find('.help-block').text(error.id_warnaError);
        $("#fmId_warna").closest('div').addClass('has-error');
    }
    else{
        $("#fmId_warna").parent().find('.help-block').text("");
        $("#fmId_warna").closest('div').removeClass('has-error');
    }
    
    // set error fNama_idBarang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(error.namaWarnaError)){
        $("#fmNama_idWarna").parent().find('.help-block').text(error.namaWarnaError);
        $("#fmNama_idWarna").closest('div').addClass('has-error');
    }
    else{
        $("#fmNama_idWarna").parent().find('.help-block').text("");
        $("#fmNama_idWarna").closest('div').removeClass('has-error');
    }   
}

// fungsi set value
function setValue(value){
    $("#fmId_warna").val(value.id_warna);
    $("#fmNama_idWarna").val(value.namaWarna);
}

function setLoading(block=true){
    if(block === true){
        $('.modal-content').block({
            message: '<h4><img src="'+base_url+'assets/gambar/busy.gif" /> Mohon Menunggu...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
    }
    else $('.modal-content').unblock();
}