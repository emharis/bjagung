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
                    <li class="{{Request::is('inventory/adjustment*') ? 'active':''}}" ><a href="inventory/adjustment"><i class="fa fa-circle-o"></i> Inventory Adjustment</a></li>
                </ul>
            </li>
            <!--Menu Purchase-->
            <li class="treeview {{Request::is('purchase/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-calculator"></i>
                    <span>Purchase</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is('purchase/order/add') ? 'active':''}}" ><a href="purchase/order/add"><i class="fa fa-circle-o"></i> Add Purchase Orders</a></li>
                    <li class="{{Request::is('purchase/order*') ? 'active':''}}" ><a href="purchase/order"><i class="fa fa-circle-o"></i> Purchase Orders</a></li>
                    <li class="{{Request::is('purchase/supplier*') ? 'active':''}}" ><a href="purchase/supplier"><i class="fa fa-circle-o"></i> Supplier</a></li>
                    <li class="{{Request::is('purchase/report*') ? 'active':''}}" ><a href="purchase/report"><i class="fa fa-circle-o"></i> Reports</a></li>

                </ul>
            </li>
            <!--Menu Sales-->
            <li class="treeview {{Request::is('sales/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Sales</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="" >
                        <li class="{{Request::is('sales/order/add') ? 'active':''}}" ><a href="sales/order/add"><i class="fa fa-circle-o"></i> Add Sales Orders</a></li>
                        <li class="{{Request::is('sales/order*') ? 'active':''}}" ><a href="sales/order"><i class="fa fa-circle-o"></i> Sales Orders</a></li>
                        <li class="{{Request::is('sales/customer*') ? 'active':''}}" ><a href="sales/customer"><i class="fa fa-circle-o"></i> Customer</a></li>
                        <li class="{{Request::is('sales/salesman*') ? 'active':''}}" ><a href="sales/salesman"><i class="fa fa-circle-o"></i> Salesperson</a></li>
                    </li>
                </ul>
            </li>
            <!--Menu Invoicing-->
            <li class="treeview {{Request::is('invoice/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Invoices</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="" >
                        <li class="{{Request::is('invoice/customer-invoice*') ? 'active':''}}" ><a href="invoice/customer-invoice"><i class="fa fa-circle-o"></i> Customer Invoices</a></li>
                        <li class="{{Request::is('invoice/customer/payment*') ? 'active':''}}" ><a href="invoice/customer/payment"><i class="fa fa-circle-o"></i> Customer Payments</a></li>
                        <li class="{{Request::is('invoice/supplier-bill*') ? 'active':''}}" ><a href="invoice/supplier-bill"><i class="fa fa-circle-o"></i> Supplier Bills</a></li>
                        {{-- <li class="{{Request::is('invoice/supplier/bill-payment*') ? 'active':''}}" ><a href="invoice/supplier/bill-payment"><i class="fa fa-circle-o"></i> Bill Payments</a></li>          --}}
                    </li>
                </ul>
            </li>
            <li class="treeview {{Request::is('cashbook/*') ? 'active':''}}" >
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Cash Flow</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="" >
                        <li class="{{Request::is('cashbook/expense*') ? 'active':''}}" ><a href="cashbook/expense"><i class="fa fa-circle-o"></i> Cash Expense</a></li>

                        <li class="{{Request::is('cashbook/receipt*') ? 'active':''}}" ><a href="cashbook/receipt"><i class="fa fa-circle-o"></i> Cash Receipt</a></li>

                        <li class="{{Request::is('cashbook/pettycash*') ? 'active':''}}" ><a href="cashbook/pettycash"><i class="fa fa-circle-o"></i> Petty Cash</a></li>
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
