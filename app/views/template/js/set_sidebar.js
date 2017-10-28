if(jQuery.isEmptyObject(urlParams)){
	$('.menu-beranda').addClass('active');
}
else{
	switch(urlParams.m.toLowerCase()){
		// menu penjualan
		case "penjualan":
			$('.menu-penjualan').addClass('active');
			break;

		// menu reject
		case "reject":
			$('.menu-reject').addClass('active');
			break;

		// menu pembelian
		case "member":
			$('.menu-pembelian').addClass('active');
			break;

		// menu stok
		case "Stok":
			$('.menu-stok').addClass('active');
			break;

		// menu pengeluaran
		case "pengelauran":
			$('.menu-pengeluaran').addClass('active');
			break;

		// menu id_barang
		case "id_barang":
			$('.menu-data-master').addClass('active');
			$('.menu-id-barang').addClass('active');
			break;

		// menu id_warna
		case "id_warna":
			$('.menu-data-master').addClass('active');
			$('.menu-id-warna').addClass('active');
			break;

		// menu barang
		case "barang":
			$('.menu-data-master').addClass('active');
			$('.menu-barang').addClass('active');
			break;

		// menu admin
		case "admin":
			$('.menu-admin').addClass('active');
			break;

		// default menu beranda
		default:
			$('.menu-beranda').addClass('active');
			break;
	}
}