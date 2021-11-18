<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-edit"></i>
    </div>
    <div class="sidebar-brand-text mx-3">PIMS</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php echo ($page == "" || $page == "home") ? 'active' : ""; ?>">
    <a class="nav-link" href="./">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <?php
  if ($_SESSION['category'] == 'AA') {
  ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Master Data
    </div>

    <li class="nav-item <?php echo $page == "items"  ? "active" : ""; ?>">
      <a class="nav-link" href="index.php?page=items">
        <i class="fas fa-fw fa-cubes"></i>
        <span>Items</span></a>
    </li>

    <li class="nav-item <?php echo $page == "packaging"  ? "active" : ""; ?>">
      <a class="nav-link" href="index.php?page=packaging">
        <i class="fas fa-fw fa-list"></i>
        <span>Unit</span></a>
    </li>

    <li class="nav-item <?php echo $page == "suppliers"  ? "active" : ""; ?>">
      <a class="nav-link" href="index.php?page=suppliers">
        <i class="fas fa-fw fa-truck"></i>
        <span>Suppliers</span></a>
    </li>


    <li class="nav-item <?php echo $page == "users"  ? "active" : ""; ?>">
      <a class="nav-link" href="index.php?page=users">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span></a>
    </li>
  <?php } ?>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Transaction
  </div>

  <?php
  if ($_SESSION['category'] == 'BAC' || $_SESSION['category'] == 'AA') {
  ?>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=purchase-request">
        <i class="fas fa-fw fa-file"></i>
        <span>Purchase Request</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=canvass">
        <i class="fas fa-fw fa-search"></i>
        <span>Canvassing</span></a>
    </li>
  <?php } ?>
  <li class="nav-item">
    <a class="nav-link" href="index.php?page=purchase-order">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Purchase Order</span></a>
  </li>

  <?php
  if ($_SESSION['category'] == 'AA') {
  ?>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=receiving">
        <i class="fas fa-fw fa-receipt"></i>
        <span>Receive Stocks</span></a>
    </li>
  <?php } ?>

  <?php
  if ($_SESSION['category'] == 'PC' || $_SESSION['category'] == 'AA') {
  ?>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=release">
        <i class="fas fa-fw fa-truck"></i>
        <span>Release Stocks</span></a>
    </li>
  <?php } ?>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Reports
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <!--<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Tickets</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="#">Tickets Inventory</a>
        <a class="collapse-item" href="#">Daily sales</a>
        <a class="collapse-item" href="#">Monthly sales</a>
      </div>
    </div>
  </li>-->

  <!-- Reports -->
  <li class="nav-item">
    <a class="nav-link" href="index.php?page=inventory">
      <i class="fas fa-fw fa-pen"></i>
      <span>Inventory</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="index.php?page=stock-card">
      <i class="fas fa-fw fa-list"></i>
      <span>Stock Card</span></a>
  </li>

  <!--<li class="nav-item">
    <a class="nav-link" href="./">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Monthly Budget</span></a>
  </li>-->


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>