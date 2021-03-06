<?php

class Cart extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('cart_model');
	}

	function index(){
		$data['data']=$this->cart_model->get_all_produk();
		$this->load->view('header');
		$this->load->view('v_cart',$data);
		$this->load->view('footer');
	}

	function add_to_cart(){ //fungsi Add To Cart
		$data = array(
			'id' => $this->input->post('id'), 
			'name' => $this->input->post('nama_barang'), 
			'price' => $this->input->post('harga_barang'), 
			'qty' => $this->input->post('quantity'), 
		);
		$this->cart->insert($data);
		echo $this->show_cart(); //tampilkan cart setelah added
	}

	function show_cart(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='

				<tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Hapus</button></td>

				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>

			</tr>
			<tr>
				<th colspan="3">Bayar</th>
				<th colspan="2"><input type="text" placeholder="Rp."></th>

			</tr>
			<tr>
				<th colspan="2"><div class="col-md-4 harga">
					<a data-toggle="modal" href="#modal-id" class="kusus">
						<div class="kotak-harga">
							<div class="garis">
			  				
                    		<button type="button" class="btn btn-block btn-primary btn-lg">Hitung</button>
                  			</td>
			  				<h3 id="total" ></h3>
							</div>
						</div>
					</a>
				</div>
				</th>

			</tr>


			
		';
		return $output;
	}

	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function hapus_cart(){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
}