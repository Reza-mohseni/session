<?php
require_once '../../../../controllers/helpers/helpers.php';
require_once '../../../../model/database.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | فرم ساده</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= asset('adminpanel/css/adminlte.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="<?= asset('adminpanel/css/bootstrap-rtl.min.css')?>">
    <!-- template rtl version -->
    <link rel="stylesheet" href="<?= asset('adminpanel/css/custom-style.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php  require_once '../layouts/navbar.php';?>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="<?= asset('adminpanel/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">پنل مدیریت</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <?php  require_once '../layouts/sidebar.php';?>
        </div>
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ساخت دسته بندی جدید</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ساخت دسته بندی جدید</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">افزودن دسته</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <section class="col-md-10 pt-3">

                        <section class="mb-2 d-flex justify-content-between align-items-center">
                            <h2 class="h4">نوشته ها</h2>
                            <a href="create.php" class="btn btn-sm btn-success">نوشته جدید</a>
                        </section>

                        <section class="table-responsive">
                            <table class="table table-striped table-">
                                <thead>

                                <tr>
                                    <th>آیدی</th>
                                    <th>تصویر</th>
                                    <th>عنوان</th>
                                    <th>نام دسته بندی</th>
                                    <th>خلاصه</th>
                                    <th>وضعیت</th>
                                    <th>پیکربندی</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                global $pdo;
                                $columns = ['*'];
                                $tableName = "posts";
                                $results = selectFromTable($pdo, $tableName, $columns, []);
                                foreach ($results as $post)
                                {
                                ?>
                                <tr>
                                    <td><?= $post['id'] ?></td>
                                    <td>
                                        <img style="width: 90px;" src="">

                                    </td>
                                    <td><?= $post['titel'] ?></td>
                                    <td><?= $post['cat_id'] ?></td>
                                    <td><?= substr($post['body'],0,20)."..." ?></td>
                                    <td>
                                        <?php
                                        if ($post['status']==1)
                                        {
                                        ?>
                                        <span class="text-success"> فعال</span>
                                        <?php }else{ ?>
                                        <span class="text-danger">غیر فعال</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm">تغییر وضعیت</a>
                                        <a href="" class="btn btn-info btn-sm">ویرایش</a>
                                        <a href="" class="btn btn-danger btn-sm">حذف</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </section>


                    </section>


    </section>

                </div>


        <!-- /.card-body -->

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
</footer>

<!-- Control Sidebar -->
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= asset('adminpanel/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= asset('adminpanel/plugins/fastclick/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= asset('adminpanel/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= asset('adminpanel/js/demo.js') ?>"></script>
</body>
</html>
