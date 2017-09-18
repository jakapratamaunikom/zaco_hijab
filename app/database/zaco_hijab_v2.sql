-- Database Zaco Hijab v2

-- ============ Tabel Master ============ --

-- tabel id_barang
-- untuk menentukan jenis barang. contoh: Hijab jenis Halimah -> HLM
create table id_barang(
	id int AUTO_INCREMENT NOT NULL,
	id_barang varchar(4) NOT NULL UNIQUE,
    nama varchar(25),
    CONSTRAINT pk_id_barang_id PRIMARY KEY(id)
);

-- ==============================================================

-- tabel id_warna
-- untuk menentukan jenis warna barang. contoh: warna merah -> MRH
create table id_warna(
	id int AUTO_INCREMENT NOT NULL,
	id_warna varchar(4) NOT NULL UNIQUE,
    nama varchar(25),
    CONSTRAINT pk_id_warna_id PRIMARY KEY(id)
);

-- ==============================================================

-- tabel barang
-- data master barang, dimana barang adalah kombinasi dari tabel id_barang dan id_warna
create table barang(
    id int AUTO_INCREMENT NOT NULL,
    id_barang int, -- fk dari tabel id_barang
    id_warna int, -- fk dari tabel id_warna
    nama varchar(50), -- nama custom
    hpp double(8,2),
    harga_pasar double(8,2),
    market_place double(8,2),
    harga_ig double(8,2),
    foto text,
    ket text,
    CONSTRAINT pk_barang_id PRIMARY KEY(id),
    CONSTRAINT fk_barang_id_barang FOREIGN KEY(id_barang) REFERENCES id_barang(id),
    CONSTRAINT fk_barang_id_warna FOREIGN KEY(id_warna) REFERENCES id_warna(id)
);

-- ==============================================================

-- tabel admin/user
-- data master admin/user untuk mengakses sistem
create table admin(
	username varchar(10) NOT NULL,
	password text NOT NULL,
    nama varchar(50),
    email varchar(100) UNIQUE,
    level enum('ADMIN','KASIR'),
    CONSTRAINT pk_user_username PRIMARY KEY(username)
);

-- ==============================================================

-- ============ Tabel Transaksi ============ --

-- tabel penjualan (master)
-- mencatat semua transaksi penjualan
create table penjualan(
	id int AUTO_INCREMENT NOT NULL,
	kd_penjualan varchar(16) NOT NULL UNIQUE,
    tgl date,
    jenis enum('HARGA PASAR','MARKET PLACE','HARGA IG','RESELLER'),
    nama varchar(50),
    telp varchar(15),
    alamat text,
    ongkir double(8,2),
    status char(1), -- 0=diskon 100%, 1=normal
    ket text, -- ket menyeluruh
    username varchar(10), -- fk
    CONSTRAINT pk_penjualan_id PRIMARY KEY(id),
    CONSTRAINT fk_penjualan_username FOREIGN KEY(username) REFERENCES admin(username)
);

-- ==============================================================

-- tabel detail_penjualan (mencatat item, qty, ket dari penjualan)
create table detail_penjualan(
	id int AUTO_INCREMENT NOT NULL,
	kd_penjualan int, -- fk dari penjualan
	kd_barang int, -- fk dari barang
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

-- ==============================================================

-- tabel reject
-- mencatat semua transaksi penjualan yg reject
create table reject(
    id int AUTO_INCREMENT NOT NULL,
    kd_penjualan int NOT NULL, -- fk dari penjualan
    tgl date,
    kd_barang int, -- fk dari tabel barang
    qty SMALLINT,
    kd_barang_ganti int,
    hpp double(8,2),
    harga double(8,2),
    ongkir double(8,2),
    total double(12,2),
    rugi double(8,2),
    ket text,
    username varchar(10), -- fk
    CONSTRAINT pk_reject_id PRIMARY KEY(id),
    CONSTRAINT fk_reject_kd_penjualan FOREIGN KEY(kd_penjualan) REFERENCES penjualan(id),
    CONSTRAINT fk_reject_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id),
    CONSTRAINT fk_reject_username FOREIGN KEY(username) REFERENCES admin(username)
);

