<?php
	// action
	date_default_timezone_set('Asia/Jakarta');
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "list";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{

		switch (strtolower($action)) {
			case 'list':
				listPengeluaran($koneksi);
				break;
			
			default:
				# code...
				break;
		}
	}


	// function list datatable (pengeluaran)
	function listPengeluaran($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'pengeluaran',
			'kolomOrder' => array(null, 'kd_pengeluaran', null, 'tgl','ket', null, null, 'total', 'jenis', null),
			'kolomCari' => array('kd_pengeluaran', 'tgl', 'total', 'jenis'),
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
			
			// cek jenis
			// jika jenis->NON PRODUKSI set tombol edit ke pengeluaran
			// jika jenis->PRODUKSI set tombol edit ke pembelian

			$aksi = '<a href="'.base_url.'index.php?m=pembelian&p=view" class="btn btn-sm btn-info btn-flat">
	                        Detail
	                 </a>';
			
			if($row['jenis']=='PRODUKSI'){
				$aksi .= '<a role="button" class="btn btn-sm btn-success btn-flat" href="'.base_url.'index.php?m=pembelian&p=form&id='.$row["id"].'">
							Edit
						</a>';
			}else{
				$aksi .= '<a role="button" class="btn btn-sm btn-success btn-flat" href="'.base_url.'index.php?m=pengeluaran&p=form&id='.$row["id"].'">
						Edit
					</a>';
			}
			

	        // agar keterangan kebawah
	        $tempKet = explode(', ',$row['ket']);
	        $ketRapih = implode('<br>', $tempKet);         

			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_pengeluaran'];
			$dataRow[] = $row['tgl'];
			$dataRow[] = $ketRapih;
			$dataRow[] = $row['total'];
			$dataRow[] = $row['jenis'];
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

?>