<!-- modal export -->
<div class="modal fade" id="modal_reject">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title">Reject Barang</h4>
            </div>
            <form id="form_modal_reject" role="form" enctype="multipart/form-data">
                <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <legend>Barang Sebelumnya</legend>
                                    
                                <!-- field jenis -->
                                <div class="form-group">
                                    <label for="txt_nama">Nama</label>
                                    <input type="text" name="txt_nama" id="txt_nama" class="form-control" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txt_qty">Qty</label>
                                    <input type="number" name="txt_qty" id="txt_qty" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="txt_subtotal">Subtotal</label>
                                    <input type="text" name="txt_subtotal" id="txt_subtotal" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <legend>Barang Ganti</legend>
                                    
                                <!-- field jenis -->
                                <div class="form-group">
                                    <label for="txt_nama">Nama</label>
                                    <input type="text" name="txt_nama" id="txt_nama" class="form-control" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txt_qty">Qty</label>
                                    <input type="number" name="txt_qty" id="txt_qty" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="txt_subtotal">Subtotal</label>
                                    <input type="text" name="txt_subtotal" id="txt_subtotal" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="box-footer">
                    <button class="btn btn-success pull-right btn-flat" type="submit" id="btn_reject">Simpan</button>
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>