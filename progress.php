<?php
	
	$progress = array(
		'module' => array(
			// menu id_barang
			'id_barang' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => 'Tambah data menggunakan popup modals dengan Ajax',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// edit data
					'edit' => array(
						'keterangan' => 'Edit data menggunakan popup modals dengan Ajax',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// view list / tabel
					'list' => array(
						'keterangan' => 'List data dengan dataTable ServerSide',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// import data
					'import_excel' => array(
						'keterangan' => 'Import semua data ke format excel',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
					'import_pdf' => array(
						'keterangan' => 'Import semua data ke format pdf',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
				),
				// persentase total satu modul
				'persentase' => '60%',
			),
			// menu id_warna
			'id_warna' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => 'Tambah data menggunakan popup modals dengan Ajax',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// edit data
					'edit' => array(
						'keterangan' => 'Edit data menggunakan popup modals dengan Ajax',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// view list / tabel
					'list' => array(
						'keterangan' => 'List data dengan dataTable ServerSide',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// import data
					'import_excel' => array(
						'keterangan' => 'Import semua data ke format excel',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
					'import_pdf' => array(
						'keterangan' => 'Import semua data ke format pdf',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
				// persentase total satu modul
				'persentase' => '60%',
			),
			// menu barang
			'barang' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => 'Tambah data dengan form baru',
						'catatan' => 'Data barang baru beserta inputan upload foto dan stok awal',
						'bug' => array(
							'Jika menambah foto dengan foto yang pernah diupload sebelumnya, foto tersebut akan dianggap sama dengan foto sebelumnya'
						),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// edit data
					'edit' => array(
						'keterangan' => 'Edit Data dengan form baru',
						'catatan' => 'Inputan upload foto dan stok awal tidak dilampirkan',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// edit foto
					'edit_foto' => array(
						'keterangan' => 'Edit Foto dengan popup modals',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// hapus foto
					'hapus_foto' => array(
						'keterangan' => 'Hapus foto lama',
						'catatan' => '',
						'bug' => array(),
						'status' => 'FINISH',
						'persentase' => '100%',
					),
					// view data satuan
					'view' => array(
						'keterangan' => 'View Data dengan view baru',
						'catatan' => 'View data barang secara satuan, menampilkan semua data barang yang bersangkutan, dari data barang, foto, dan data stok barang yang bersangkutan',
						'status' => 'FINISH',
						'bug' => array(),
						'persentase' => '100%',
					),
					// view list / tabel
					'list' => array(
						'keterangan' => 'List data dengan dataTable ServerSide',
						'catatan' => 'Terdapat aksi view | edit | edit status',
						'bug' => array(
							'edit status masih belum bisa'
						),
						'status' => 'ON PROGRESS',
						'persentase' => '90%',
					),
					// edit status barang (aktif/tidak aktif)
					'status_barang' => array(
						'keterangan' => 'Edit Status barang',
						'catatan' => 'Untuk mengubah status barang, yang bersangkutan dengan penjualan dan pembelian, jadi hanya untuk menampilkan barang yang aktif saja',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
					// import data
					'import_excel' => array(
						'keterangan' => 'Import semua data atau data salah satu barang ke format excel',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
					'import_pdf' => array(
						'keterangan' => 'Import semua data atau data salah satu barang ke format pdf',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
				),
				// persentase total satu modul
				'persentase' => '65.5%',
			),
			// menu penjualan
			'penjualan' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => 'Tambah data dengan form baru',
						'catatan' => 'Terdapat button generate pdf secara langsung',
						'status' => 'ON PROGRESS',
						'bug' => array(
							'Jika field status transaksi di set free, saat penambahan item list, persentase berubah menjadi 0% lagi, tidak terkunci 100%',
							'Jenis transaksi dapat diedit sesuka hati, jadi harga barang dapat dimanupalasi',
							'Pesan error dan set value belum muncul saat ada kesalahan',
						),
						'persentase' => '75%',
					),
					// edit data
					'edit' => array(
						'keterangan' => 'Edit data dengan form baru',
						'catatan' => 'Jika tanggal di invoice berbeda dengan tanggal saat melakukan edit, maka aksi edit untuk mengganti barang dan atau qty suatu barang tidak bisa dilakukan',
						'status' => 'ON PROGRESS',
						'bug' => array(
							'Hapus item di list masih error',
							'disable button aksi dan filed di list item belum sempurna',
							'Pesan error dan set value belum muncul saat ada kesalahan',
						),
						'persentase' => '60%',
					),
					// view data satuan
					'view' => array(
						'keterangan' => 'View data berupa tampilan seperti invoice',
						'catatan' => 'terdapat aksi reject/return',
						'status' => 'ON PROGRESS',
						'bug' => array(),
						'persentase' => '40%',
					),
					// view list / tabel
					'list' => array(
						'keterangan' => 'View data berupa tabel',
						'catatan' => 'Terdapat aksi, view | edit | cetak',
						'status' => 'ON PROGRESS',
						'bug' => array(
							'fungsi cetak belum bisa'
						),
						'persentase' => '80%',
					),
					// import data
					'import_excel' => array(
						'keterangan' => 'Import semua data atau data salah satu barang ke format excel',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
					'import_pdf' => array(
						'keterangan' => 'Import semua data atau data salah satu barang ke format pdf',
						'catatan' => 'Belum dikerjakan',
						'bug' => array(),
						'status' => 'PENDING',
						'persentase' => '0%',
					),
				),
				// persentase total satu modul
				'persentase' => '42.5%',
			),
			// menu reject
			'reject' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// edit data
					'edit' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view data satuan
					'view' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view list / tabel
					'list' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
				),
				// persentase total satu modul
				'persentase' => ,
			),
			// menu pembelian
			'pembelian' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// edit data
					'edit' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view data satuan
					'view' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view list / tabel
					'list' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
				),
				// persentase total satu modul
				'persentase' => ,
			),
			// menu pengeluaran
			'pengeluaran' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// edit data
					'edit' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view data satuan
					'view' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view list / tabel
					'list' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
				),
				// persentase total satu modul
				'persentase' => ,
			),
			// menu admin
			'admin' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// edit data
					'edit' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view data satuan
					'view' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view list / tabel
					'list' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
				),
				// persentase total satu modul
				'persentase' => ,
			),
			// menu beranda
			'beranda' => array(
				'fitur' => array(
					// tambah data
					'tambah' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// edit data
					'edit' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view data satuan
					'view' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
					// view list / tabel
					'list' => array(
						'keterangan' => ,
						'catatan' => ,
						'status' => ,
						'bug' => array(),
						'persentase' => ,
					),
				),
				// persentase total satu modul
				'persentase' => ,
			),
		),
	);