<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{Request::is('home') ? 'active':''}}" >
                <a href="home"> <i class="fa fa-home"></i> <span>Home</span> </a>
            </li>
            <li class="treeview {{Request::is('master/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-th-large"></i>
                    <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('master/users*') ? 'active':''}}" ><a href="master/users"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li class="{{Request::is('master/customer*') ? 'active':''}}" ><a href="master/customer"><i class="fa fa-circle-o"></i> Customer</a></li>                   
                    <li class="{{Request::is('master/sales*') ? 'active':''}}" ><a href="master/sales"><i class="fa fa-circle-o"></i> Salesman</a></li>
                    <li class="{{Request::is('master/supplier*') ? 'active':''}}" ><a href="master/supplier"><i class="fa fa-circle-o"></i> Supplier</a></li>
                    <li class="{{Request::is('master/satuan*') ? 'active':''}}" ><a href="master/satuan"><i class="fa fa-circle-o"></i> Satuan Barang</a></li>
                    <li class="{{Request::is('master/kategori*') ? 'active':''}}" ><a href="master/kategori"><i class="fa fa-circle-o"></i> Kategori Barang</a></li>
                    <li class="{{Request::is('master/barang*') ? 'active':''}}" ><a href="master/barang"><i class="fa fa-circle-o"></i> Barang</a></li>                    
                    
                </ul>
            </li>
            <li class="treeview {{Request::is('setbar/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span>Pengaturan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('setbar/manstok*') ? 'active':''}}" ><a href="setbar/manstok"><i class="fa fa-circle-o"></i> Barang</a></li>
                    <!--<li class="{{Request::is('setbar/harga*') ? 'active':''}}" ><a href="setbar/harga"><i class="fa fa-circle-o"></i> Harga Barang</a></li>-->
                    
                </ul>
            </li>
            <li class="treeview {{Request::is('pembelian/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-calculator"></i>
                    <span>Pembelian</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('pembelian/beli*') ? 'active':''}}" ><a href="pembelian/beli"><i class="fa fa-circle-o"></i> Pembelian</a></li>                    
                </ul>
            </li>
            <li class="treeview {{Request::is('penjualan/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Penjualan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('penjualan/beli*') ? 'active':''}}" ><a href="penjualan/jual"><i class="fa fa-circle-o"></i> Penjualan</a></li>                    
                </ul>
            </li>

            <!--MENU BARU MENGGUNAKAN AJAX-->
            
            
            <!--Menu Inventory-->
            <li class="treeview {{Request::is('inventory/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Inventory</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('inventory/barang*') ? 'active':''}}" ><a href="inventory/barang"><i class="fa fa-circle-o"></i> Barang</a></li>  
                    <li class="{{Request::is('inventory/kategori*') ? 'active':''}}" ><a href="inventory/kategori"><i class="fa fa-circle-o"></i> Kategori</a></li>        
                    <li class="{{Request::is('inventory/satuan*') ? 'active':''}}" ><a href="inventory/satuan"><i class="fa fa-circle-o"></i> Satuan</a></li>        
                </ul>
            </li>
            <!--Menu Purchase-->
            <li class="treeview" >
                <a href="#">
                    <i class="fa fa-calculator"></i>
                    <span>Purchase</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="" >
                        
                    </li>       
                </ul>
            </li>
            <!--Menu Sales-->
            <li class="treeview" >
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Sales</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="" >
                        
                    </li>  
                </ul>
            </li>

            <!-- <li class="">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Blogs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li> -->
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>