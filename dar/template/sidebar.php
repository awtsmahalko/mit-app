
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <div style="text-align:center;">
                <img class="img-profile" src="img/dar.png" style="width:100px;">
            </div>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">CARPER LAD Form Generator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?=$page=='home'?'active':'';?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <li class="nav-item <?=$page=='arb'?'active':'';?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBeneficiaries"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Beneficiaries</span>
                </a>
                <div id="collapseBeneficiaries" class="collapse <?=$page=='arb'?'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?=$page=='arb'?'active':'';?>" href="index.php?page=arb">ARB's</a>
                        <a class="collapse-item" href="index.php?page=non_arb">NON ARB's</a>
                    </div>
                </div>
            </li>


            <li class="nav-item <?=$page=='land'?'active':'';?>">
                <a class="nav-link" href="index.php?page=land">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Lands</span></a>
            </li>

            <li class="nav-item <?=$page=='cloa'?'active':'';?>">
                <a class="nav-link" href="index.php?page=cloa">
                    <i class="fas fa-fw fa-certificate"></i>
                    <span>CLOA</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reports
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item <?=$page=='forms'?'active':'';?>">
                <a class="nav-link" href="index.php?page=forms">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Forms</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->