<?php
    Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

?>
    <aside class="main-sidebar">

        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= base_url."assets/dist/img/user2-160x160.jpg"; ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="javascript:;">
                        <i class="fa fa-circle text-success"></i> 
                        Online
                    </a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">
                    Menu Navigasi
                </li>
                <!-- Optionally, you can add icons to the links -->
                
                <!-- menu beranda -->
                <li <?php if(strtolower($m)=="beranda" || !$m) echo "class='active'"; ?> >
                    <a href="<?= base_url; ?>">
                    <i class="fa fa-link"></i> 
                    <span>Beranda</span></a>
                </li>

                <!-- menu data penjualan -->
                <li <?php if(strtolower($m)=="penjualan") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=penjualan&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Penjualan</span></a>
                </li>

                <!-- menu data reject -->
                <li <?php if(strtolower($m)=="reject") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=reject&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Reject</span></a>
                </li>

                <!-- menu data pembelian -->
                <li <?php if(strtolower($m)=="pembelian") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=pembelian&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Pembelian</span></a>
                </li>

                <!-- menu data stok -->
                <li <?php if(strtolower($m)=="stok") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=stok&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Stok</span></a>
                </li>

                <!-- menu data pengeluaran -->
                <li <?php if(strtolower($m)=="pengeluaran") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=pengeluaran&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Pengeluaran</span></a>
                </li>

                <!-- menu data master -->
                <li class="treeview <?php if(strtolower($m)=="id_barang" || strtolower($m)=="id_warna" || strtolower($m)=="barang") echo "active" ?>">
                    <a href="javascript:;"><i class="fa fa-link"></i> 
                        <span>Data Master</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if(strtolower($m)=="id_barang") echo "class='active'" ?> >
                            <a href="<?= base_url."index.php?m=id_barang&p=list"; ?>">Data Id Barang</a>
                        </li>
                        <li <?php if(strtolower($m)=="id_warna") echo "class='active'" ?> >
                            <a href="<?= base_url."index.php?m=id_warna&p=list"; ?>">Data Id Warna</a>
                        </li>
                        <li <?php if(strtolower($m)=="barang") echo "class='active'" ?> >
                            <a href="<?= base_url."index.php?m=barang&p=list"; ?>">Data Barang</a>
                        </li>
                    </ul>
                </li>

                <!-- menu data admin -->
                <li <?php if(strtolower($m)=="admin") echo "class='active'"; ?> >
                    <a href="<?= base_url."index.php?m=admin&p=list"; ?>"><i class="fa fa-link"></i>
                    <span>Data Admin</span></a>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>

    </aside>
