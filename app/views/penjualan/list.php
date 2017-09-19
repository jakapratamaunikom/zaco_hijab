<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
    $notif = isset($_SESSION['notif']) ? $_SESSION['notif'] : false;
    unset($_SESSION['notif']);
?>

	<!-- List -->

	<!-- css -->
        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
    <!-- -->

    <!-- header dan breadcrumb -->
    <section class="content-header">
        <h1>Penjualan</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
            <li class="active"><a href="<?= base_url."index.php?m=penjualan&p=list"; ?>">Penjualan</a></li>
            <li>Data Penjualan</li>
        </ol>
    </section>

    <!-- isi konten -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- panel box -->
                <div class="box">
                    <!-- judul panel box -->
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h3 class="box-title">Data Penjualan</h3>
                            </div>
                        </div>
                        <!-- panel button -->
                        <div class="row" style="padding-top: 25px;">
                            <div class="col-md-12 col-xs-12">
                                <div class="btn-group">
                                    <!-- tambah -->
                                    <a href="<?= base_url."index.php?m=penjualan&p=form" ?>" class="btn btn-default btn-flat" role="button"><i class="fa fa-plus"></i> Tambah</a>
                                    <!-- export excel -->
                                    <button type="button" class="btn btn-success btn-flat" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                                    <!-- export pdf -->
                                    <button type="button" class="btn btn-danger btn-flat" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- isi panel box -->
                    <div class="box-body">
                        <!-- tabel -->
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <table id="tabel_penjualan" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">No</th>
                                            <th>Kode Penjualan</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Item</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- modal export -->
    <?php include_once("app/views/modals/modal_export.php"); ?>

    <!-- js -->
        <!-- DataTables -->
        <script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
        <script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
        <script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
        <script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
        <!-- js datepicker -->
        <script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
        <script type="text/javascript">
            var base_url = "<?php print base_url; ?>";
        </script>
        <!-- js modal export -->
        <script type="text/javascript" src="<?= base_url."app/views/modals/modal_export.js"; ?>"></script>
        <?php 
            if($notif){
                ?>
                <script>var notif = "<?php echo $notif; ?>";</script>
                <?php
            }
            else{
                ?>
                <script>var notif = false;</script>
                <?php
            } 
        ?>
        <script type="text/javascript">
            // setting datatable
            $(document).ready(function(){
                if(notif == "gagal") alertify.error("Data Tidak Ditemukan");
                else if(notif != false) alertify.success(notif);

                var tabel_penjualan = $("#tabel_penjualan").DataTable({
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
                        url: base_url+"app/controllers/Penjualan.php",
                        type: 'POST',
                        data: {
                            "action" : "list",
                        }
                    },
                    "columnDefs": [
                        {
                            "targets":[0, 7, 8], // disable order di kolom 1 dan 3
                            "orderable":false,
                        }
                    ],
                });
            });
        </script>
    <!-- -->    