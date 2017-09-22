<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

?>

<!-- Main Header -->
<header class="main-header">
    
    <!-- Logo -->
    <a href="index2.html" class="logo">
      	<!-- mini logo for sidebar mini 50x50 pixels -->
      	<span class="logo-mini"><b>Z</b>H</span>
      	<!-- logo for regular state and mobile devices -->
      	<span class="logo-lg"><b>Zaco</b>Hijab</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      	
      	<!-- Sidebar toggle button-->
      	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        	<span class="sr-only">Toggle navigation</span>
      	</a>
      	
      	<!-- Navbar Right Menu -->
      	<div class="navbar-custom-menu">
        	<ul class="nav navbar-nav">
          		<!-- User Account Menu -->
          		<li class="dropdown user user-menu">
            		<!-- Menu Toggle Button -->
            		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              			<!-- The user image in the navbar-->
              			<img src="<?= base_url."assets/dist/img/user2-160x160.jpg"; ?>" class="user-image" alt="User Image">
              			<!-- hidden-xs hides the username on small devices so only the image appears. -->
              			<span class="hidden-xs">Alexander Pierce</span>
            		</a>
            		<ul class="dropdown-menu">
              			<!-- The user image in the menu -->
              			<li class="user-header">
                			<img src="<?= base_url."assets/dist/img/user2-160x160.jpg"; ?>" class="img-circle" alt="User Image">
                			<p>
                  				Alexander Pierce - Web Developer
                  				<small>Member since Nov. 2012</small>
                			</p>
              			</li>
              			<!-- Menu Body -->
	              		<li class="user-body">
	                		<div class="row">
	                  			<div class="col-xs-4 text-center">
	                    			<a href="javascript:;">Followers</a>
	                  			</div>
	                  			<div class="col-xs-4 text-center">
	                    			<a href="javascript:;">Sales</a>
	                  			</div>
	                  			<div class="col-xs-4 text-center">
	                    			<a href="javascript:;">Friends</a>
	                  			</div>
	                		</div>
	                		<!-- /.row -->
	              		</li>
	              		<!-- Menu Footer-->
	              		<li class="user-footer">
	                		<div class="pull-left">
	                  			<a href="javascript:;" class="btn btn-default btn-flat">Profile</a>
	                		</div>
	                		<div class="pull-right">
	                  			<a href="<?= base_url."logout.php"; ?>" class="btn btn-default btn-flat">Sign out</a>
	                		</div>
	              		</li>
	            	</ul>
          		</li>
          		<!-- Control Sidebar Toggle Button -->
          		<li>
            		<a href="javascript:;" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          		</li>
        	</ul>
    	</div>
    </nav>
</header>