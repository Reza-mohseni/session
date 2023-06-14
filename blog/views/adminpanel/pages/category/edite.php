<?php
require_once '../../../../controllers/helpers/helpers.php';
require_once '../../../../model/database.php';
if (!isset($_GET['cat_id'])){
   redirect('views/adminpanel/pages/category/');
}
//dd($_POST['cat_id']);
global $pdo;
$columns = ['*'];
$tableName = "categories";
$conditions =[
 "id" => $_GET['cat_id']
];

 $results = selectFromTable($pdo, $tableName, $columns, $conditions);
// dd($results);

if ($results===false){
    redirect('views/adminpanel/pages/category/');
}
$resultsselect=$results[0];

if (isset($_POST['name']) && $_POST['description'] !== "") {

    $tableName = "categories";
    $data = [
        "name" => $_POST['name'],
        "update_at" => date('Y-m-d H:i:s'),
        "description" => $_POST['description']
    ];
    $conditions = [
        "id" => $_POST['cat_id']
    ];
    updateTable($pdo,$tableName,$data,$conditions);
    redirect('views/adminpanel/pages/category/');
}


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
                    <form role="form" action="<?= url('views/adminpanel/pages/category/edite.php?cat_id='.$_GET['cat_id']) ?>" name="frmcreate_cat" method="post">
                        <!-- text input -->
                        <input type="hidden" name="cat_id" value="<?= $_GET['cat_id'] ?>">
                        <div class="form-group">
                            <label>نام دسته بندی</label>

                            <input type="text" class="form-control" value="    <?= $resultsselect["name"]?>" name="name">
                        </div>


                        <!-- textarea -->
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control" rows="3"  name="description"><?= $resultsselect["description"]?></textarea>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning" name="submit">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-md-6">





            </form>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!--/.col (right) -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
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