
-- Mengambil data terbaru stok masing2 barang
select * from stok where id in(SELECT max(id) from stok GROUP by(kd_barang)) ORDER by kd_barang asc 

-- mantab gan :D

select s.tgl, b.kd_barang, b.nama, s.stok_awal, s.brg_masuk, s.brg_keluar, s.stok_akhir 
	from stok s
	join barang b
    	on b.id = s.kd_barang
    where 
    	s.id in(SELECT max(id) from stok GROUP by(kd_barang))
        AND b.id = 1
    ORDER by s.kd_barang asc 


select sum(dp.harga*qty) total 
	from penjualan p 
    join detail_penjualan dp 
    	on dp.kd_penjualan = p.id 
    group by p.id

    SELECT 
    p.kd_penjualan as "Kode Penjualan", 
    GROUP_CONCAT(concat(concat_ws('-', ib.id_barang, iw.id_warna), ' JUMLAH : ', dp.qty) separator ', ') as "Keterangan",
    sum(dp.subtotal) as "Total Harga"
        FROM detail_penjualan dp 
        join barang b on b.id = dp.kd_barang
        join penjualan p on p.id = dp.kd_penjualan
        join id_barang ib on ib.id = b.id_barang
        join id_warna iw on iw.id = b.id_warna
        where dp.kd_penjualan=3

-- query select barang yg sesuai dengan qty
select b.id, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, b.nama, s.stok_akhir stok 
    from stok s
    join barang b on b.id = s.kd_barang
    join id_barang ib on ib.id = b.id_barang
    join id_warna iw on iw.id = b.id_warna
    where s.id 
        in(SELECT max(id) from stok where stok_akhir > 0 GROUP by(kd_barang))
    ORDER by b.id asc