-- ==============================================================

-- tabel pembelian (master)
-- mencatat semua transaksi pembelian, yang nantinya akan termasuk kedalam pengeluaran jg
create table pembelian(
	id int AUTO_INCREMENT NOT NULL,
	kd_pembelian varchar(16) NOT NULL UNIQUE,
    tgl date,
    ket text, -- ket menyeluruh
    username varchar(10), -- fk dari tabel admin
    CONSTRAINT pk_pembelian_id PRIMARY KEY(id),
    CONSTRAINT fk_pembelian_username FOREIGN KEY(username) REFERENCES admin(username)
);

-- ==============================================================

-- tabel detail_pembelian (mencatat item, qty, ket dari pembelian)
create table detail_pembelian(
	id int AUTO_INCREMENT NOT NULL,
	kd_pembelian int, -- fk dari pembelian
	kd_barang int, -- fk dari pembelian
    harga double(8,2),
    qty SMALLINT,
    subtotal double(12,2),
    ket text, -- opsional ket masing2 item
    CONSTRAINT pk_detail_pembelian_id PRIMARY KEY(id),
    CONSTRAINT fk_detail_pembelian_kd_pembelian FOREIGN KEY(kd_pembelian) REFERENCES pembelian(id),
    CONSTRAINT fk_detail_pembelian_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
);

-- ==============================================================

-- tabel pengeluaran (master)
-- mencatat semua transaksi pengeluaran
create table pengeluaran(
	id int AUTO_INCREMENT NOT NULL,
	kd_pengeluaran varchar(16) NOT NULL UNIQUE,
    -- kd_pembelian int,
    tgl date,
    -- kd_pembelian int, -- fk dari tabel pembelian
    -- kd_pembelian varchar(16), -- fk dari tabel pembelian
    ket text,
    -- nominal double(12,2),
    -- qty SMALLINT,
    -- total double(12,2),
    jenis enum('PRODUKSI','MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA'),
    username varchar(10), -- fk dari tabel admin
    CONSTRAINT pk_pengeluaran_id PRIMARY KEY(id),
    -- CONSTRAINT fk_pengeluaran_kd_pembelian FOREIGN KEY(kd_pembelian) REFERENCES pembelian(id),
    CONSTRAINT fk_pengeluaran_username FOREIGN KEY(username) REFERENCES admin(username)
);
-- ==============================================================

-- tabel detail pengeluaran
create table detail_pengeluaran(
    id int AUTO_INCREMENT NOT NULL,
    kd_pengeluaran int,
    nominal double(12,2),
    qty SMALLINT,
    subtotal double(12,2),
    ket text,
    CONSTRAINT pk_detail_pengeluaran_id PRIMARY KEY(id),
    CONSTRAINT fk_detail_pengeluaran_kd_pengeluaran FOREIGN KEY(kd_pengeluaran) REFERENCES pengeluaran(id)
);

-- ==============================================================

-- tabel stok
-- mencatat semua stok barang
create table stok (
	id int NOT NULL AUTO_INCREMENT,
    tgl date,
    kd_barang int, -- fk dari tabel barang
    stok_awal int,
    brg_masuk SMALLINT,
    brg_keluar SMALLINT,
    stok_akhir int,
    CONSTRAINT pk_stok_id PRIMARY KEY(id),
    CONSTRAINT fk_stok_kd_barang FOREIGN KEY(kd_barang) REFERENCES barang(id)
);

-- ==============================================================

-- ============== INDEX ============== --

-- -- index di penjualan
-- CREATE INDEX 
-- ON penjualan() USING BTREE;

-- ============ PROCEDURE ============ --

