<?php
  	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

  	$notif = isset($_SESSION['notif']) ? $_SESSION['notif'] : false;
  	unset($_SESSION['notif']);
?>

<section class="content-header">
  	<h1>Beranda <small>Dashboard Admin</small></h1>
  	<ol class="breadcrumb">
	  	<li><a href="#"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active">Beranda</li>
    </ol>
</section>
<!-- content -->
<section class="content">
  	<!-- panel 1 -->
  	<div class="row">
    	<!-- panel info penjualan -->
    	<div class="col-lg-3 col-xs-6">
      		<div class="small-box bg-aqua">
        		<div class="inner">
          			<h3 class="info-penjualan"></h3>
          			<p class="label-info-penjualan"></p>
        		</div>
        		<div class="icon">
                	<i class="ion ion-bag"></i>
              	</div>
              	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      		</div>
    	</div>
    	<!-- panel info pembelian -->
    	<div class="col-lg-3 col-xs-6">
            <!-- small box -->
        	<div class="small-box bg-green">
              	<div class="inner">
                  	<h3 class="info-pembelian"></h3>
                  	<p class="label-info-pembelian"></p>
              	</div>
              	<div class="icon">
                  	<i class="ion ion-stats-bars"></i>
              	</div>
              	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- panel info reject -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              	<div class="inner">
                  	<h3 class="info-reject"></h3>
                  	<p class="label-info-reject">Total Item Reject <br>Bulan Ini</p>
              	</div>
              	<div class="icon">
                  	<i class="ion ion-stats-bars"></i>
              	</div>
              	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- panel info return -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              	<div class="inner">
                  	<h3 class="info-return"></h3>
                  	<p class="label-info-return">Total Item Return <br>Bulan Ini</p>
              	</div>
              	<div class="icon">
                	<i class="ion ion-stats-bars"></i>
              	</div>
              	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
  	</div>
  	<!-- panel 2 -->
  	<div class="row">
		<!-- panel grafik penjualan dan laba -->
    	<div class="col-xs-12 col-md-8">
      		<div class="box box-default box-penjualan-laba">
        		<div class="box-header with-border">
          			<h3 class="box-title">Grafik Perbandingan Penjualan dan Laba</h3>
          			<div class="box-tools pull-right">
                    	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              		</div>
        		</div>
        		<!-- grafik -->
        		<div class="box-body">
        			<div class="chart">
              			<canvas id="chart_penjualan_laba"></canvas>
              		</div>
          		</div>
          		<div class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
      		</div>
    	</div>
    	<!-- panel item -->
    	<div class="col-xs-12 col-md-4">
      		<div class="box box-default box-keterangan-item">
        		<div class="box-header with-border">
          			<h3 class="box-title">Keterangan Item</h3>
          			<div class="box-tools pull-right">
                    	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              		</div>
        		</div>
        		<!-- grafik -->
        		<div class="box-body">
              		<div class="nav-tabs-custom">
		    			<ul class="nav nav-tabs">
		              		<li class="active"><a href="#tab_terlaris-1" data-toggle="tab">Terlaris</a></li>
             				<li><a href="#tab_kurang_laku" data-toggle="tab">Kurang Laku</a></li>
             				<!-- <li><a href="#tab_reject" data-toggle="tab">Reject</a></li>
             				<li><a href="#tab_return" data-toggle="tab">Return</a></li> -->
		    			</ul>
		    			<div class="tab-content">
		    				<!-- content terlaris -->
		    				<div class="tab-pane active" id="tab_terlaris">
		    				</div>
		    				<!-- konten kurang laku -->
		    				<div class="tab-pane" id="tab_kurang_laku">
		    				</div>
		    			</div>
		    		</div>
          		</div>
          		<div class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
      		</div>
    	</div>
	</div>
  	<!-- panel 3 -->
  	<div class="row">
    	<!-- panel grafik pengeluaran -->
    	<div class="col-xs-12 col-md-8">
      		<div class="box box-default box-pembelian-pengeluaran">
        		<div class="box-header with-border">
          			<h3 class="box-title">Grafik Pembelian-Pengeluaran</h3>
          			<div class="box-tools pull-right">
                    	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  	</div>
        		</div>
        		<!-- grafik -->
        		<div class="box-body">
            		The body of the box
        		</div>
        		<div class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
      		</div>
    	</div>
    	<!-- panel stok warning -->
    	<div class="col-xs-12 col-md-4">
    		<div class="box box-default box-stok-warning">
    			<div class="box-header with-border">
          			<h3 class="box-title">Stok Warning</h3>
          			<div class="box-tools pull-right">
                    	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  	</div>
        		</div>
        		<!-- grafik -->
        		<div class="box-body">
            		The body of the box
        		</div>
        		<div class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
    		</div>
    	</div>
  	</div>
