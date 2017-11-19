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
			jenis enum('MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA'),
			user varchar(10),

			CONSTRAINT pk_pengeluaran_id PRIMARY KEY(id),
			CONSTRAINT fk_pengeluaran_user FOREIGN KEY(user) REFERENCES admin(username)
		);

		-- Detail Pembelian
		CREATE TABLE detail_pengeluaran(
			id int AUTO_INCREMENT NOT NULL,
			kd_pengeluaran int,
			ket varchar(255),
			nominal double(12,2),
			qty SMALLINT,
			subtotal double(12,2),

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

		CONSTRAINT pk_stok_id PRIMARY KEY(id),
		CONSTRAINT fk_stok_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
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
    
		    SELECT `AUTO_INCREMENT` INTO id_param 
		    FROM INFORMATION_SCHEMA.TABLES 
		    WHERE TABLE_SCHEMA = 'zaco_hijab' AND TABLE_NAME = 'barang';

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
		-- Tambah penjualan => Insert penjualan biasa

		-- Tambah Detail Penjualan => Insert detail penjualan dan insert stok
		-- Procedure Tambah detail penjualan
		CREATE PROCEDURE tambah_penjualan(
			in kd_penjualan_param varchar(16),
		    in tgl_param date,
		    in kd_barang_param int,
		    in hpp_param double(8,2),
		    in harga_param double(8,2),
		    in qty_param SMALLINT,
		    in jenis_diskon_param char(1),
		    in diskon_param int,
		    in subtotal_param double(12,2),
		    in laba_param double(8,2),
		    in ket_param text -- ket masing2
		)
		BEGIN
			DECLARE cek_tgl SMALLINT;
			DECLARE stok_akhir_param int;
			DECLARE get_brg_keluar SMALLINT;
			DECLARE get_stk_awal int;
			DECLARE get_brg_masuk SMALLINT;
			DECLARE kd_penjualan_id_param int;

			-- dapatkan id kd_penjualan
    		SELECT id into kd_penjualan_id_param FROM penjualan WHERE kd_penjualan = kd_penjualan_param;

    		INSERT INTO detail_penjualan(
        		kd_penjualan, kd_barang, hpp, harga, qty, jenis_diskon, diskon, subtotal, laba, ket) 
    		VALUES(
        		kd_penjualan_id_param, kd_barang_param, hpp_param, harga_param, qty_param, 
        		jenis_diskon_param, diskon_param, subtotal_param, laba_param, ket_param);

    		-- get tgl stok ada/tidak
    		SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;

    		IF cek_tgl > 0 THEN -- jika tgl transaksi sesuai dgn tgl di stok
    			SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
		        SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
		        SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai
		        
		    	UPDATE stok SET
		    		brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
		    	WHERE
		    		kd_barang=kd_barang_param AND tgl=tgl_param;

		    ELSE -- jika tgl transaksi tidak ada yg sama dgn tgl di stok
		    	SELECT stok_akhir into stok_akhir_param FROM stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
		    	-- tambah stok
		    	INSERT INTO stok(
		    		tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		    	VALUES(
		    		tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

    		END IF;
		END;

		-- Edit Detail Penjualan => Update detail penjualan dan edit stok
		-- Procedure Edit detail Penjualan
		CREATE PROCEDURE edit_penjualan(
			in id_param int, -- id penjualan
		    in id_detail_param int, -- id detail penjualan
		    in tgl_param date,
		    in kd_barang_param int,
		    in hpp_param double(8,2),
		    in harga_param double(8,2),
		    in qty_param SMALLINT,
		    in jenis_diskon_param char(1),
		    in diskon_param int,
		    in subtotal_param double(12,2),
		    in laba_param double(8,2),
		    in ket_param text
		)
		BEGIN
			DECLARE kd_barang_penjualan int;
		    DECLARE get_qty_penjualan SMALLINT;
		    DECLARE get_stk_awal int;
		    DECLARE get_brg_keluar SMALLINT;
		    DECLARE get_brg_masuk SMALLINT;
		    DECLARE cek_tgl SMALLINT;
		    DECLARE stok_awal_A int;
		    DECLARE stok_awal_B int;
		    DECLARE brg_masuk_A SMALLINT;
		    DECLARE brg_masuk_B SMALLINT;
		    DECLARE brg_keluar_A SMALLINT;
		    DECLARE brg_keluar_B SMALLINT;
		    DECLARE stok_akhir_param int;

		    -- get data barang di detail penjualan
    		SELECT kd_barang into kd_barang_penjualan FROM detail_penjualan WHERE id=id_detail_param; -- kd barang lama

    		 -- jika barang sama (tidak ada perubahan)
		    IF kd_barang_param = kd_barang_penjualan THEN

		        -- dapatkan qty barangnya
		        SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;
		        
		        -- jika qty berubah
		        IF qty_param != get_qty_penjualan THEN
		            
		            SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
		            SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
		            SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai

		            UPDATE stok SET
		                brg_keluar=(get_brg_keluar+(qty_param-get_qty_penjualan)), 
		                stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_penjualan)))
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
		        end if;

		        -- update detail penjualan, ubah qty nya saja
		        UPDATE detail_penjualan SET
		            hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, 
		            subtotal=subtotal_param, laba=laba_param, ket=ket_param
		        WHERE id=id_detail_param;


		    -- jika barang berubah
		    ELSE
		        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param; -- cek tgl
		        SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;

		        -- jika qty sama
		        IF qty_param = get_qty_penjualan THEN
		            -- get data lama (A)
		            SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
		            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
		            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;

		            -- get data yg baru (B)
		            SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

		            -- update data lama
		            UPDATE stok SET
		                brg_keluar=(brg_keluar_A-qty_param), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-qty_param))
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_penjualan;

		            IF cek_tgl > 0 THEN

		                -- update data baru
		                UPDATE stok SET
		                    brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
		                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
		            
		            ELSE
		                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
		    
		                -- tambah stok
		                INSERT into stok(
		                    tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		                VALUES(
		                    tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

		            end if;

		            -- update detail penjualan, ubah kd_barang nya saja
		            UPDATE detail_penjualan SET
		                kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, jenis_diskon=jenis_diskon_param, 
		                diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
		            WHERE id=id_detail_param;
		            
		        -- jika qty berubah
		        ELSE

		            SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;
		            -- pindah barang
		            SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
		            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
		            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;

		            -- get data yg baru (B)
		            SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

		            -- update data lama
		            UPDATE stok SET
		                brg_keluar=(brg_keluar_A-get_qty_penjualan), 
		                stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-get_qty_penjualan))
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_penjualan;

		            IF cek_tgl > 0 THEN

		                -- update data baru
		                UPDATE stok SET
		                    brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
		                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
		            
		            ELSE
		                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru

		                -- tambah stok
		                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		                VALUES(tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
		            END IF;

		            -- update detail penjualan, ubah kd barang dan qty
		            UPDATE detail_penjualan SET
		                kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, 
		                diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
		            WHERE id=id_detail_param;


		        END IF;

		    END IF;
		END;

		-- Hapus Detail Penjualan => Hapus detail penjualan dan edit stok
		-- Procedure Hapus detail penjualan
		CREATE PROCEDURE hapus_penjualan(
			in id_detail_param int,
		    in kd_barang_param int,
		    in tgl_param date,
		    in qty_param int,
		)
		BEGIN
			DECLARE tgl_skrng date;
		    DECLARE brg_keluar_param smallint;
		    DECLARE stok_akhir_param int;

	     	SELECT current_date INTO tgl_skrng;

	    	IF tgl_param = tgl_skrng THEN

		        -- mendapatkan brg_keluar dari stok
		        SELECT brg_keluar INTO brg_keluar_param FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param;
		        -- mendapatkan stok_akhir dari stok
		        SELECT stok_akhir INTO stok_akhir_param FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param;
		        
		        -- normalisasi brg_keluar dan stok_akhir dengan qty dari detail_penjualan
		        UPDATE stok 
		            SET brg_keluar=(brg_keluar_param-qty_param), stok_akhir=(stok_akhir_param+qty_param) 
		        WHERE kd_barang=kd_barang_param AND tgl=tgl_param;

		        -- hapus barang pada detail_penjualan
		        DELETE FROM detail_penjualan WHERE id=id_detail_param;

		    END IF;
		END;

	-- Data Pembelian
		-- Tambah pembelian => Insert pembelian biasa

		-- Tambah Detail Pembelian => Insert detail pembelian dan insert stok
		-- Procedure Tambah detail pembelian
		CREATE PROCEDURE tambah_pembelian(
			in kd_pembelian_param varchar(16),
		    in tgl_param date,
		    in kd_barang_param int,
		    in harga_param double(8,2),
		    in qty_param SMALLINT,
		    in subtotal_param double(12,2),
		    in ket_param text -- ket masing2
		)
		BEGIN
			DECLARE cek_tgl SMALLINT;
		    DECLARE stok_akhir_param int;
		    DECLARE get_brg_keluar SMALLINT;
		    DECLARE get_stk_awal int;
		    DECLARE get_brg_masuk SMALLINT;
		    DECLARE kd_pembelian_id_param int;

		    -- dapatkan id kd_penjualan
    		SELECT id INTO kd_pembelian_id_param FROM pembelian WHERE kd_pembelian = kd_pembelian_param;

    		-- tidak perlu insert ke pembelian tp langsung ke detail pembelian
		    INSERT INTO detail_pembelian(
		        kd_pembelian, kd_barang, harga, qty, subtotal, ket) 
		    VALUES (
		        kd_pembelian_id_param, kd_barang_param, harga_param, qty_param, subtotal_param, ket_param);

		    -- get tgl stok ada/tidak
    		SELECT COUNT(tgl) INTO cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;

    		IF cek_tgl > 0 THEN -- jika tgl transaksi sesuai dgn tgl di stok
        		-- update stok (jika ada) 
     
		        SELECT brg_keluar INTO get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
		        SELECT stok_awal INTO get_stk_awal FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
		        SELECT brg_masuk INTO get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai
        
		        UPDATE stok SET
		            brg_masuk=(qty_param+get_brg_masuk), 
		            stok_akhir=(get_stk_awal+(qty_param+get_brg_masuk)-get_brg_keluar)
		        WHERE
		            kd_barang=kd_barang_param AND tgl=tgl_param;
        
    		ELSE -- jika tgl transaksi tidak ada yg sama dgn tgl di stok
        
        		SELECT stok_akhir into stok_akhir_param FROM stok 
        		WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
		        -- tambah stok
		        INSERT INTO stok(
		            tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		        VALUES(
		            tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
    		END IF;
		END;

		-- Edit Detail Pembelian => Update detail pembelian dan edit stok
		-- Procedure Edit detail Pembelian
		CREATE PROCEDURE edit_pembelian(
			in id_param int, -- id pembelian
		    in id_detail_param int, -- id detail pembelian
		    in tgl_param date,
		    in kd_barang_param int,
		    in harga_param double(8,2),
		    in qty_param SMALLINT,
		    in subtotal_param double(12,2),
		    in ket_param text
		)
		BEGIN
			DECLARE kd_barang_pembelian int;
		    DECLARE get_qty_pembelian SMALLINT;
		    DECLARE get_stk_awal int;
		    DECLARE get_brg_keluar SMALLINT;
		    DECLARE get_brg_masuk SMALLINT;
		    DECLARE cek_tgl SMALLINT;
		    DECLARE stok_awal_A int;
		    DECLARE stok_awal_B int;
		    DECLARE brg_masuk_A SMALLINT;
		    DECLARE brg_masuk_B SMALLINT;
		    DECLARE brg_keluar_A SMALLINT;
		    DECLARE brg_keluar_B SMALLINT;
		    DECLARE stok_akhir_param int;

		    -- get data penjualan
			SELECT kd_barang INTO kd_barang_pembelian FROM detail_pembelian WHERE id=id_detail_param; -- kd barang lama

			-- jika barang sama
    		IF kd_barang_param = kd_barang_pembelian THEN	
    			SELECT qty INTO get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;

    			-- jika qty berubah
		        IF qty_param != get_qty_pembelian THEN
		            
		            SELECT stok_awal INTO get_stk_awal FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
		            SELECT brg_keluar INTO get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
		            SELECT brg_masuk INTO get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai

		            UPDATE stok SET
		                brg_masuk=((get_brg_masuk-get_qty_pembelian)+qty_param), 
		                stok_akhir=((get_stk_awal+(get_brg_masuk-get_qty_pembelian)+qty_param)-get_brg_keluar)
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
		        END IF;

		        UPDATE detail_pembelian SET
		            harga=harga_param, qty=qty_param, subtotal=subtotal_param, ket=ket_param
		        WHERE id=id_detail_param;
		    
		    -- jika barang berubah
		    ELSE
		    	SELECT count(tgl) INTO cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param; -- cek tgl
        		SELECT qty INTO get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;

        		-- jika qty sama
		        IF qty_param = get_qty_pembelian THEN
		            -- get data lama (A)
		            SELECT brg_keluar INTO brg_keluar_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
		            SELECT brg_masuk INTO brg_masuk_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
		            SELECT stok_awal INTO stok_awal_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

		            -- get data yg baru (B)
		            SELECT stok_awal INTO stok_awal_B FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; 
		            SELECT brg_keluar INTO brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; 
		            SELECT brg_masuk INTO brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param; 

		            -- update data lama
		            UPDATE stok SET
		                brg_masuk=(brg_masuk_A-qty_param), 
		                stok_akhir=(stok_awal_A+(brg_masuk_A-qty_param)-brg_keluar_A)
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_pembelian;	

		            IF cek_tgl > 0 THEN
		            	-- update data baru
		                UPDATE stok SET
		                    brg_masuk=(brg_masuk_B+qty_param), 
		                    stok_akhir=(stok_awal_B+(brg_masuk_B+qty_param)-brg_keluar_B)
		                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;

		            ELSE
		            	SELECT stok_akhir INTO stok_akhir_param FROM stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
    
		                -- tambah stok
		                INSERT INTO stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		                VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));

		            END IF;

		            UPDATE detail_pembelian SET
		                kd_barang=kd_barang_param, harga=harga_param, subtotal=subtotal_param, ket=ket_param
		            WHERE id=id_detail_param;

		        -- jika qty berubah
        		ELSE

        			SELECT qty INTO get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;
		            -- pindah barang
		            SELECT brg_keluar INTO brg_keluar_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
		            SELECT brg_masuk INTO brg_masuk_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
		            SELECT stok_awal INTO stok_awal_A FROM stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

		            -- get data yg baru (B)
		            SELECT stok_awal INTO stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_keluar INTO brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
		            SELECT brg_masuk INTO brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

		            -- update data lama
		            UPDATE stok SET
		                brg_masuk=(brg_masuk_A-get_qty_pembelian), stok_akhir=(stok_awal_A+(brg_masuk_A-get_qty_pembelian)-brg_keluar_A)
		            WHERE tgl=tgl_param AND kd_barang=kd_barang_pembelian;

		            IF cek_tgl > 0 THEN

		                -- update data baru
		                UPDATE stok SET
		                    brg_masuk=(brg_masuk_B+qty_param), stok_akhir=(stok_awal_B+(brg_masuk_B+qty_param)-brg_keluar_B)
		                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
		            
		            ELSE
		                SELECT stok_akhir INTO stok_akhir_param FROM stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru

		                -- tambah stok
		                INSERT INTO stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
		                VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
		            end if;

		             UPDATE detail_pembelian SET
		                kd_barang=kd_barang_param, harga=harga_param, qty=qty_param, 
		                subtotal=subtotal_param, ket=ket_param
		            WHERE id=id_detail_param;

		        END IF;

		    END IF;

		END;

		-- Hapus Detail Pembelian => Hapus detail pembelian dan edit stok
		-- Procedure Hapus detail pembelian
		CREATE PROCEDURE hapus_pembelian(
			in id_detail_param int,
		    in kd_barang_param int,
		    in tgl_param date,
		    in qty_param int
		)
		BEGIN
			DECLARE tgl_skrng date;
		    DECLARE brg_masuk_param smallint;
		    DECLARE stok_akhir_param int;

		    SELECT current_date INTO tgl_skrng;
	     	
	    	IF tgl_param = tgl_skrng THEN

		        -- mendapatkan brg_masuk dari stok
		        SELECT brg_masuk INTO brg_masuk_param FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param;
		        -- mendapatkan stok_akhir dari stok
		        SELECT stok_akhir INTO stok_akhir_param FROM stok WHERE kd_barang=kd_barang_param AND tgl=tgl_param;
		        
		        -- normalisasi brg_masuk dan stok_akhir dengan qty dari detail_pembelian
		        UPDATE stok 
		            SET brg_masuk=(brg_masuk_param-qty_param), stok_akhir=(stok_akhir_param-qty_param) 
		        WHERE kd_barang=kd_barang_param AND tgl=tgl_param;

		        -- hapus barang pada detail_pembelian
		        DELETE FROM detail_pembelian WHERE id=id_detail_param;

		    END IF;
		END;

	-- Data Pengeluaran
		-- Tambah pengeluaran => Insert pengeluaran biasa

		-- Tambah Detail Pengeluaran => insert detail pengeluaran
		CREATE PROCEDURE tambah_pengeluaran(
			in kd_pengeluaran_param varchar(16),
		    in ket_param varchar(255),
		    in nominal_param double(8,2),
		    in qty_param SMALLINT,
		    in subtotal_param double(12,2)
		)
		BEGIN
			DECLARE kd_pengeluaran_id_param int;

		    -- dapatkan id kd_penjualan
    		SELECT id INTO kd_pengeluaran_id_param FROM pengeluaran WHERE kd_pengeluaran = kd_pengeluaran_param;

    		-- tidak perlu insert ke pembelian tp langsung ke detail pembelian
		    INSERT INTO detail_pengeluaran(
		        kd_pengeluaran, ket, nominal, qty, subtotal) 
		    VALUES (
		        kd_pengeluaran_id_param, ket_param, nominal_param, qty_param, subtotal_param);
		END;

		-- Edit Detail Pengeluaran => update detail pengeluaran langsung
		-- Hapus Detail Pengeluaran => hapus detail pengeluaran langsung

-- ======================================== --

-- ================= View ================= --
	
	-- View Data Barang
	-- id barang, kode barang, nama, harga barang, ket, status dan stok akhir
	CREATE OR REPLACE VIEW v_barang AS
		SELECT
			b.id, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, 
	        b.nama,  b.hpp,  b.harga_pasar, b.market_place, b.harga_ig, b.foto, b.ket, 
	        (CASE WHEN (b.status = '1') THEN 'AKTIF' ELSE 'NON AKTIF' END) status, 
	        s.stok_akhir stok
		FROM stok s
		JOIN barang b ON b.id = s.kd_barang 
		JOIN id_barang ib ON ib.id = b.id_barang 
		JOIN id_warna iw ON iw.id = b.id_warna 
		WHERE
			s.id in(SELECT max(id) from stok GROUP by(kd_barang))
		ORDER BY status ASC, b.id ASC;

	-- View Data Penjualan
	-- id penjualan, kode penjualan, detail penjualan, ket, harga, status, dll
		CREATE OR REPLACE VIEW v_penjualan AS
			SELECT 
		        p.id, p.kd_penjualan, tgl, jenis, 
		        GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') item, 
		        CAST(SUM(dp.subtotal)+p.ongkir as DECIMAL(12,2)) as total,
		        CAST(SUM(dp.laba) as DECIMAL(12,2)) as total_laba, 
		        (CASE WHEN (p.status = '1') THEN 'NORMAL' ELSE 'FREE' END) status, p.ket 
		    FROM penjualan p
		    JOIN detail_penjualan dp ON dp.kd_penjualan = p.id
		    JOIN barang b ON b.id = dp.kd_barang
		    JOIN id_barang ib ON ib.id = b.id_barang
		    JOIN id_warna iw ON iw.id = b.id_warna
		    GROUP BY p.id DESC;

		CREATE OR REPLACE VIEW v_detail_penjualan AS
		    SELECT dp.id, dp.kd_penjualan, dp.kd_barang, b.kd_barang kode_barang, b.nama, 
		        dp.hpp, dp.harga, dp.qty, dp.jenis_diskon, dp.diskon, dp.subtotal, dp.ket
		    FROM detail_penjualan dp
		    JOIN penjualan p ON p.id=dp.kd_penjualan
		    JOIN v_barang b ON b.id=dp.kd_barang
		    ORDER BY dp.id ASC;

	-- View Data Pembelian
	-- id pembelian, kode pembelian, detail pembelian, ket, harga, dll
		CREATE OR REPLACE VIEW v_pembelian AS
			SELECT
		        p.id, p.kd_pembelian, tgl,
		        GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') item, 
		        CAST(SUM(dp.subtotal) as DECIMAL(12,2)) as total,
		        p.ket 
		    FROM pembelian p
		    JOIN detail_pembelian dp ON dp.kd_pembelian = p.id
		    JOIN barang b ON b.id = dp.kd_barang
		    JOIN id_barang ib ON ib.id = b.id_barang
		    JOIN id_warna iw ON iw.id = b.id_warna
		    GROUP BY p.id DESC;

		CREATE OR REPLACE VIEW v_detail_pembelian AS
		    SELECT dp.id, dp.kd_pembelian, dp.kd_barang, b.kd_barang kode_barang, b.nama, 
		        dp.harga, dp.qty, dp.subtotal, dp.ket
		    FROM detail_pembelian dp
		    JOIN pembelian p ON p.id=dp.kd_pembelian
		    JOIN v_barang b ON b.id=dp.kd_barang
		    ORDER BY dp.id ASC;

	-- View Pengeluaran
	-- id pengeluaran, kode pengeluaran, detail pengeluaran, ket, harga, jenis, dll
		CREATE OR REPLACE VIEW v_pengeluaran AS
			SELECT
		        p.id, p.kd_pengeluaran, tgl,
		        GROUP_CONCAT(concat(dp.ket, ' JUMLAH : ', dp.qty) separator ', ') keterangan, 
		        CAST(SUM(dp.subtotal) as DECIMAL(12,2)) as total,
		        p.jenis
		    FROM pengeluaran p
		    JOIN detail_pengeluaran dp ON dp.kd_pengeluaran = p.id
		    GROUP BY p.id DESC;

		CREATE OR REPLACE VIEW v_detail_pengeluaran AS
			SELECT dp.id, dp.kd_pengeluaran, dp.ket, dp.nominal, dp.qty, dp.subtotal
		    FROM detail_pengeluaran dp
		    JOIN pengeluaran p ON p.id=dp.kd_pengeluaran
		    ORDER BY dp.id ASC;

	-- View stok
		-- get semua data stok terbaru
		CREATE OR REPLACE VIEW v_stok_terbaru AS
			SELECT s.id, s.tgl, s.kd_barang, b.kd_barang kode_barang, b.nama, s.stok_awal,
		        s.brg_masuk, s.brg_keluar, s.stok_akhir 
		    FROM stok s
		    JOIN v_barang b ON b.id = s.kd_barang
		    WHERE s.id IN(SELECT MAX(id) FROM stok GROUP BY(kd_barang))
		    ORDER BY b.kd_barang ASC;

		-- get semua data stok
		CREATE OR REPLACE VIEW v_stok_all AS
		    SELECT s.id, s.tgl, s.kd_barang, b.kd_barang kode_barang, b.nama, s.stok_awal,
		        s.brg_masuk, s.brg_keluar, s.stok_akhir 
		    FROM stok s
		    JOIN v_barang b ON b.id = s.kd_barang
		    ORDER BY b.kd_barang ASC;

-- ======================================== --