-- procedure tambah_barang
-- saat pertama kali tambah barang baru, maka stok barang baru otomatis dibuat
create PROCEDURE tambah_barang(
    -- in kd_barang_param varchar(9),
    in id_barang_param int,
    in id_warna_param int,
    in nama_param varchar(50),
    in hpp_param double(8,2),
    in harga_pasar_param double(8,2),
    in market_place_param double(8,2),
    in harga_ig_param double(8,2),
    in foto_param text,
    in ket_param text,
    in tgl_param date,
    in stok_awal_param int
)
BEGIN

    DECLARE id_param int;
    
    SELECT `AUTO_INCREMENT` INTO id_param FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'zaco_hijab' AND   TABLE_NAME   = 'barang';

	-- insert ke barang
	INSERT INTO barang(id_barang, id_warna, nama, hpp, harga_pasar, market_place, harga_ig, foto,ket)
    VALUES(id_barang_param, id_warna_param, nama_param, hpp_param, harga_pasar_param, market_place_param, harga_ig_param, foto_param, ket_param);
    
    -- insert stok
    INSERT INTO stok(tgl, kd_barang, stok_awal, brg_masuk, brg_keluar, stok_akhir)
    VALUES(tgl_param, id_param, stok_awal_param, 0, 0, stok_awal_param);
    
end;

-- ==============================================================

