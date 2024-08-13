<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
   <div class="sidebar-header">
    <img src="<?php echo base_url('images/'.$setting->logo) ?>" style="width: 120px; height: auto;">
    <div style="font-size: 20px; color: #333;"><?php echo $setting->nama_toko ?></div>
</div>
    <div class="sidebar-menu">
        <ul class="menu">
            
                
                <li class='sidebar-title'>Main Menu</li>
                 
            
                
                <li class="sidebar-item <?= ($currentMenu == 'home') ? 'active' : '' ?>">

                   <a href="<?= base_url("home")?>" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>Dashboard</span>
                    </a>

                    
                </li>
                
                <?php
if(session()->get('level')==1)
{
?>
                
                 <li class="sidebar-item <?= ($currentMenu == 'produk' || $currentMenu == 'tambahproduk'|| $currentMenu == 'editproduk') ? 'active' : '' ?>">

                    <a href="<?= base_url("home/produk")?>" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i> 
                        <span>Produk</span>
                    </a>
                     </li> 

                    <?php
    }else{

    }?>   
                    
               

                <?php
if(session()->get('level')==3|| session()->get('level')==1)
{
?>

                <li class="sidebar-item <?= ($currentMenu == 'pesanan') ? 'active' : '' ?>">

                    <a href="<?= base_url("home/pesanan")?>" class='sidebar-link'>
                        <i data-feather="grid" width="20"></i> 
                        <span>Pesanan</span>
                    </a>

                    <?php
    }else{

    }?>  
    
                    
                </li>

<?php
if(session()->get('level')==1)
{
?>
                <li class="sidebar-item has-sub <?= ($currentMenu == 'datauser'|| $currentMenu == 'tambahuser'|| $currentMenu == 'edituser') ? 'active' : '' ?>">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="file-plus" width="20"></i> 
                        <span>Manajemen User</span>
                    </a>

                    
                    <ul class="submenu ">
                        
                       
                       <li class="<?= ($currentMenu == 'datauser') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/datauser")?>">Data User</a>
                        </li>
                        
                        
                    </ul>
                    
                </li>


                
                <?php
    }else{

    }?> 
            

            <?php
if(session()->get('level')==2|| session()->get('level')==1)
{
?>
                
               


                
            
                
                 <li class="sidebar-item <?= ($currentMenu == 'menukeranjang') ? 'active' : '' ?>">

                    <a href="<?= base_url("home/menukeranjang")?>" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i> 
                        <span>Menu</span>
                    </a>

                    
                </li>
                
            
                
                 <li class="sidebar-item <?= ($currentMenu == 'history') ? 'active' : '' ?>">

                    <a href="<?= base_url("home/history")?>" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i> 
                        <span>Riwayat Pesanan</span>
                    </a>

                    
                </li>

                <li class="sidebar-item <?= ($currentMenu == 'pembayaran') ? 'active' : '' ?>">

                    <a href="<?= base_url("home/pembayaran")?>" class='sidebar-link'>
                        <i data-feather="trending-up" width="20"></i> 
                        <span>Pembayaran</span>
                    </a>

                    
                </li>

                <?php
    }else{

    }?> 

                 <?php
if(session()->get('level')==1)
{
?>
                <li class="sidebar-item has-sub <?= ($currentMenu == 'laporan' || $currentMenu == 'nota') ? 'active' : '' ?>">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i> 
                        <span>Laporan</span>
                    </a>

                    <ul class="submenu ">
                        
                        <li class="<?= ($currentMenu == 'laporan') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/laporan")?>">Laporan Pesanan</a>
                        </li>
                        
                         <li class="<?= ($currentMenu == 'nota') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/formnota")?>">Nota Pembeli</a>
                        </li>
                        
                        
                    </ul>

                    
                </li>
                
            
            <?php
    }else{

    }?> 

 <?php
if(session()->get('level')==1)
{
?>
    <li class='sidebar-title'>Pages</li>
                
           
                
                 <li class="sidebar-item <?= ($currentMenu == 'log' ) ? 'active' : '' ?>">

                    <a href="<?= base_url("home/log")?>" class='sidebar-link'>
                        <i data-feather="user" width="20"></i> 
                        <span>Activity Log</span>
                    </a>

                    
                </li>

                 <li class="sidebar-item has-sub <?= ($currentMenu == 'reproduk' || $currentMenu == 'reuser' || $currentMenu == 'repesanan' || $currentMenu == 'rekeranjang') ? 'active' : '' ?>">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="trash" width="20"></i> 
                        <span>Restore</span>
                    </a>

                    <ul class="submenu ">
                        
                        <li class="<?= ($currentMenu == 'reproduk') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/reproduk")?>">Restore Produk</a>
                        </li>
                        
                         <li class="<?= ($currentMenu == 'reuser') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/reuser")?>">Restore User</a>
                        </li>

                       <!--  <li class="<?= ($currentMenu == 'rekeranjang') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/rekeranjang")?>">Restore Keranjang</a>
                        </li> -->
                         
                          <li class="<?= ($currentMenu == 'repesanan') ? 'active' : '' ?>">
                            <a href="<?= base_url("home/repesanan")?>">Restore Pesanan</a>
                        </li>
                        
                    </ul>

                    
                </li>
                
               
               

   <?php
    }else{

    }?>   
            
                
              
            
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        <div class="avatar bg-success me-3">
                                            <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                        </div>
                                        <div>
                                            <h6 class='text-bold'>New Order</h6>
                                            <p class='text-xs'>
                                                An order made by Ahmad Saugi for product Samsung Galaxy S69
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       
<?php
if(session()->get('level')==1)
{
?>
                         <li class="dropdown nav-icon me-2">

                    <a href="<?= base_url("home/logonama")?>" >
                        <i data-feather="settings" width="20"></i> 
                        <span>Setting</span>
                    </a>

                    
                </li>
                <?php
    }else{

    }?> 

                        <li class="dropdown nav-icon me-2">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" >
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("home/logout")?>"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?= session()->get('nama')?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="<?= base_url("home/profile/". session()->get('id') )?>"><i data-feather="user"></i> Account</a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("home/logout")?>"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
