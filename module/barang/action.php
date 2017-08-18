<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

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
				list_Barang($koneksi); // list datatable
				break;

			case 'tambah':
				actionAdd($koneksi); // aksi tambah
				break;

			case 'getedit':
				// get data untuk edit
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getEdit($koneksi, $id);
				break;

			case 'edit':
				actionEdit($koneksi); // aksi edit
				break;

			case 'edit_foto':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				edit_foto($koneksi, $id);
				break;

			case 'getview':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getView($koneksi, $id);
				break;

			case 'liststok':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				list_BarangStok($koneksi, $id);
				break;

			case 'getselect':
				// aksi set select dinamis
				$select = isset($_POST['select']) ? $_POST['select'] : false;
				getSelect($koneksi, $select);
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
			'tabel' => 'v_barang',
			'kolomOrder' => array(null, 'kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig', null, 'stok', null),
			'kolomCari' => array('kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig', 'stok'),
			'orderBy' => array('id' => 'asc'),
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
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=barang&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=barang&p=form&id='.$row["id"].'">Edit</a>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_barang'];
			$dataRow[] = $row['nama'];
			$dataRow[] = $row['hpp'];
			$dataRow[] = $row['harga_pasar'];
			$dataRow[] = $row['market_place'];
			$dataRow[] = $row['harga_ig'];
			$dataRow[] = $row['ket'];
			$dataRow[] = $row['stok'];
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

	// fungsi action add
	function actionAdd($koneksi){
		$id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : "";
		$id_warna = isset($_POST['id_warna']) ? $_POST['id_warna'] : "";
		$kd_barang = isset($_POST['kd_barang']) ? $_POST['kd_barang'] : "";
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		$foto = isset($_FILES['foto']) ? $_FILES['foto'] : "";
		$ket = isset($_POST['ket']) ? $_POST['ket'] : "";
		$hpp = isset($_POST['hpp']) ? $_POST['hpp'] : "";
		$harga_pasar = isset($_POST['harga_pasar']) ? $_POST['harga_pasar'] : "";
		$market_place = isset($_POST['market_place']) ? $_POST['market_place'] : "";
		$harga_ig = isset($_POST['harga_ig']) ? $_POST['harga_ig'] : "";
		$stokAwal = isset($_POST['stokAwal']) ? $_POST['stokAwal'] : "";

		// validasi inputan
			// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$id_barangError = $id_warnaError = $kd_warnaError = $namaError = $fotoError = "";
			$ketError = $hppError = $harga_pasarError = $market_placeError = $harga_igError = $stokAwalError = "";
			$pesanError = $set_value = "";

			// inisialisasi pemanggilan fungsi validasi
			$valid_id_barang = validString("ID Barang", $id_barang, 1, 4, true);
			$valid_id_warna = validString("ID Warna", $id_warna, 1, 4, true);
			$valid_namaBarang = validString("Nama Barang", $nama, 1, 50, true);
			$valid_ket = validString("Keterangan", $ket, 1, 255, true);
			$valid_hpp = validAngka("HPP", $hpp, 1, 1000000, true);
			$valid_harga_pasar = validAngka("Harga Pasar", $harga_pasar, 1, 1000000, true);
			$valid_market_place = validAngka("Harga Market Place", $market_place, 1, 1000000, true);
			$valid_harga_ig = validAngka("Harga IG", $harga_ig, 1, 1000000, true);
			$valid_stokAwal = validAngka("Stok Awal", $stokAwal, 1, 10000, true);

			// jika terdeteksi ada input foto
			if($foto){
				$configFoto = array(
					'error' => $foto['error'],
					'size' => $foto['size'],
					'name' => $foto['name'],
					'tmp_name' => $foto['tmp_name'],
					'max' => 2*1048576,
					// 'path' => "../../assets/gambar/",
				);
				$valid_foto = validFoto($configFoto);
				if(!$valid_foto['cek']){
					$cek = false;
					$fotoError = $valid_foto['error'];
				}
				else $valueFoto = $valid_foto['namaFile'];
			}
			else $valueFoto = "";

			// cek valid
			if(!$valid_id_barang['cek']){
				$cek = false;
				$id_barangError = $valid_id_barang['error'];
			}

			if(!$valid_id_warna['cek']){
				$cek = false;
				$id_warnaError = $valid_id_warna['error'];
			}

			if(!$valid_namaBarang['cek']){
				$cek = false;
				$namaError = $valid_namaBarang['error'];
			}

			if(!$valid_ket['cek']){
				$cek = false;
				$ketError = $valid_ket['error'];
			}

			if(!$valid_hpp['cek']){
				$cek = false;
				$hppError = $valid_hpp['error'];
			}

			if(!$valid_harga_pasar['cek']){
				$cek = false;
				$harga_pasarError = $valid_harga_pasar['error'];
			}

			if(!$valid_market_place['cek']){
				$cek = false;
				$market_placeError = $valid_market_place['error'];
			}

			if(!$valid_harga_ig['cek']){
				$cek = false;
				$harga_igError = $valid_harga_ig['error'];
			}

			if(!$valid_stokAwal['cek']){
				$cek = false;
				$stokAwalError = $valid_stokAwal['error'];
			}

			$pesanError = array(
				'id_barangError' => $id_barangError,
				'id_warnaError' => $id_warnaError,
				'namaError' => $namaError,
				'fotoError' => $fotoError,
				'ketError' => $ketError,
				'hppError' => $hppError,
				'harga_pasarError' => $harga_pasarError,
				'market_placeError' => $market_placeError,
				'harga_igError' => $harga_igError,
				'stokAwalError' => $stokAwalError,
			);

			$set_value = array(
				'id_barang' => $id_barang,
				'id_warna' => $id_warna,
				'kd_barang' => $kd_barang,
				'nama' => $nama,
				'ket' => $ket,
				'hpp' => $hpp,
				'harga_pasar' => $harga_pasar,
				'market_place' => $market_place,
				'harga_ig' => $harga_ig,
				'stokAwal' => $stokAwal,
			);

		// ==================================== //
		if($cek){
			$id_barang = validInputan($id_barang, false, false);
			$id_warna = validInputan($id_warna, false, false);
			$kd_barang = validInputan($kd_barang, false, false);
			$nama = validInputan($nama, false, false);
			$ket = validInputan($ket, false, false);
			$hpp = validInputan($hpp, false, false);
			$harga_pasar = validInputan($harga_pasar, false, false);
			$market_place = validInputan($market_place, false, false);
			$harga_ig = validInputan($harga_ig, false, false);
			$stokAwal = validInputan($stokAwal, false, false);

			// cek duplikat id barang
			$config_duplikat = array(
				'tabel' => 'v_barang',
				'field' => 'kd_barang',
				'value' => $kd_barang,
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = false;
				$errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				// upload foto
				$path = "../../assets/gambar/$valueFoto";
				if(!move_uploaded_file($foto['tmp_name'], $path)){
					$pesanError['fotoError'] = "Upload Foto Gagal";
					$status = false;
					$errorDb = false;
					$duplikat = false;
				}
				else{
					$tgl = date("Y-m-d");
					$query = "CALL tambah_barang(
						:id_barang, :id_warna, :nama, :hpp, :harga_pasar, 
						:market_place, :harga_ig, :foto, :ket, :tgl, :stokAwal)";

					// prepare
					$statement = $koneksi->prepare($query);
					// bind
					$statement->bindParam(':id_barang', $id_barang);
					$statement->bindParam(':id_warna', $id_warna);
					$statement->bindParam(':nama', $nama);
					$statement->bindParam(':hpp', $hpp);
					$statement->bindParam(':harga_pasar', $harga_pasar);
					$statement->bindParam(':market_place', $market_place);
					$statement->bindParam(':harga_ig', $harga_ig);
					$statement->bindParam(':foto', $valueFoto);
					$statement->bindParam(':ket', $ket);
					$statement->bindParam(':tgl', $tgl);
					$statement->bindParam(':stokAwal', $stokAwal);
					// execute
					$result = $statement->execute(
						array(
							':id_barang' => $id_barang,
							':id_warna' => $id_warna,
							':nama' => $nama,
							':hpp' => $hpp,
							':harga_pasar' => $harga_pasar,
							':market_place' => $market_place,
							':harga_ig' => $harga_ig,
							':foto' => $valueFoto,
							':ket' => $ket,
							':tgl' => $tgl,
							':stokAwal' => $stokAwal,
						)
					);
					
					// jika query berhasil
					if($result){
						$status = true;
						$errorDb = false;
						session_start();
						$_SESSION['notif'] = "Tambah Data Berhasil";
					} 
					else{
						$status = false;
						$errorDb = true;
					}
				}	
			}
		}
		else $status = false;

		// output lempar ke client
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);

		echo json_encode($output);
	}

	// fungsi get data edit
	function getEdit($koneksi, $id){
		// $id = "11";
		$tabel = "barang";
		// query
		$query = "SELECT $tabel.id, $tabel.id_barang, ib.id_barang id_idBarang, ib.nama nama_idBarang, $tabel.id_warna, iw.id_warna id_idWarna, iw.nama nama_idWarna, ";
		$query .= "concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, $tabel.nama, hpp, harga_pasar, market_place, harga_ig, foto, ket ";
		$query .= "FROM $tabel JOIN id_barang ib ON ib.id = $tabel.id_barang ";
		$query .= "JOIN id_warna iw ON iw.id = $tabel.id_warna ";
		$query .= "WHERE $tabel.id = :id";

		// prepare
		$statement = $koneksi->prepare($query);
		// bind
		$statement->bindParam(':id', $id);
		// execute
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		if(!$result) $_SESSION['notif'] = "gagal";

		echo json_encode($result);
	}

	// fungsi action edit
	function actionEdit($koneksi){
		$id = isset($_POST['id']) ? $_POST['id'] : false;
		$id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : "";
		$id_warna = isset($_POST['id_warna']) ? $_POST['id_warna'] : "";
		$kd_barang = isset($_POST['kd_barang']) ? $_POST['kd_barang'] : "";
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		$ket = isset($_POST['ket']) ? $_POST['ket'] : "";
		$hpp = isset($_POST['hpp']) ? $_POST['hpp'] : "";
		$harga_pasar = isset($_POST['harga_pasar']) ? $_POST['harga_pasar'] : "";
		$market_place = isset($_POST['market_place']) ? $_POST['market_place'] : "";
		$harga_ig = isset($_POST['harga_ig']) ? $_POST['harga_ig'] : "";

		// validasi inputan
			// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$id_barangError = $id_warnaError = $kd_warnaError = $namaError = $fotoError = "";
			$ketError = $hppError = $harga_pasarError = $market_placeError = $harga_igError = $stokAwalError = "";
			$pesanError = $set_value = "";

			// inisialisasi pemanggilan fungsi validasi
			$valid_id_barang = validString("ID Barang", $id_barang, 1, 4, true);
			$valid_id_warna = validString("ID Warna", $id_warna, 1, 4, true);
			$valid_namaBarang = validString("Nama Barang", $nama, 1, 50, true);
			$valid_ket = validString("Keterangan", $ket, 1, 255, true);
			$valid_hpp = validAngka("HPP", $hpp, 1, 1000000, true);
			$valid_harga_pasar = validAngka("Harga Pasar", $harga_pasar, 1, 1000000, true);
			$valid_market_place = validAngka("Harga Market Place", $market_place, 1, 1000000, true);
			$valid_harga_ig = validAngka("Harga IG", $harga_ig, 1, 1000000, true);

			// cek valid
			if(!$valid_id_barang['cek']){
				$cek = false;
				$id_barangError = $valid_id_barang['error'];
			}

			if(!$valid_id_warna['cek']){
				$cek = false;
				$id_warnaError = $valid_id_warna['error'];
			}

			if(!$valid_namaBarang['cek']){
				$cek = false;
				$namaError = $valid_namaBarang['error'];
			}

			if(!$valid_ket['cek']){
				$cek = false;
				$ketError = $valid_ket['error'];
			}

			if(!$valid_hpp['cek']){
				$cek = false;
				$hppError = $valid_hpp['error'];
			}

			if(!$valid_harga_pasar['cek']){
				$cek = false;
				$harga_pasarError = $valid_harga_pasar['error'];
			}

			if(!$valid_market_place['cek']){
				$cek = false;
				$market_placeError = $valid_market_place['error'];
			}

			if(!$valid_harga_ig['cek']){
				$cek = false;
				$harga_igError = $valid_harga_ig['error'];
			}

			$pesanError = array(
				'id_barangError' => $id_barangError,
				'id_warnaError' => $id_warnaError,
				'namaError' => $namaError,
				'ketError' => $ketError,
				'hppError' => $hppError,
				'harga_pasarError' => $harga_pasarError,
				'market_placeError' => $market_placeError,
				'harga_igError' => $harga_igError,
			);

			$set_value = array(
				'id_barang' => $id_barang,
				'id_warna' => $id_warna,
				'kd_barang' => $kd_barang,
				'nama' => $nama,
				'ket' => $ket,
				'hpp' => $hpp,
				'harga_pasar' => $harga_pasar,
				'market_place' => $market_place,
				'harga_ig' => $harga_ig,
			);

		// ==================================== //

		if($cek){
			$id = validInputan($id, false, false);
			// $id_barang = validInputan($id_barang, false, false);
			// $id_warna = validInputan($id_warna, false, false);
			// $kd_barang = validInputan($kd_barang, false, false);
			$nama = validInputan($nama, false, false);
			$ket = validInputan($ket, false, false);
			$hpp = validInputan($hpp, false, false);
			$harga_pasar = validInputan($harga_pasar, false, false);
			$market_place = validInputan($market_place, false, false);
			$harga_ig = validInputan($harga_ig, false, false);
			// $stokAwal = validInputan($stokAwal, false, false);

			$tabel = "barang";
			$query = "UPDATE $tabel SET nama=:nama, ket=:ket, hpp=:hpp, harga_pasar=:harga_pasar, market_place=:market_place, harga_ig=:harga_ig WHERE id = :id";

			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':nama', $nama);
			$statement->bindParam(':hpp', $hpp);
			$statement->bindParam(':harga_pasar', $harga_pasar);
			$statement->bindParam(':market_place', $market_place);
			$statement->bindParam(':harga_ig', $harga_ig);
			$statement->bindParam(':foto', $foto);
			$statement->bindParam(':ket', $ket);
			$statement->bindParam(':id', $id);
			// execute
			$result = $statement->execute(
				array(
					':nama' => $nama,
					':hpp' => $hpp,
					':harga_pasar' => $harga_pasar,
					':market_place' => $market_place,
					':harga_ig' => $harga_ig,
					':ket' => $ket,
					':id' => $id,
				)
			);
			
			// jika query berhasil
			if($result){
				$status = true;
				$errorDb = false;
				session_start();
				$_SESSION['notif'] = "Edit Data Berhasil";
			} 
			else{
				$status = false;
				$errorDb = true;
			}
		}
		else $status = false;

		// output lempar ke client
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);

		echo json_encode($output);
	}

	// fungso edit foto
	function edit_foto($koneksi, $id){

	}

	// fungsi get view
	function getView($koneksi, $id){
		// get data barang
		$queryBarang = "SELECT * FROM v_barang WHERE id = :id";


	}

	// function list stok barang
	function list_BarangStok($koneksi, $id){
		// get data stok
		$config_db = array(
			'tabel' => 'stok',
			'kolomOrder' => array(null, 'tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir'),
			'kolomCari' => array('tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir'),
			'orderBy' => array('id' => 'desc'),
			'kondisi' => "WHERE kd_barang = $id",
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

			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['tgl'];
			$dataRow[] = $row['stok_awal'];
			$dataRow[] = $row['brg_masuk'];
			$dataRow[] = $row['brg_keluar'];
			$dataRow[] = $row['stok_akhir'];

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

	// fungsi get data select
	function getSelect($koneksi, $select){
		$query = "SELECT id, $select, nama FROM $select";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();

		echo json_encode($result);
	}