-- procedure tambah_penjualan
-- jika tgl pada transaksi baru tersedia di stok, maka update stok
-- jika tgl pada transaksi baru tidak tersedia/tgl baru, maka buat stok baru
create PROCEDURE tambah_penjualan(
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
	-- DECLARE cek_kd_penjualan SMALLINT;

    -- dapatkan id kd_penjualan
    SELECT id into kd_penjualan_id_param FROM penjualan WHERE kd_penjualan = kd_penjualan_param;

    INSERT INTO detail_penjualan(
        kd_penjualan, kd_barang, hpp, harga, qty, jenis_diskon, diskon, subtotal, laba, ket) 
    VALUES(
        kd_penjualan_id_param, kd_barang_param, hpp_param, harga_param, qty_param, jenis_diskon_param, diskon_param, subtotal_param, laba_param, ket_param);
	
    -- get tgl stok ada/tidak
    SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN -- jika tgl transaksi sesuai dgn tgl di stok

    	-- update stok (jika ada) 

        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
        SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
        SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai
        
    	UPDATE stok SET
    		brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
    	WHERE
    		kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE -- jika tgl transaksi tidak ada yg sama dgn tgl di stok
    	
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
    	-- tambah stok
    	INSERT into stok(
    		tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
    	VALUES(
    		tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
    
    end if;
    
end;

-- ==============================================================

-- procedure tambah_pembelian
-- jika tgl pada transaksi baru tersedia di stok, maka update stok
-- jika tgl pada transaksi baru tidak tersedia/tgl baru, maka buat stok baru
create PROCEDURE tambah_pembelian(
    in kd_pembelian_param varchar(16),
    in tgl_param date,
    in kd_barang_param int,
    in harga_param double(8,2),
    in qty_param SMALLINT,
    in subtotal_param double(12,2),
    -- in jenis_param varchar(8),
    -- in ket_param text, -- ket menyeluruh
    in ket_param text -- ket masing2
    -- in username_param varchar(10)
)
BEGIN

    DECLARE cek_tgl SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE kd_pembelian_id_param int;

    -- dapatkan id kd_penjualan
    SELECT id into kd_pembelian_id_param FROM pembelian WHERE kd_pembelian = kd_pembelian_param;

    -- tidak perlu insert ke pembelian tp langsung ke detail pembelian
    INSERT INTO detail_pembelian(
        kd_pembelian, kd_barang, harga, qty, subtotal, ket) 
    VALUES (
        kd_pembelian_id_param, kd_barang_param, harga_param, qty_param, subtotal_param, ket_param);
    
    -- get tgl stok ada/tidak
    SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN -- jika tgl transaksi sesuai dgn tgl di stok

        -- update stok (jika ada) 
        
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
        SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
        SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai
        
        UPDATE stok SET
            brg_masuk=(qty_param+get_brg_masuk), stok_akhir=(get_stk_awal+(qty_param+get_brg_masuk)-get_brg_keluar)
        WHERE
            kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE -- jika tgl transaksi tidak ada yg sama dgn tgl di stok
        
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
        -- tambah stok
        INSERT into stok(
            tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
        VALUES(
            tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
    end if;
    
end;

-- ==============================================================

-- procedure tambah_reject
-- jika tgl pada transaksi baru tersedia di stok, maka update stok
-- jika tgl pada transaksi baru tidak tersedia/tgl baru, maka buat stok baru
create PROCEDURE tambah_reject(
    in kd_penjualan_param int,
    in tgl_param date,
    in kd_barang_param int,
    in qty_param SMALLINT,
    in kd_barang_ganti int,
    in hpp_param double(8,2),
    in harga_param double(8,2),
    in ongkir_param double(8,2),
    in total_param double(12,2),
    in rugi_param double(8,2),
    in ket_param text,
    in username_param varchar(10)
)
BEGIN

    DECLARE cek_tgl SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_masuk SMALLINT;

    -- insert ke penjualan
    INSERT INTO reject(
        kd_penjualan, tgl, kd_barang, qty, kd_barang_ganti, 
        hpp, harga, ongkir, total, rugi, ket, username) 
    VALUES(
        kd_penjualan_param, tgl_param, kd_barang_param, qty_param, kd_barang_ganti, hpp_param, 
        harga_param, ongkir_param, total_param, rugi_param, ket_param, username_param);
    
    -- get tgl stok ada/tidak
    SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN -- jika tgl transaksi sesuai dgn tgl di stok

        -- update stok (jika ada) 
        
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
        SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
        SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai
        
        UPDATE stok SET
            brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
        WHERE
            kd_barang=kd_barang_ganti AND tgl=tgl_param;
        
    ELSE -- jika tgl transaksi tidak ada yg sama dgn tgl di stok
        
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_ganti ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
        -- tambah stok
        INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
        VALUES(tgl_param,kd_barang_ganti,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
    end if;
    
end;

-- ==============================================================

-- procedure edit penjualan
create procedure edit_penjualan(
    in id_param int, -- id penjualan
    in id_detail_param int, -- id detail penjualan
    in tgl_param date,
    in kd_barang_param int, -- id kd barang yg ada di detail penjualan
    in hpp_param double(8,2),
    in harga_param double(8,2),
    in qty_param SMALLINT,
    in jenis_diskon_param char(1),
    in diskon_param int,
    in subtotal_param double(12,2),
    in laba_param double(8,2),
    -- in status_param char(1),
    in ket_param text
    -- in ket_param2 text,
    -- in username_param varchar(10)
)
BEGIN
    DECLARE tgl_skrng date;
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

    SELECT current_date into tgl_skrng;
    -- get data barang di detail penjualan
    SELECT kd_barang into kd_barang_penjualan FROM detail_penjualan WHERE id=id_detail_param; -- kd barang lama

    -- cek tgl asli dgn tgl skrng
    IF tgl_param = tgl_skrng THEN -- jika tgl penjualan dan tgl edit sama, maka boleh edit barang dan qty

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
                    brg_keluar=(get_brg_keluar+(qty_param-get_qty_penjualan)), stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_penjualan)))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            end if;

            -- update detail penjualan, ubah qty nya saja
            UPDATE detail_penjualan SET
                hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
            WHERE id=id_detail_param;

            -- -- update penjualan total
            -- UPDATE penjualan SET 
            --     jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, 
            --     diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
            -- WHERE id=id_param;

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
                    kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
                WHERE id=id_detail_param;

                -- UPDATE penjualan SET 
                --     qty=qty_param, jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, 
                --     diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
                -- WHERE id=id_param;

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
                    brg_keluar=(brg_keluar_A-get_qty_penjualan), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-get_qty_penjualan))
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
                end if;

                -- update detail penjualan, ubah kd barang dan qty
                UPDATE detail_penjualan SET
                    kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
                WHERE id=id_detail_param;

                -- UPDATE penjualan SET 
                --     jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, hpp=hpp_param, 
                --     harga=harga_param, diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
                -- WHERE id=id_param;

            end if;

        end if;

    ELSE
        -- update biasa selain barang dan qty
        UPDATE detail_penjualan SET 
            hpp=hpp_param, harga=harga_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param 
        WHERE id=id_detail_param;
    end if;

end;

-- ==============================================================

-- procedure edit pembelian
create procedure edit_pembelian(
    in id_param int, -- id pembelian
    in id_detail_param int, -- id detail pembelian
    in tgl_param date,
    in kd_barang_param int,
    in harga_param double(8,2),
    in qty_param SMALLINT,
    in subtotal_param double(12,2),
    in ket_param text
    -- in username_param varchar(10)
)
BEGIN
    DECLARE tgl_skrng date;
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

    SELECT current_date into tgl_skrng;
    -- get data penjualan
    SELECT kd_barang into kd_barang_pembelian FROM detail_pembelian WHERE id=id_detail_param; -- kd barang lama

    -- cek tgl asli dgn tgl skrng
    IF tgl_param = tgl_skrng THEN -- jika tgl penjualan dan tgl edit sama, maka boleh edit barang dan qty

        -- jika barang sama
        IF kd_barang_param = kd_barang_pembelian THEN

            SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;
            
            -- jika qty berubah
            IF qty_param != get_qty_pembelian THEN
                
                SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
                SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
                SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai

                UPDATE stok SET
                    brg_masuk=((get_brg_masuk-get_qty_pembelian)+qty_param), stok_akhir=((get_stk_awal+(get_brg_masuk-get_qty_pembelian)+qty_param)-get_brg_keluar)
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            end if;

             -- update pembelian total
            -- UPDATE pembelian SET 
            --     kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
            -- WHERE id=id_param;

            UPDATE detail_pembelian SET
                harga=harga_param, qty=qty_param, subtotal=subtotal_param, ket=ket_param
            WHERE id=id_detail_param;

        -- jika barang berubah
        ELSE
            SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param; -- cek tgl
            SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;

            -- jika qty sama
            IF qty_param = get_qty_pembelian THEN
                -- get data lama (A)
                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

                -- get data yg baru (B)
                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

                -- update data lama
                UPDATE stok SET
                    brg_masuk=(brg_masuk_A-qty_param), stok_akhir=(stok_awal_A+(brg_masuk_A-qty_param)-brg_keluar_A)
                WHERE tgl=tgl_param AND kd_barang=kd_barang_pembelian;

                IF cek_tgl > 0 THEN

                    -- update data baru
                    UPDATE stok SET
                        brg_masuk=(brg_masuk_B+qty_param), stok_akhir=(stok_awal_B+(brg_masuk_B+qty_param)-brg_keluar_B)
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
                
                ELSE
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
                    -- tambah stok
                    INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));

                end if;

                -- UPDATE pembelian SET 
                --     kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
                -- WHERE id=id_param;

                UPDATE detail_pembelian SET
                    kd_barang=kd_barang_param, harga=harga_param, subtotal=subtotal_param, ket=ket_param
                WHERE id=id_detail_param;

            -- jika qty berubah
            ELSE

                SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;
                -- pindah barang
                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

                -- get data yg baru (B)
                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

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
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru

                    -- tambah stok
                    INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
                end if;

                -- UPDATE pembelian SET 
                --     kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
                -- WHERE id=id_param;

                UPDATE detail_pembelian SET
                    kd_barang=kd_barang_param, harga=harga_param, qty=qty_param, subtotal=subtotal_param, ket=ket_param
                WHERE id=id_detail_param;

            end if;

        end if;

    ELSE
        UPDATE detail_pembelian SET 
            harga=harga_param, subtotal=subtotal_param, ket=ket_param
        WHERE id=id_detail_param;
    end if;

