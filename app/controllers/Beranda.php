<?php
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	include_once("../models/Penjualan_model.php");
	include_once("../models/Pembelian_model.php");
	include_once("../models/Stok_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch ($action) {
			case 'get_panel_info':
				get_panel_info($koneksi);
				break;

			case 'get_chart_penjualan_laba':
				get_chart_penjualan_laba($koneksi);
				break;

			case 'get_panel_item':
				get_panel_item($koneksi);
				break;
			
			default:
				# code...
				break;
		}
	}

	function get_panel_info($koneksi){
		$date = array(
			'bulan' => date("m"),
			'tahun' => date("Y"),
		);

		// get data total transaksi penjualan bulan ini
		$get_penjualan = get_ket_penjualan($koneksi, $date, 'transaksi_penjualan');
		$data_penjualan = (empty($get_penjualan['total'])) ? 
			array(
				'total' => '0', 
				// 'bulan' => get_bulanIndo($date['bulan']), 
				// 'tahun' => $date['tahun'],
				'label' => 'Total Transaksi <br>Penjualan '.get_bulanIndo($date['bulan']).' '.$date['tahun'],
			)
			: 
			array(
				'total' => $get_penjualan['total'], 
				// 'bulan' => get_bulanIndo($get_penjualan['bulan']), 
				// 'tahun' => $get_penjualan['tahun'],
				'label' => 'Total Transaksi <br>Penjualan '.get_bulanIndo($get_penjualan['bulan']).' '.$get_penjualan['tahun'],
			);
		
		// get data total transaksi pembelian bulan ini
		$get_pembelian = get_ket_pembelian($koneksi, $date, 'transaksi_pembelian');
		$data_pembelian = (empty($get_pembelian['total'])) ? 
			array(
				'total' => '0',
				// 'bulan' => get_bulanIndo($date['bulan']), 
				// 'tahun' => $date['tahun'],
				'label' => 'Total Transaksi <br>Pembelian '.get_bulanIndo($date['bulan']).' '.$date['tahun'],
			) 
			: 
			array(
				'total' => $get_pembelian['total'], 
				// 'bulan' => get_bulanIndo($get_pembelian['bulan']), 
				// 'tahun' => $get_pembelian['tahun'],
				'label' => 'Total Transaksi <br>Pembelian '.get_bulanIndo($get_pembelian['bulan']).' '.$get_pembelian['tahun'],
			);

		// get data total item reject bulan ini
		// $get_reject = get_ket_reject($koneksi, $date, 'total_reject');
		// $data_reject = (!$get_reject || empty($get_reject)) ? "0" : rupiah($get_reject);

		// // get data total item return bulan ini
		// $get_return = get_ket_reject($koneksi, $date, 'total_return');
		// $data_return = (!$get_return || empty($get_return)) ? "0" : rupiah($get_return);

		$output = array(
			'panel_penjualan' => $data_penjualan,
			'panel_pembelian' => $data_pembelian,
			// 'panel_reject' => $data_reject,
			// 'panel_return' => $data_return,
		);

		echo json_encode($output);
	}

	function get_chart_penjualan_laba($koneksi){
		$tahun =  date("Y");
		$get_penjualan_laba = get_penjualan_laba($koneksi, $tahun);
		$label = $total_penjualan = $total_laba = array();
		foreach($get_penjualan_laba as $value){
			$label[] = get_bulanIndo($value['bulan']);
			$total_penjualan[] = $value['total_penjualan'];
			$total_laba[] = $value['total_laba'];
		}

		$output = array(
			'labels' => $label,
			'datasets' => array(
					array(
						"data" => $total_penjualan,
						"label" => "Penjualan",
						"borderColor" => "#3e95cd",
						"backgroundColor" => "#3e95cd",
						"fill" => false,
					),
					array(
						"data" => $total_laba,
						"label" => "Laba",
						"borderColor" => "#8e5ea2",
						"backgroundColor" => "#8e5ea2",
						"fill" => false,
					),
				),
		);

		echo json_encode($output);
	}
	
	function get_panel_item($koneksi){
		$date = array(
			'bulan' => date("m"),
			'tahun' => date("Y"),
		);
		$get_item_terlaris = get_ket_penjualan_item($koneksi, $date, 'DESC', 5);
		$data_item_terlaris = array();
		$no_urut = 0;
		foreach($get_item_terlaris as $value){
			$no_urut++;
			$dataRow = array();
			$dataRow['no_urut'] = $no_urut;
			$dataRow['kd_barang'] = $value['kd_barang'];
			$dataRow['kode_barang'] = $value['kode_barang'];
			$dataRow['nama'] = $value['nama'];
			$dataRow['total'] = $value['total'];

			$data_item_terlaris[] = $dataRow;
		}

		$get_item_kurang_laku = get_ket_penjualan_item($koneksi, $date, 'ASC', 5);
		$data_item_kurang_laku = array();
		$no_urut = 0;
		foreach($get_item_kurang_laku as $value){
			$no_urut++;
			$dataRow = array();
			$dataRow['no_urut'] = $no_urut;
			$dataRow['kd_barang'] = $value['kd_barang'];
			$dataRow['kode_barang'] = $value['kode_barang'];
			$dataRow['nama'] = $value['nama'];
			$dataRow['total'] = $value['total'];

			$data_item_kurang_laku[] = $dataRow;
		}


		$output = array(
			'terlaris' => $data_item_terlaris,
			'kurang_laku' => $data_item_kurang_laku,
			// 'bulan' => get_bulanIndo($date['bulan']), 
			// 'tahun' => $date['tahun'],
		);

		echo json_encode($output);
	}