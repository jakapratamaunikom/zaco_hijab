## Database Zaco Hijab v3 ##

-- ============= Tabel Master ============= --

	-- Tabel User / Admin
	CREATE TABLE admin(
		username varchar(10) NOT NULL,
		password text NOT NULL,
		nama varchar(50),
		email varchar(50),
		telp varchar(15),
		alamat text,
		level enum('ADMIN', 'KASIR'),
		status char(1), -- 1: aktif, 0: non-aktif

		CONSTRAINT pk_admin_username PRIMARY KEY(username) 
	);

	-- Tabel id barang --
	CREATE TABLE id_barang(
		id int AUTO_INCREMENT NOT NULL,
		id_barang varchar(4) NOT NULL UNIQUE,
		nama varchar(50),

		CONSTRAINT pk_id_barang_id PRIMARY KEY(id)
	);

	-- Tabel id warna --
	CREATE TABLE id_warna(
		id int AUTO_INCREMENT NOT NULL,
		id_warna varchar(4) NOT NULL UNIQUE,
		nama varchar(50),

		CONSTRAINT pk_id_warna_id PRIMARY KEY(id)
	);

	-- Tabel Barang --
	CREATE TABLE barang(
		id int AUTO_INCREMENT NOT NULL,
	    id_barang int,
	    id_warna int,
	    nama varchar(100),
	    hpp double(8,2),
	    harga_pasar double(8,2),
	    market_place double(8,2),
	    harga_ig double(8,2),
	    foto text,
	    ket text,
	    status char(1), -- 1: aktif, 0: non-aktif
	    
	    CONSTRAINT pk_barang_id PRIMARY KEY(id),
	    CONSTRAINT fk_barang_id_barang FOREIGN KEY(id_barang) REFERENCES id_barang(id),
	    CONSTRAINT fk_barang_id_warna FOREIGN KEY(id_warna) REFERENCES id_warna(id)
	);


	-- Tabel Penjualan
		CREATE TABLE penjualan(
			id int AUTO_INCREMENT NOT NULL,
			kd_penjualan varchar(16) NOT NULL UNIQUE,
			tgl date,
			jenis enum('HARGA PASAR','MARKET PLACE','HARGA IG','RESELLER'),
		    nama varchar(50),
		    telp varchar(15),
		    alamat text,
		    ongkir double(8,2),
		    status char(1), -- 0: diskon 100%, 1: normal
		    ket text, -- ket menyeluruh
		    user varchar(10),

		    CONSTRAINT pk_penjualan_id PRIMARY KEY(id),
		    CONSTRAINT fk_penjualan_user FOREIGN KEY(user) REFERENCES admin(username)
		);

		-- Detail Penjualan
		CREATE TABLE detail_penjualan(
			id int AUTO_INCREMENT NOT NULL,
			kd_penjualan int,
			kd_barang int,
			hpp double(8,2),
			harga double(8,2),
			qty SMALLINT,
			jenis_diskon char(1), -- r: rupiah, p: persen
			diskon int,
			subtotal double(12,2),
			laba double(8,2),
			ket text, -- opsional ket masing2 item

			CONSTRAINT pk_detail_penjualan_id PRIMARY KEY(id),
			CONSTRAINT fk_detail_penjualan_kd_penjualan FOREIGN KEY(kd_penjualan) REFERENCES penjualan(id),
			CONSTRAINT fk_detail_penjualan_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
		);
		
	-- Tabel Reject
		CREATE TABLE reject(
			id int AUTO_INCREMENT NOT NULL,
			kd_reject varchar(16) NOT NULL UNIQUE,
			kd_penjualan int,
			tgl date,
			ket text,
			user varchar(10),

			CONSTRAINT pk_reject_id PRIMARY KEY(id),
			CONSTRAINT fk_reject_kd_penjualan FOREIGN KEY(kd_penjualan) REFERENCES penjualan(id),
			CONSTRAINT fk_reject_user FOREIGN KEY(user) REFERENCES admin(username)
		);

		-- Detail Reject (belum final)
		CREATE TABLE detail_reject(
			id int AUTO_INCREMENT NOT NULL,
			kd_reject int,
			barang_lama int,
			barang_ganti int
			qty int,
			jenis enum("REJECT", "RETURN"),
			ket text,

			CONSTRAINT pk_detail_reject_id PRIMARY KEY(id),
			CONSTRAINT fk_detail_reject_kd_reject FOREIGN KEY(kd_reject) REFERENCES reject(id),
			CONSTRAINT fk_detail_reject_barang_lama FOREIGN KEY(barang_lama) REFERENCES barang(id),
			CONSTRAINT fk_detail_reject_barang_ganti FOREIGN KEY(barang_ganti) REFERENCES barang(id)
		);

	-- Tabel Pembelian
		CREATE TABLE pembelian(
			id int AUTO_INCREMENT NOT NULL,
			kd_pembelian varchar(16) NOT NULL UNIQUE,
			tgl date,
			ket text,
			user varchar(10),

			CONSTRAINT pk_pembelian_id PRIMARY KEY(id),
			CONSTRAINT fk_pembelian_user FOREIGN KEY(user) REFERENCES admin(username)
		);

		-- Detail Pembelian
		CREATE TABLE detail_pembelian(
			id int AUTO_INCREMENT NOT NULL,
			kd_pembelian int,
			kd_barang int,
			harga double(8,2),
			qty SMALLINT,
			subtotal double(12,2),
			ket text,

			CONSTRAINT pk_detail_pembelian_id PRIMARY KEY(id),
			CONSTRAINT fk_detail_pembelian_kd_pembelian FOREIGN KEY(kd_pembelian) REFERENCES pembelian(id),
			CONSTRAINT fk_detail_pembelian_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
		);

	-- Tabel Pengeluaran
		CREATE TABLE pengeluaran(
			id int AUTO_INCREMENT NOT NULL,
			kd_pengeluaran varchar(16) NOT NULL UNIQUE,
			tgl date,
			ket text,
			jenis enum('MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA'),
			user varchar(10),

			CONSTRAINT pk_pengeluaran_id PRIMARY KEY(id),
			CONSTRAINT fk_pengeluaran_user FOREIGN KEY(user) REFERENCES admin(username)
		);

		-- Detail Pembelian
		CREATE TABLE detail_pengeluaran(
			id int AUTO_INCREMENT NOT NULL,
			kd_pengeluaran int,
			nominal double(12,2),
			qty SMALLINT,
			subtotal double(12,2),
			ket text,

			CONSTRAINT pk_detail_pengeluaran_id PRIMARY KEY(id),
			CONSTRAINT fk_detail_pengeluaran_kd_pengeluaran FOREIGN KEY(kd_pengeluaran) REFERENCES pengeluaran(id)
		);	

	-- Tabel Stok Barang (barang masuk-keluar)
	CREATE TABLE stok(
		id int NOT NULL AUTO_INCREMENT,
		tgl date,
		kd_barang int,
		stok_awal int,
		brg_masuk SMALLINT,
		brg_keluar SMALLINT,
		stok_akhir int,

		CONSTRAINT pk_mutasi_id PRIMARY KEY(id),
		CONSTRAINT fk_mutasi_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
	);