end;

-- ==============================================================

-- procedure khusus pembelian yg berpengaruh ke pengeluaran
create procedure tambah_pengeluaran_pembelian(
    in kd_pengeluaran_param varchar(16),
    in kd_pembelian_param varchar(16),
    in tgl_param date,
    -- in ket_param text,
    -- in nominal_param double(12,2),
    -- in qty_param SMALLINT,
    -- in total_param double(12,2),
    -- in jenis_param varchar(15),
    in username_param varchar(10)
)
BEGIN
    DECLARE total_pembelian double(12,2);
    DECLARE qty_pembelian int;
    DECLARE ket_pembelian text;
    DECLARE id_kd_pembelian_param int;
    -- dapatkan id kode pmebelian
    SELECT id INTO id_kd_pembelian_param FROM pembelian WHERE kd_pembelian = kd_pembelian_param;
    -- dapatkan total dari detail pembelian
    SELECT SUM(subtotal) into total_pembelian from detail_pembelian where kd_pembelian=id_kd_pembelian_param;
    -- dapatkan qty dari detail pembelian
    SELECT SUM(qty) into qty_pembelian from detail_pembelian where kd_pembelian=id_kd_pembelian_param;
    -- dapatkan keterangan dari detail pembelian
    SELECT GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') into ket_pembelian 
        FROM detail_pembelian dp 
        join barang b on b.id = dp.kd_barang
        join id_barang ib on ib.id = b.id_barang
        join id_warna iw on iw.id = b.id_warna 
        where kd_pembelian=id_kd_pembelian_param;

    -- insert ke pengeluaran
    INSERT INTO pengeluaran(kd_pengeluaran, kd_pembelian, tgl, ket, nominal, qty, total, jenis, username) 
    VALUES(kd_pengeluaran_param, id_kd_pembelian_param, tgl_param, ket_pembelian, total_pembelian, 1, total_pembelian, 'PRODUKSI', username_param);


