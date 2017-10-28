$(document).ready(function(){

    // setting datatable
    var tabel_id_barang = $("#tabel_id_barang").DataTable({
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
            url: base_url+"app/controllers/Id_barang.php",
            type: 'POST',
            data: {
                "action" : "list",
            }
        },
        "columnDefs": [
            {
                "targets":[0, 3], // disable order di kolom 1 dan 3
                "orderable":false,
            }
        ],
        // "createdRow": function(row, data, dataIndex){
        //     if(data[1] == "RAI"){
        //         $(row).addClass('danger');
        //     }
        // },
    });
});

