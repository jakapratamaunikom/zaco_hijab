$(document).ready(function(){
	if(notif == "gagal") alertify.error("Data Tidak Ditemukan");
	else if(notif != false) alertify.success(notif);

	// setting datatable
	var tabel_barang = $("#tabel_barang").DataTable({
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
                "action" : "list",
            }
        },
        "columnDefs": [
            {
                "targets":[0, 7, 10], // disable order di kolom 1 dan 3
                "orderable":false,
            }
        ],
        "createdRow": function(row, data, dataIndex){
            if($(data[9]).text().toLowerCase() == "non aktif") $(row).addClass('danger');
        },
    });
});

function edit_status(id, status){
    var text = pesan = "";

    // cek status
    if(status == "aktif"){
        text = "Status Barang Akan di NON-AKTIFKAN !";
        setStatus = "0";
        pesan = "Barang Berhasil Di Non-Aktifkan";
    }
    else{
        text = "Status Barang Akan di AKTIFKAN !";
        setStatus = "1";
        pesan = "Barang Berhasil Di Aktifkan Kembali";
    }

    swal({
        title: "Apakah Anda Yakin ?",
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        closeOnConfirm: false,
        },function(){ // saat confirm
            $.ajax({
                url: base_url+"app/controllers/Barang.php",
                type: "post",
                dataType: "json",
                data: {
                    "id" : id,
                    "status": setStatus,
                    "action" : "setStatus",
                },
                success: function(hasil){
                    if(hasil.status){
                        swal({
                                title: "Pesan",
                                text: pesan,
                                type: "success",
                            }, function(){
                                $("#tabel_barang").DataTable().ajax.reload();
                            }
                        );
                    }
                    else swal("Pesan!", "Status Barang Gagal Di Ubah", "error");
                    console.log(hasil);
                },
                error: function (jqXHR, textStatus, errorThrown) { // error handling
                    swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
                    console.log(jqXHR, textStatus, errorThrown);
                }
            })
        }
    );
}