-- ======================================== --


-- =============== Procedure ============== --
	-- Data Admin
		-- Tambah admin => Insert seperti biasa
		-- Edit admin => Update seperti biasa
		-- Hapus admin => ?


	-- Data Barang
		-- Tambah barang => Insert barang dan insert stok
		-- Procedure Tambah Barang
		CREATE PROCEDURE tambah_barang(
			in id_barang_param int,
		    in id_warna_param int,
		    in nama_param varchar(50),
		    in hpp_param double(8,2),
		    in harga_pasar_param double(8,2),
		    in market_place_param double(8,2),
		    in harga_ig_param double(8,2),
		    in foto_param text,
		    in ket_param text,
		    in status_param char,
		    in tgl_param date,
		    in stok_awal_param int
		)
		BEGIN
			DECLARE id_param int;
    
		    SELECT `AUTO_INCREMENT` INTO id_param FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'zaco_hijab' AND   TABLE_NAME   = 'barang';

			-- insert ke barang
			INSERT INTO barang(id_barang, id_warna, nama, hpp, harga_pasar, market_place, harga_ig, foto, ket, status)
		    VALUES(id_barang_param, id_warna_param, nama_param, hpp_param, harga_pasar_param, market_place_param, harga_ig_param, foto_param, ket_param, status_param);
		    
		    -- insert stok
		    INSERT INTO stok(tgl, kd_barang, stok_awal, brg_masuk, brg_keluar, stok_akhir)
		    VALUES(tgl_param, id_param, stok_awal_param, 0, 0, stok_awal_param);

		END;

		-- Edit Barang => Update barang seperti biasa
		-- Hapus Baang => ?

	-- Data Penjualan

-- ======================================== --