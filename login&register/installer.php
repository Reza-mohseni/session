<?php
include "controllers/functions/FileNemeCheck.php";
$errorfile='';
checkfilename();

$error="";
?>
<html>
<head>
    <link href="view/assts/bootstrap/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    <style>

    </style>
</head>
<body dir="rtl">
<div class="container">
    <div class="row">
        <div class="col-5 mx-auto my-5">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center"> راه اندازی</h3>
                </div>
                <div class="card-body">
                    <form method="post" class="numbers">

                        <div class="mb-4">
                            <?php
                            if ( $errorfile !== '' )
                            {
                                echo 'خطا=' . $error;
                            }
                            ?>
                            <label class="form-label text-right">نام دیتابیس خود را وارد </label>
                            <input type="text" class="form-control form-start" name="dbname">

                            <div class="mb-3">
                                <label class="form-label text-right">نام کاربری دیتابیس خود را وارد کنید </label>
                                <input type="username" class="form-control form-start" name="dbusername">

                            </div>
                            <div class="mb-3">
                                <label class="form-label text-right">پسورد دیتابیس خود را وارد کنید </label>
                                <input type="password" class="form-control form-start" name="dbpassword">

                            </div>


                            <button type="submit" class="btn btn-outline-secondary" name="submit">نصب دیتابیس</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>