end;

-- ==============================================================

-- procedure edit pengeluaran khusus pembelian
create procedure edit_pengeluaran_pembelian(
 
    in kd_pembelian_param varchar(16)
    -- in tgl_param date,
    -- in ket_param text,
    -- in nominal_param double(12,2),
    -- in qty_param SMALLINT,
    -- in total_param double(12,2),
    -- in jenis_param varchar(15),

)
BEGIN
    DECLARE total_pembelian double(12,2);
    DECLARE qty_pembelian int;
    DECLARE ket_pembelian text;
    DECLARE id_kd_pembelian_param int;
    -- dapatkan id kode pmebelian
    SELECT id INTO id_kd_pembelian_param FROM pembelian WHERE kd_pembelian = kd_pembelian_param;
    -- dapatkan total dari detail pembelian
    SELECT SUM(subtotal) into total_pembelian from detail_pembelian where kd_pembelian=id_kd_pembelian_param;
    -- dapatkan qty dari detail pembelian
    SELECT SUM(qty) into qty_pembelian from detail_pembelian where kd_pembelian=id_kd_pembelian_param;
    -- dapatkan keterangan dari detail pembelian
    SELECT GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') into ket_pembelian 
        FROM detail_pembelian dp 
        join barang b on b.id = dp.kd_barang
        join id_barang ib on ib.id = b.id_barang
        join id_warna iw on iw.id = b.id_warna 
        where kd_pembelian=id_kd_pembelian_param;

    -- insert ke pengeluaran
    UPDATE pengeluaran SET ket = ket_pembelian, nominal = total_pembelian, total = total_pembelian
        WHERE kd_pembelian = id_kd_pembelian_param;


end;

-- ==============================================================

-- procedure hapus salah satu item di detail penjualan
create procedure hapus_detail_penjualan(

)
BEGIN

end;

-- ==============================================================

