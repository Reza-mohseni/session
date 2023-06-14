<?php
?>
<!-- Sidebar -->

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="<?= url('views/adminpanel/') ?>" class="nav-link ">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                    داشبورد
                </p>
            </a>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fa fa-edit"></i>
                    <p>
                        نوشته ها
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= url("views/adminpanel/pages/post")?>" class="nav-link ">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>همه نوشته ها</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= url('views/adminpanel/pages/post/create.php')?>" class="nav-link ">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>افزون نوشته</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= url('views/adminpanel/pages/category/index.php') ?>" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>دسته بندی ها</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= url('views/adminpanel/pages/category/create.php') ?>" class="nav-link ">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>افزودن دسته بندی</p>
                        </a>
                    </li>
                </ul>
            </li>


</nav>
<!-- /.sidebar-menu -->
</div>
</div>
<!-- /.sidebar -->
</aside>