</section>

<!-- js -->
<script type="text/javascript" src="<?= base_url."assets/plugins/chartjs/Chart.min.js" ?>"></script>
<script type="text/javascript">
    var base_url = "<?php print base_url; ?>";
</script>
<script type="text/javascript">
	$(document).ready(function(){
		// load panel info
		load_panel_info();
		// load panel item
		load_panel_item();
		// load chart penjualan-laba
		var chart_penjualan_laba = $("#chart_penjualan_laba")[0].getContext('2d');
		load_penjualan_laba(function(data){
			var chart = new Chart(chart_penjualan_laba, {
				type: 'line',
				data: data,
				options: {
					title: {
			        	display: true,
			        	text: 'Perbandingan Laba dan Penjualan'
			     	},
			     	tooltips: {
			           	// mode: 'label',
			           	label: 'mylabel',
			           	callbacks: {
			               	label: function(tooltipItem, data){
		                   		return 'Rp. '+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
		                   	},
		               	},
			        },
			     	scales: {
			            yAxes: [{
			                ticks: {
		                    	callback: function(label, index, labels) { return label/1000; },
			                    beginAtZero:true,
			                    fontSize: 10,
			                },
			                scaleLabel: { 
			                    display: true,
			                    labelString: 'Rupiah (K)',
			                    // fontSize: 10,
			                }
			            }],
			            xAxes: [{
			                ticks: {
			                    beginAtZero: true,
			                    // fontSize: 10
			                },
			               //  gridLines: {
			               //      display:false
			               //  },
			                scaleLabel: {
			                    display: true,
			                    labelString: 'Bulan',
			                    // fontSize: 10,
			               	}
			            }]
			        }
				}
			});
		});

	});

	// function load all panel
	function load_panel_info(){
		$.ajax({
			url: base_url+"app/controllers/Beranda.php",
			type: "post",
			dataType: "json",
			data: {
				"action": "get_panel_info"
			},
			success: function(data){
				console.log(data);
				setValue_panelInfo(data);
			},
			error: function (jqXHR, textStatus, errorThrown){ // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            // clearBarang();
	            console.log(jqXHR, textStatus, errorThrown);
	        }
		})
	}

  	// function load char penjualan-laba
  	function load_penjualan_laba(handleData){
  		$.ajax({
			url: base_url+"app/controllers/Beranda.php",
			type: "post",
			dataType: "json",
			data: {
				"action" : "get_chart_penjualan_laba"
			},
			beforeSend: function(){
	            $('.box-penjualan-laba .overlay').css('display', 'block');
	        },
			success: function(data){
				$('.box-penjualan-laba .overlay').css('display', 'none');
				handleData(data);
				console.log(data);
			},
			error: function (jqXHR, textStatus, errorThrown){
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            $('.box-penjualan-laba .overlay').css('display', 'none');
	            console.log(jqXHR, textStatus, errorThrown);
	        } 
		})
  	}

  	// funtion load panel keterang item
  	function load_panel_item(){
  		$.ajax({
			url: base_url+"app/controllers/Beranda.php",
			type: "post",
			dataType: "json",
			data: {
				"action": "get_panel_item"
			},
			success: function(data){
				console.log(data);
				// set_value_panel(data);
			},
			error: function (jqXHR, textStatus, errorThrown){ // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            // clearBarang();
	            console.log(jqXHR, textStatus, errorThrown);
	        }
		})
  	}

	// set value panel info
	function setValue_panelInfo(data){
	    // panel info penjualan
		$('.info-penjualan').text(data.panel_penjualan.total);
		$('.label-info-penjualan').html(data.panel_penjualan.label);

	    // panel info pembelian
	    $('.info-pembelian').text(data.panel_pembelian.total);
	    $('.label-info-pembelian').html(data.panel_pembelian.label);

	    // panel info reject

	    // panel info return
	}

	// set value panel item
	function setValue_panelItem(data){
		
	}

</script>