-- procedure hapus salah satu item di detail pembelian
create procedure hapus_detail_pembelian(
    in kd_pembelian_param int, -- kd_pembelian
    in kd_barang_param int, -- kd_barang
    in tgl_param date
)
BEGIN
    
    DECLARE tgl_skrng date;
    DECLARE qty_dec smallint;
    DECLARE brg_masuk_dec smallint;
    DECLARE stok_akhir_dec int;
    
    SELECT current_date into tgl_skrng;
    IF tgl_param = tgl_skrng THEN

        -- mendapatkan qty dari datail pembelian
        select qty into qty_dec from detail_pembelian where kd_pembelian=kd_pembelian_param and kd_barang=kd_barang_param;
        -- mendapatkan brg_masuk dari stok
        select brg_masuk into brg_masuk_dec from stok where kd_barang=kd_barang_param and tgl=tgl_param;
        -- mendapatkan stok_akhir dari stok
        select stok_akhir into stok_akhir_dec from stok where kd_barang=kd_barang_param and tgl=tgl_param;
        
        -- kurangi brg_masuk dan stok_akhir dengan qty dari detail_pembelian
        update stok 
            set brg_masuk=(brg_masuk_dec-qty_dec), stok_akhir=(stok_akhir_dec-qty_dec) 
        where kd_barang=kd_barang_param and tgl=tgl_param;

        -- hapus barang pada detail_pembelian
        delete from detail_pembelian where kd_pembelian=kd_pembelian_param and kd_barang=kd_barang_param;

    END IF;
end;

-- ==============================================================

-- =============== VIEW =============== --

CREATE OR REPLACE VIEW v_barang AS
    SELECT 
        b.id, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, 
        b.nama,  b.hpp,  b.harga_pasar, b.market_place, b.harga_ig, b.foto, b.ket, s.stok_akhir stok 
    from 
        stok s 
    join 
        barang b on b.id = s.kd_barang 
    join 
        id_barang ib on ib.id = b.id_barang 
    join 
        id_warna iw on iw.id = b.id_warna 
    where 
        s.id in(SELECT max(id) from stok GROUP by(kd_barang)) 
    ORDER by b.id asc


-- ==============================================================


CREATE OR REPLACE VIEW v_penjualan AS
    SELECT 
        p.id, p.kd_penjualan, tgl, jenis, 
        GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') item, 
        CAST(SUM(dp.subtotal)+p.ongkir as DECIMAL(12,2)) as total, 
        (case when (p.status = '1') then 'NORMAL' else 'FREE' end) status, p.ket 
    FROM penjualan p
    JOIN detail_penjualan dp 
        ON dp.kd_penjualan = p.id
    JOIN barang b
        ON b.id = dp.kd_barang
    JOIN id_barang ib
        ON ib.id = b.id_barang
    JOIN id_warna iw
        ON iw.id = b.id_warna
    GROUP BY p.id

-- ==============================================================

CREATE OR REPLACE VIEW v_pembelian AS
    SELECT
        p.id, p.kd_pembelian, tgl,
        GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') item, 
        CAST(SUM(dp.subtotal) as DECIMAL(12,2)) as total,
        p.ket 
    FROM pembelian p
    JOIN detail_pembelian dp
        ON dp.kd_pembelian = p.id
    JOIN barang b
        ON b.id = dp.kd_barang
    JOIN id_barang ib
        ON ib.id = b.id_barang
    JOIN id_warna iw
        ON iw.id = b.id_warna
    GROUP BY p.id 

-- CREATE OR REPLACE VIEW v_pengeluaran
-- AS
-- SELECT 
--     p.id, p.kd_pembelian, tgl, jenis, 
--     CAST(SUM((dp.harga*dp.qty)-(dp.harga*dp.qty*dp.diskon/100)) as DECIMAL(12,2)) as total, 
--     status, p.ket 
-- FROM penjualan p
-- JOIN detail_penjualan dp 
--     ON dp.kd_penjualan = p.id
-- GROUP BY p.id

-- CREATE OR REPLACE VIEW v_select_barang AS 
-- select 
--     b.id, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, 
--     b.nama, s.stok_akhir stok 
--     from stok s 
--     join barang b on b.id = s.kd_barang 
--     join id_barang ib on ib.id = b.id_barang 
--     join id_warna iw on iw.id = b.id_warna 
--     where s.id in(SELECT max(id) from stok GROUP by(kd_barang)) 
--     ORDER by b.id asc