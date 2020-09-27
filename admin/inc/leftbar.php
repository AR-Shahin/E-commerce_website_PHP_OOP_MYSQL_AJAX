
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    <li class="nav-item ">
                        <a class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>" href="./index.php"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'category.php' ? 'active' : '' ?>" href="#" data-toggle="collapse" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Category</a>
                        <div id="submenu-2" class="collapse submenu <?= $page == 'category.php' ? 'show' : '' ?>" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item active">
                                    <a class="nav-link <?= $page == 'category.php' ? 'active' : '' ?>" href="category.php">Category</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'brand.php' ? 'active' : '' ?>" href="#" data-toggle="collapse" data-target="#submenu-brand" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Brand</a>
                        <div id="submenu-brand" class="collapse submenu <?= $page == 'brand.php' ? 'show' : '' ?>" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item active">
                                    <a class="nav-link <?= $page == 'brand.php' ? 'active' : '' ?>" href="brand.php">Brand</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'addproduct.php' ? 'active' : '' ?> <?= $page == 'manageproduct.php' ? 'active' : '' ?>" href="#" data-toggle="collapse" data-target="#submenu-product" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Product</a>
                        <div id="submenu-product" class="collapse submenu <?= $page == 'addproduct.php' ? 'show' : '' ?> <?= $page == 'manageproduct.php' ? 'show' : '' ?>" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item active">
                                    <a class="nav-link <?= $page == 'addproduct.php' ? 'active' : '' ?>" href="addproduct.php">Add Product</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link <?= $page == 'manageproduct.php' ? 'active' : '' ?>" href="manageproduct.php">Manage Product</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">