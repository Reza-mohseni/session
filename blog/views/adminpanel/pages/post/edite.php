<?php
require_once '../../../../controllers/helpers/helpers.php';
require_once '../../../../model/database.php';
global $pdo;

if (!isset($_GET['post_id']))
{
    redirect('views/adminpanel/pages/post/');

}


$columns = ['*'];
$tableName = "posts";
$conditions =[
    "id" => $_GET['post_id']
];

$posts = selectFromTable($pdo, $tableName, $columns, $conditions);
$post=$posts[0];
if ($posts===false){
    redirect('views/adminpanel/pages/post/');
}

if(
    isset($_POST['title']) && $_POST['title'] !== ''
   && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
    &&  isset($_POST['body']) && $_POST['body'] !== '')
    {

    }

if (isset($_FILES['image']) && $_FILES['image']['name'] !== '' ) {

    $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (!in_array($imageMime, $allowedMimes)) {
        redirect('views/adminpanel/pages/post');
    }
    $basePath = dirname(dirname(__DIR__));
    if (file_exists($basePath . $post->image)) {
        unlink($basePath . $post->image);
    }


    $image = '/assets/images/posts/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
    $columns1 = ['*'];
    $tableName = "categories";
    $conditions = [
        "id" => $_POST['cat_id']
    ];
    $results1 = selectFromTable($pdo, $tableName, $columns1, $conditions);


    if($results1 !== false && $image_upload !== false)
    {

        $tableName = "posts";
        $data = [
            "titel" => $_POST['title'],
            "cat_id" => $_POST['cat_id'],
            "body" => $_POST['body'],
            "update_at"=>date('Y-m-d H:i:s'),
            "image" => $image
        ];
        $conditions1 = [
            "id" => $_GET['post_id']
        ];
        updateTable($pdo, $tableName, $data, $conditions1);
    }   else{
        if($results1 !== false )
        {

            $tableName1 = "posts";
            $data = [
                "titel" => $_POST['title'],
                "cat_id" => $_POST['cat_id'],
                "body" => $_POST['body'],
                "update_at"=>date('Y-m-d H:i:s'),
            ];
            $conditions2=[
                "id" => $_GET['post_id']
            ];
            updateTable($pdo, $tableName1, $data, $conditions2);
        }
}




        redirect('views/adminpanel/post');

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
                    <h1>ساخت پست جدید</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ساخت پست جدید</li>
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
                    <h3 class="card-title">افزودن پست</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?= url('views/adminpanel/pages/post/edite.php?post_id='.$_GET['post_id']) ?>" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $post['titel'] ?>">
                        </section>
                        <section class="form-group">
                            <label for="image">عکس</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img style="width: 90px;" src="<?php echo asset($post['image']) ?>" >

                        </section>
                        <section class="form-group">
                            <label for="cat_id">دسته بندی</label>
                            <select class="form-control" name="cat_id" id="cat_id">
                                <?php
                                global $pdo;
                                $columns = ['*'];
                                $tableName = "categories";
                                $results = selectFromTable($pdo, $tableName, $columns, []);

                                foreach ($results as $cat)
                                { ?>
                                    <option value="<?= $cat['id'] ?>" <?php if($cat['id']==$post['cat_id']) { echo 'selected'; } ?>>  <?= $cat['name'] ?> </option>
                                <?php } ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">متن پست</label>
                            <textarea class="form-control" name="body" id="body" rows="5" ><?= $post['body'] ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">ویرایش پست</button>
                        </section>
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

