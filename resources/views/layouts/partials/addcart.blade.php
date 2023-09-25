<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="addcartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah ke Keranjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['method' => 'post', 'route' => ['keranjang.tambah']]) }}
                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Product</label>
                                <input type="hidden" name="barang_id" id="barangId" class="form-control">
                                <input type="text" name="nama_barang" id="namaBarang" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Price (Rp)</label>
                                <input type="text" name="harga_barang" id="hargaBarang" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="form-label">Quantity</label><br>
                                <div class="input-group quantity mx-auto">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="kuantitas" id="kuantitas" class="form-control form-control-sm bg-secondary border-0 text-center" value="0">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="form-label">Total (Rp)</label>
                                <input type="number" name="total_harga" id="totalPrice" class="form-control" readonly>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                {{ Form::close() }}
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
