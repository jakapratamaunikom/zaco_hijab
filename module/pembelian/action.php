<?php
	// action

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	// Load semua fungsi yang dibutuhkan
	include_once("../../function/helper.php");
	include_once("../../function/koneksi.php");
	include_once("../../function/validasi_form.php");
	include_once("../../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "list";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{

		switch (strtolower($action)) {
			case 'list':
				list_Barang($koneksi);
				break;

			case 'tambah':
				actionAdd($koneksi);
				break;

			case 'getedit':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				break;

			case 'edit':
				getEdit($koneksi, $id);
				break;

			case 'getselect':
				$select = isset($_POST['select']) ? $_POST['select'] : false;
				getSelect($koneksi);
				break;

			case 'getkdpembelian':
				getKdPembelian($koneksi);
				break;

			case 'addlist':
				validList();
				break;
			
			default:
				# code...
				break;
		}
	}

	// function list datatable (server-side)
	function list_Barang($koneksi){
		
	}

	// fungsi action add
	function actionAdd($koneksi){
		$dataForm = isset($_POST['dataPembelian']) ? $_POST['dataPembelian'] : false;

		$kd_pembelian = $dataForm['kd_pembelian'];
		$tgl = $dataForm['tgl'];
		$listBarang = $dataForm['listBarang'];

		$status = true;
		$errorDb = false;

		

		// tambah ke tabel pembelian (dummy ket,username)
		$query = "INSERT INTO pembelian(kd_pembelian, tgl, ket, username) VALUES(:kd_pembelian, :tgl, '-', 'admin');";
		// prepare
		$statement = $koneksi->prepare($query);
		// bind
		$statement->bindParam(':kd_pembelian', $kd_pembelian);
		$statement->bindParam(':tgl', $tgl);

		// execute
		$result = $statement->execute(
			array(
				':kd_pembelian' => $kd_pembelian,
				':tgl' => $tgl,
			)
		);

		
		// jika sukses eksekusi tambah pembelian
		// tambah detail pembelian
		if($result){

			// insert data ke detail pembelian
			for($i=0;$i<sizeOf($listBarang);$i++){

				$harga = $listBarang[$i]['harga'] / $listBarang[$i]['qty'];

				$query = "CALL tambah_pembelian(:kd_pembelian, :tgl, :kd_barang, :harga, :qty, :subtotal, :ket)";
				// prepare
				$statement = $koneksi->prepare($query);

				$statement->bindParam(':kd_pembelian', $kd_pembelian);
				$statement->bindParam(':tgl', $tgl);
				$statement->bindParam(':kd_barang', $listBarang[$i]['kd_barang']);
				$statement->bindParam(':harga', $harga);
				$statement->bindParam(':qty', $listBarang[$i]['qty']);
				$statement->bindParam(':subtotal', $listBarang[$i]['harga']);
				$statement->bindParam(':ket', $listBarang[$i]['ket']);

				$result = $statement->execute(
					array(
						':kd_pembelian' => $kd_pembelian,
						':tgl' => $tgl,
						':kd_barang' => $listBarang[$i]['kd_barang'],
						':harga' => $harga,
						':qty' => $listBarang[$i]['qty'],
						':subtotal' => $listBarang[$i]['harga'],
						':ket' => $listBarang[$i]['ket'],
					)
				);

				// jika terdapat error saat eksekusi
				// keluar dari iterasi
				if(!$result){
					$errorDb = true;
					$status = false;
					break;
				}
			}

			// jika tidak ada error saat penambahan detail
			// tambah data ke tabel pengeluaran
			if(!$errorDb){
				$kd_pengeluaran = getKdPengeluaran($koneksi);
				$query = "CALL tambah_pengeluaran_pembelian(:kd_pengeluaran,:kd_pembelian, :tgl, 'admin');";
				// prepare
				$statement = $koneksi->prepare($query);

				$statement->bindParam(':kd_pengeluaran', $kd_pengeluaran);
				$statement->bindParam(':kd_pembelian', $kd_pembelian);
				$statement->bindParam(':tgl', $tgl);

				$result = $statement->execute(
					array(
						':kd_pengeluaran' => $kd_pengeluaran,
						':kd_pembelian' => $kd_pembelian,
						':tgl' => $tgl,
					)
				);

				if(!$result){
					$errorDb = true;
					$status = false;
				}
			}


		}else{
			$status = false;
			$errorDb = true;
		}

		$output = array(
			'status' => $status,
			'errorDb' => $errorDb, 
		);

		echo json_encode($output);

	}

	// fungsi get data edit
	function getEdit($koneksi, $id){
	}

	// fungsi action edit
	function actionEdit($koneksi){
	}

	// fungsi get data select
	function getSelect($koneksi){
		$query = "SELECT id, nama FROM barang";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();

		echo json_encode($result);
	}

	// mendapatkan kode pembelian terakhir pada hari ini
	function getKdPembelian($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_pembelian FROM pembelian WHERE kd_pembelian LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		echo json_encode($result);
	}

	// mendapatkan kode pengeluaran terakhir pada hari ini (internal)
	function getKdPengeluaran($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_pengeluaran FROM pengeluaran WHERE kd_pengeluaran LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetch();
		
		$kd_pengeluaran = "";
		if(empty($result)){
			$kd_pengeluaran = 'PG-'.$kode.'-1';
		}else{
			$iterasi = explode("-", $result['kd_pengeluaran']);
			// var_dump($iterasi);
			$count = $iterasi[2] + 1;
			$kd_pengeluaran = $kd_pengeluaran = 'PG-'.$kode.'-'.$count;
		}
		
		return $kd_pengeluaran;
	}

	//cek validasi pada saat menambahkan list
	function validList(){
		$dataForm = isset($_POST['dataForm']) ? $_POST['dataForm'] : false;

		$kd_barang = $dataForm['kd_barang']; 
		$qty = $dataForm['qty']; 
		$harga = $dataForm['harga']; 

		$cek = true;
		$status = false;
		$kd_barangError = $qtyError = $hargaError = "";
		$pesanError = "";


		$validKd_barang = validString('Barang',$kd_barang,1,5,true);
		$validQty = validAngka('Qty',$qty,1,6,true);
		$validHarga = validAngka('Harga',$harga,1,10,true);

		// cek valid
		if(!$validKd_barang['cek']){
			$cek = false;
			$kd_barangError = $validKd_barang['error'];
		}

		if(!$validQty['cek']){
			$cek = false;
			$qtyError = $validQty['error'];
		}

		if(!$validHarga['cek']){
			$cek = false;
			$hargaError = $validHarga['error'];
		}

		$pesanError = array(
			'kd_barangError' => $kd_barangError,
			'qtyError' => $qtyError,
			'hargaError' => $hargaError, 
		);

		if($cek){
			$status = true;
		}

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError 
		);

		echo json_encode($output);
	}



?>