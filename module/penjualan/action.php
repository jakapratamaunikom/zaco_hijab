<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../../function/helper.php");
	include_once("../../function/koneksi.php");
	include_once("../../function/validasi_form.php");
	include_once("../../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_Barang($koneksi); // list datatable
				break;

			// case 'tambah':
			// 	actionAdd($koneksi); // aksi tambah
			// 	break;

			// case 'getedit':
			// 	// get data untuk edit
			// 	$id = isset($_POST['id']) ? $_POST['id'] : false;
			// 	getEdit($koneksi, $id);
			// 	break;

			// case 'edit':
			// 	actionEdit($koneksi); // aksi edit
			// 	break;

			// case 'getselect':
			// 	// aksi set select dinamis
			// 	$select = isset($_POST['select']) ? $_POST['select'] : false;
			// 	getSelect($koneksi, $select);
			// 	break;
			case 'addlist':
				validList($koneksi);
				break;

			case 'getkdpenjualan':
				getKdPenjualan($koneksi);
				break;
			
			case 'getselect':
				getSelect($koneksi);
				break;

			default:
				die();
				break;
		}
	}

	// function list datatable (server-side)
	function list_Barang($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_penjualan',
			'kolomOrder' => array(null, 'kd_penjualan', 'tgl', 'jenis', 'item', 'total', 'status', null, null),
			'kolomCari' => array('kd_penjualan', 'tgl', 'jenis', 'item', 'total', 'status'),
			'orderBy' => array('id' => 'desc'),
			'kondisi' => false,
		);

		// panggil fungsi get datatable
		$query = get_dataTable($config_db);

		// persiapkan eksekusi query
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($result as $row){
			$no_urut++;
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=penjualan&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=penjualan&p=form&id='.$row["id"].'">Edit</a>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_penjualan'];
			$dataRow[] = cetakTgl($row['tgl'],"full");
			$dataRow[] = $row['jenis'];
			$dataRow[] = cetakListItem($row['item']);
			$dataRow[] = rupiah($row['total']);
			$dataRow[] = $row['status'];
			$dataRow[] = $row['ket'];
			$dataRow[] = $aksi;

			$data[] = $dataRow;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => recordTotal($koneksi, $config_db),
			'recordsFiltered' => recordFilter($koneksi, $config_db),
			'data' => $data,
		);

		echo json_encode($output);
	}

	// fungsi tambah data
	function actionAdd($koneksi){
		
	}

	// fungsi validasi list item
	function validList($koneksi){
		$data = isset($_POST['data']) ? $_POST['data'] : false;
		$jenis = isset($_POST['jenis']) ? $_POST['jenis'] : false;

		// pecah array
		$kd_barang = $data['kd_barang'];
		$qty = $data['qty'];
		$jenisDiskon = $data['jenisDiskon'];
		$diskon = $data['diskon'];
		
		$cek = true;
		$status = false;
		$jenisError = $kd_barangError = $qtyError = $diskonError = "";
		$pesanError = "";

		// get harga, dan stok barang
		$ketBarang = getKetBarang($koneksi, $kd_barang);

		$maxDiskon = $jenisDiskon === "p" ? 100 : 999999;

		$validKd_barang = validAngka('Barang',$kd_barang,1,99999,true);
		$validQty = validAngka('Qty',$qty,1,$ketBarang['stok'],true);
		$validDiskon = validAngka('Diskon',$diskon,0,$maxDiskon,false);
		$validJenis = validHuruf("Jenis Transaksi",$jenis,1,50,true);

		// cek valid
		if(!$validJenis['cek']){
			$cek = false;
			$jenisError = $validJenis['error'];
		}

		if(!$validKd_barang['cek']){
			$cek = false;
			$kd_barangError = $validKd_barang['error'];
		}

		if(!$validQty['cek']){
			$cek = false;
			$qtyError = $validQty['error'];
		}

		if(!$validDiskon['cek']){
			$cek = false;
			$diskonError = $validDiskon['error'];
		}

		$pesanError = array(
			'jenisError' => $jenisError,
			'kd_barangError' => $kd_barangError,
			'qtyError' => $qtyError,
			'diskonError' => $diskonError, 
		);

		if($cek) $status = true;

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError,
			'harga' => $ketBarang, 
		);

		echo json_encode($output);
	}

	function getKdPenjualan($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_penjualan FROM penjualan WHERE kd_penjualan LIKE '%".$kode."%' ORDER BY kd_penjualan desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		echo json_encode($result);
	}

	function getKetBarang($koneksi, $id){
		$query = "SELECT hpp, harga_pasar, market_place, harga_ig, stok FROM v_barang WHERE id=:id";

		// prepare
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		// execute
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	// fungsi get data select
	function getSelect($koneksi){
		$query = "SELECT id, nama, stok FROM v_barang";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();

		echo json_encode($result);
	}
?>