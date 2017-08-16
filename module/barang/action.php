<?php
	session_start();
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
			'kolomOrder' => array(null, 'kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig', null, null),
			'kolomCari' => array('kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig'),
			'orderBy' => array('id' => 'asc'),
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
			$aksi = '<a role="button" class="btn btn-success" href="'.base_url.'index.php?m=barang&p=form&id='.$row["id"].'">Edit</a>';
			
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
			'recordsTotal' => recordTotal($koneksi, $config_db['tabel']),
			'recordsFiltered' => recordFilter($koneksi, $config_db),
			'data' => $data,
		);

		echo json_encode($output);
	}

	// fungsi action add
	function actionAdd($koneksi){
		$dataForm = isset($_POST['dataForm']) ? $_POST['dataForm'] : false;
		// $foto = $_FILES['fFoto']['name'];

		// pecah array dataForm
		$id_barang = $dataForm['fId_barang'];
		$id_warna = $dataForm['fId_warna'];
		$kd_barang = $dataForm['fKd_barang'];
		$namaBarang = $dataForm['fNama_barang'];
		$foto = $dataForm['fFoto'];
		$ket = $dataForm['fKet'];
		$hpp = $dataForm['fHpp'];
		$harga_pasar = $dataForm['fHarga_pasar'];
		$market_place = $dataForm['fHarga_market'];
		$harga_ig = $dataForm['fHarga_ig'];
		$stokAwal = $dataForm['fStokAwal'];

		// validasi inputan
			// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$id_barangError = $id_warnaError = $kd_warnaError = $namaBarangError = $fotoError = "";
			$ketError = $hppError = $harga_pasarError = $market_placeError = $harga_igError = $stokAwalError = "";
			$pesanError = $set_value = "";

			// inisialisasi pemanggilan fungsi validasi
			$valid_id_barang = validString("ID Barang", $id_barang, 1, 4, true);
			$valid_id_warna = validString("ID Warna", $id_warna, 1, 4, true);
			$valid_namaBarang = validString("Nama Barang", $namaBarang, 1, 50, true);
			// $valid_foto = validString("Foto", $foto, 1, 25, true);
			$valid_ket = validString("Keterangan", $ket, 1, 255, true);
			$valid_hpp = validAngka("HPP", $hpp, 1, 6, true);
			$valid_harga_pasar = validAngka("Harga Pasar", $harga_pasar, 1, 6, true);
			$valid_market_place = validAngka("Harga Market Place", $market_place, 1, 6, true);
			$valid_harga_ig = validAngka("Harga IG", $harga_ig, 1, 6, true);
			$valid_stokAwal = validAngka("Stok Awal", $stokAwal, 1, 4, true);

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
				$namaBarangError = $valid_namaBarang['error'];
			}

			// if(!$valid_foto['cek']){
			// 	$cek = false;
			// 	$fotoError = $valid_foto['error'];
			// }

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
				'namaBarangError' => $namaBarangError,
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
				'namaBarang' => $namaBarang,
				'foto' => $foto,
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
			$namaBarang = validInputan($namaBarang, false, false);
			// $foto = validInputan($foto, false, false);
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
				$tgl = date("Y-m-d");
				$query = "CALL tambah_barang(
					:id_barang, :id_warna, :namaBarang, :hpp, :harga_pasar, 
					:market_place, :harga_ig, :foto, :ket, :tgl, :stokAwal)";

				// prepare
				$statement = $koneksi->prepare($query);
				// bind
				$statement->bindParam(':id_barang', $id_barang);
				$statement->bindParam(':id_warna', $id_warna);
				$statement->bindParam(':namaBarang', $namaBarang);
				$statement->bindParam(':hpp', $hpp);
				$statement->bindParam(':harga_pasar', $harga_pasar);
				$statement->bindParam(':market_place', $market_place);
				$statement->bindParam(':harga_ig', $harga_ig);
				$statement->bindParam(':foto', $foto);
				$statement->bindParam(':ket', $ket);
				$statement->bindParam(':tgl', $tgl);
				$statement->bindParam(':stokAwal', $stokAwal);
				// execute
				$result = $statement->execute(
					array(
						':id_barang' => $id_barang,
						':id_warna' => $id_warna,
						':namaBarang' => $namaBarang,
						':hpp' => $hpp,
						':harga_pasar' => $harga_pasar,
						':market_place' => $market_place,
						':harga_ig' => $harga_ig,
						':foto' => $foto,
						':ket' => $ket,
						':tgl' => $tgl,
						':stokAwal' => $stokAwal,
					)
				);
				
				// jika query berhasil
				if($result){
					$status = true;
					$errorDb = false;
					$_SESSION['notif'] = "Tambah Data Berhasil";
				} 
				else{
					$status = false;
					$errorDb = true;
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
		$query = "SELECT $tabel.id, $tabel.id_barang, $tabel.id_warna, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, $tabel.nama, hpp, harga_pasar, market_place, harga_ig, foto, ket ";
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
		$dataForm = isset($_POST['dataForm']) ? $_POST['dataForm'] : false;

		// pecah array dataForm
		$id = $dataForm['id'];
		$id_barang = $dataForm['fId_barang'];
		$id_warna = $dataForm['fId_warna'];
		$kd_barang = $dataForm['fKd_barang'];
		$namaBarang = $dataForm['fNama_barang'];
		$foto = $dataForm['fFoto'];
		$ket = $dataForm['fKet'];
		$hpp = $dataForm['fHpp'];
		$harga_pasar = $dataForm['fHarga_pasar'];
		$market_place = $dataForm['fHarga_market'];
		$harga_ig = $dataForm['fHarga_ig'];
		$stokAwal = $dataForm['fStokAwal'];

		// validasi inputan
			// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$id_barangError = $id_warnaError = $kd_warnaError = $namaBarangError = $fotoError = "";
			$ketError = $hppError = $harga_pasarError = $market_placeError = $harga_igError = $stokAwalError = "";
			$pesanError = $set_value = "";

			// inisialisasi pemanggilan fungsi validasi
			$valid_id_barang = validString("ID Barang", $id_barang, 1, 4, true);
			$valid_id_warna = validString("ID Warna", $id_warna, 1, 4, true);
			$valid_namaBarang = validString("Nama Barang", $namaBarang, 1, 50, true);
			// $valid_foto = validString("Foto", $foto, 1, 25, true);
			$valid_ket = validString("Keterangan", $ket, 1, 255, true);
			$valid_hpp = validAngka("HPP", $hpp, 1, 6, true);
			$valid_harga_pasar = validAngka("Harga Pasar", $harga_pasar, 1, 6, true);
			$valid_market_place = validAngka("Harga Market Place", $market_place, 1, 6, true);
			$valid_harga_ig = validAngka("Harga IG", $harga_ig, 1, 6, true);
			// $valid_stokAwal = validAngka("Stok Awal", $stokAwal, 1, 4, true);

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
				$namaBarangError = $valid_namaBarang['error'];
			}

			// if(!$valid_foto['cek']){
			// 	$cek = false;
			// 	$fotoError = $valid_foto['error'];
			// }

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

			// if(!$valid_stokAwal['cek']){
			// 	$cek = false;
			// 	$stokAwalError = $valid_stokAwal['error'];
			// }

			$pesanError = array(
				'id_barangError' => $id_barangError,
				'id_warnaError' => $id_warnaError,
				'namaBarangError' => $namaBarangError,
				'fotoError' => $fotoError,
				'ketError' => $ketError,
				'hppError' => $hppError,
				'harga_pasarError' => $harga_pasarError,
				'market_placeError' => $market_placeError,
				'harga_igError' => $harga_igError,
				'stokAwalError' => "",
			);

			$set_value = array(
				'id_barang' => $id_barang,
				'id_warna' => $id_warna,
				'kd_barang' => $kd_barang,
				'namaBarang' => $namaBarang,
				'foto' => $foto,
				'ket' => $ket,
				'hpp' => $hpp,
				'harga_pasar' => $harga_pasar,
				'market_place' => $market_place,
				'harga_ig' => $harga_ig,
				'stokAwal' => "",
			);

		// ==================================== //

		if($cek){
			// $id_barang = validInputan($id_barang, false, false);
			// $id_warna = validInputan($id_warna, false, false);
			// $kd_barang = validInputan($kd_barang, false, false);
			$namaBarang = validInputan($namaBarang, false, false);
			$foto = validInputan($foto, false, false);
			$ket = validInputan($ket, false, false);
			$hpp = validInputan($hpp, false, false);
			$harga_pasar = validInputan($harga_pasar, false, false);
			$market_place = validInputan($market_place, false, false);
			$harga_ig = validInputan($harga_ig, false, false);
			// $stokAwal = validInputan($stokAwal, false, false);

			$tabel = "barang";
			$query = "UPDATE $tabel SET nama=:namaBarang, foto=:foto, ket=:ket, hpp=:hpp, harga_pasar=:harga_pasar, market_place=:market_place, harga_ig=:harga_ig WHERE id = :id";

			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':namaBarang', $namaBarang);
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
					':namaBarang' => $namaBarang,
					':hpp' => $hpp,
					':harga_pasar' => $harga_pasar,
					':market_place' => $market_place,
					':harga_ig' => $harga_ig,
					':foto' => $foto,
					':ket' => $ket,
					':id' => $id,
				)
			);
			
			// jika query berhasil
			if($result){
				$status = true;
				$errorDb = false;
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
