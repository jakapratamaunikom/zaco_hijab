<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
    $id = isset($_GET['id']) ? $_GET['id'] : false;

    if($id) $btn = "edit";
    else $btn = "tambah";
?>
<!-- header dan breadcrumb -->
<section class="content-header">
    <h1>Form Data Pembelian</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=pembelian&p=list"; ?>">Pembelian</a></li>
        <li>Form Data Pembelian</li>
    </ol>
</section>

 <!-- isi konten -->
<section class="content">
    <form enctype="multipart/form-data" role="form" id="form_pembelian">
        <input type="hidden" name="id" id="id">
        <!-- panel 1 -->
        <div class="row">
            <div class="col-md-12">
                <!-- panel data pembelian -->
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Data Pembelian</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- kode pembelian -->
                                        <div class="form-group field-kode">
                                            <label for="fKd_pembelian">Kode Pembelian</label>
                                            <input type="text" name="fKd_pembelian" id="fKd_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian" readonly>
                                            <span class="help-block small"></span>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- tanggal -->
                                        <div class="form-group field-tgl">
                                            <label for="fTgl">Tanggal</label>
                                            <input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
                                            <span class="help-block small"></span> <!-- Tampilan Validasi -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group field-ket">
                                    <label for="fKet">Keterangan</label>
                                    <textarea id="fKet" class="form-control" placeholder="Masukkan Keterangan Pembelian"></textarea>
                                    <span class="help-block small"></span>
                                </div>       
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Data Barang</legend>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="fKd_barang">Barang</label>
                                            <select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fQty">Qty (pcs)</label>
                                            <div class="input-group">
                                                <input type="number" id="fQty" name="fQty" class="form-control" min="0" placeholder="Qty">
                                                <span class="input-group-addon">pcs</span>
                                            </div>
                                        </div>  
                                    </div>
                                    <span class="help-block small"></span>
                                </div>
                                <!-- Harga -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <label for="fHarga">Harga</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="background-color: #dd4b39; color: white;">
                                                    Rp. 
                                                </span>
                                                <input class="form-control" placeholder="Masukkan Harga" id="fHarga" name="fHarga" type="number" min="0">
                                                <span class="input-group-addon">,00</span>
                                                <span class="input-group-btn">
                                                    <button type="button" id="fTambah_pembelian" name="fTambah_pembelian" class="btn btn-default">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block small"></span>  
                                </div>
                            </fieldset>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
        <!-- panel 2 -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <fieldset>
                            <legend>List Item</legend>
                            <div class="table-responsive">
                               <table id="tabel_item_pembelian" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">No</th>
                                            <th>Item</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Keterangan</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- tbody agar bisa ditambah saat button +barang di klik -->
                                    <tbody></tbody>
                                </table>
                            </div>
                            <h4 id="tampilHarga" class="text-right">Total: Rp. -,00</h4>  
                        </fieldset>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-default btn-lg btn-flat" id="btnSubmit" value="<?= $btn ?>">
                            <i class="fa fa-plus"></i> <?= ucfirst($btn); ?>
                        </button>
                        <a href="<?=base_url."index.php?m=pembelian&p=list" ?>" class="btn btn-default btn-lg btn-flat"><i class="fa fa-reply"></i>  Batal</a>
                    </div>
                </div>     
            </div>
        </div>
    </form>
</section>                      


<script type="text/javascript" src="<?= base_url."app/views/pembelian/js/initForm.js"; ?>"></script>