-- procedure edit reject
create procedure edit_reject(
	in id_param int,
    in kd_penjualan_param int,
    in tgl_param date,
    in kd_barang_param int,
    in qty_param SMALLINT,
    in kd_barang_ganti_param int,
    in hpp_param double(8,2),
    in harga_param double(8,2),
    in ongkir_param double(8,2),
    in total_param double(12,2),
    in rugi_param double(8,2),
    in ket_param text,
    in username_param varchar(10)
)
BEGIN

    DECLARE tgl_skrng date;
    DECLARE kd_barang_reject int;
    DECLARE get_qty_reject SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE cek_tgl SMALLINT;
    DECLARE cek_tgl_2 SMALLINT;
    DECLARE stok_awal_A int;
    DECLARE stok_awal_B int;
    DECLARE brg_masuk_A SMALLINT;
    DECLARE brg_masuk_B SMALLINT;
    DECLARE brg_keluar_A SMALLINT;
    DECLARE brg_keluar_B SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE stok_akhir_param_2 int;

    SELECT current_date into tgl_skrng;
    -- get data penjualan
    SELECT kd_barang_ganti into kd_barang_reject FROM reject WHERE id=id_param; -- kd barang lama

    -- cek tgl asli dgn tgl skrng
    IF tgl_param = tgl_skrng THEN -- jika tgl penjualan dan tgl edit sama, maka boleh edit barang dan qty

        -- jika barang sama
        IF kd_barang_ganti_param = kd_barang_reject THEN

            SELECT qty into get_qty_reject FROM reject WHERE id=id_param;
            
            -- jika qty berubah
            IF qty_param != get_qty_reject THEN
                
                SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; -- get data stok_awal terbaru yg sesuai
                SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; -- get data brg_keluar terbaru yg sesuai
                SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; -- get data brg_masuk terbaru yg sesuai

                UPDATE stok SET
                    brg_keluar=(get_brg_keluar+(qty_param-get_qty_reject)), stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_reject)))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
            end if;

            -- update penjualan total
            UPDATE reject SET 
                kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
                harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
            WHERE id=id_param;

        -- jika barang berubah
        ELSE
            SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param; -- cek tgl data baru
            SELECT count(tgl) into cek_tgl_2 FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_reject; -- cek tgl data lama
            SELECT qty into get_qty_reject FROM reject WHERE id=id_param;

            -- jika qty sama
            IF qty_param = get_qty_reject THEN

                -- get data lama (A)
                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;

                IF cek_tgl_2 > 0 THEN

                    -- update data lama
                    UPDATE stok SET
                        brg_keluar=(brg_keluar_A-qty_param), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_reject;
                ELSE
                    -- insert
                    SELECT stok_akhir into stok_akhir_param_2 from stok WHERE kd_barang=kd_barang_reject ORDER BY id DESC LIMIT 1;

                    -- tambah stok
                    INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_reject,stok_akhir_param_2,'','',stok_akhir_param_2);            

                end if;    

                -- get data yg baru (B)
                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 

                IF cek_tgl > 0 THEN

                    -- update data baru
                    UPDATE stok SET
                        brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
                
                ELSE
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_ganti_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru
        
                    -- tambah stok
                    INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_ganti_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

                end if;

                UPDATE reject SET 
	                kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
	                harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
	            WHERE id=id_param;

            -- jika qty berubah
            ELSE

                SELECT qty into get_qty_reject FROM reject WHERE id=id_param;
                -- pindah barang
                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;

                -- get data yg baru (B)
                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 

                -- update data lama
                UPDATE stok SET
                    brg_keluar=(brg_keluar_A-get_qty_reject), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-get_qty_reject))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_reject;

                IF cek_tgl > 0 THEN

                    -- update data baru
                    UPDATE stok SET
                        brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
                
                ELSE
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; -- get data stok_akhir terbaru

                    -- tambah stok
                    INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_ganti_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
                end if;

                UPDATE reject SET 
	                kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
	                harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
	            WHERE id=id_param;

            end if;

        end if;

    ELSE
        -- update biasa selain barang dan qty
        UPDATE reject SET 
            ongkir=ongkir_param, ket=ket_param, username=username_param
        WHERE id=id_param;
    end if;

end;