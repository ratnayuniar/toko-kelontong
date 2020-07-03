

<div class="content-wrapper"><br/>
	 <section class="content-header">
      <h1>
        Penjualan
        <small>Toko Kelontong</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>
	<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
              <h3 class="box-title">Pilih Belanjaan</h3>
            </div>
			
			<div class="row">
				<div class="col-md-12">
			<?php foreach ($data as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="<?php echo base_url().'assets/images/'.$row->gambar_barang;?>">
						<div class="caption">
							<h4><?php echo $row->nama_barang;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo 'Rp '.number_format($row->harga_barang);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-produkid="<?php echo $row->id;?>" data-produknama="<?php echo $row->nama_barang;?>" data-produkharga="<?php echo $row->harga_barang;?>">Beli</button>
						</div>
					</div>
				</div>
			<?php endforeach;?>
				
			</div>

		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">Pembayaran</h3>
            </div>
            <div class="row">
				<div class="col-md-12">
	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nama Barang</th>
						<th>Harga</th>
						<th>Jumlah Beli</th>
						<th>Subtotal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="detail_cart">

				</tbody>
				
			</table>
		</div>
	</div>
	</div>
</div>
	</section>
	<!--Modal-->
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Nota Pembelian</h4>
			</div>
			<div class="modal-body text-center">
				<h4 class="totalan" ></h4>
				<form>

					<div class="modal-body">
                                               
                <div class="form-group" >
                    <label class="col-md-3 control-label">Jumlah Beli</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" required>
                        </div>
                </div>       
                <br><br>                             
                <div class="form-group">
                    <label class="col-md-3 control-label">Harga</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                </div>
                <br><br>
                 <div class="form-group">
                    <label class="col-md-3 control-label">Total</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-md-3 control-label">Bayar</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-md-3 control-label">Kembali</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                </div>
                <br><br>
                <br><br>  
            </div>

				<!--<center >
				<input type="text" id="bayare" name="" class="form-control" required="required" placeholder="Bayar">
				</center>
				<div id="ganti">
				</div>-->
			</div>
			<div class="modal-footer">
					<!--<button type="button" id="kembalian" class="btn btn-primary">BAYAR</button>-->
					<a class="btn btn-success" href="<?=site_url("cart/selesai")?>">SELESAI</a>
				<form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-2.2.3.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var id    = $(this).data("produkid");
			var nama_barang  = $(this).data("produknama");
			var harga_barang = $(this).data("produkharga");
			var quantity     = $('#' + id).val();
			$.ajax({
				url : "<?php echo base_url();?>index.php/cart/add_to_cart",
				method : "POST",
				data : {id: id, nama_barang: nama_barang, harga_barang: harga_barang, quantity: quantity},
				success: function(data){
					$('#detail_cart').html(data);
				}
			});
		});

		// Load shopping cart
		$('#detail_cart').load("<?php echo base_url();?>index.php/cart/load_cart");

		//Hapus Item Cart
		$(document).on('click','.hapus_cart',function(){
			var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
			$.ajax({
				url : "<?php echo base_url();?>cart/hapus_cart",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>
</body>
</html>