<?php

require_once 'database.php';
require_once 'functions.php';
$error = '';
global $pdo;
if (
    isset( $_POST[ 'first_name' ] ) && $_POST[ 'first_name' ] !== '' &&
    isset( $_POST[ 'last_name' ] ) && $_POST[ 'last_name' ] !== '' &&
    isset( $_POST[ 'phone' ] ) && $_POST[ 'phone' ] !== '' &&
    isset( $_POST[ 'national_code' ] ) && $_POST[ 'national_code' ] !== '' &&
    isset( $_POST[ 'password' ] ) && $_POST[ 'password' ] !== '' &&
    isset( $_POST[ 'confirm' ] ) && $_POST[ 'confirm' ] !== ''
)
{
    if ( $_POST[ 'password' ] === $_POST[ 'confirm' ] )
    {
        if ( nationalcode( $_POST[ 'national_code' ] ) === true )
        {
            if ( phone( $_POST[ 'phone' ] ) === true )
            {
                if ( checkstring( $_POST[ 'last_name' ] ) === true )
                {
                    if ( checkstring( $_POST[ 'first_name' ] ) === true )
                    {
                        if ( checkpass( $_POST[ 'password' ] ) === true )
                        {
                            if ( strlen( $_POST[ 'password' ] ) > 8 )
                            {
                                $query     = 'SELECT * FROM session.users WHERE national_code = ?';
                                $statement = $pdo->prepare( $query, [ $_POST[ 'national_code' ] ] );
                                $statement->execute();
                                $user = $statement->fetch();
                                if ( $user === false )
                                {
                                    $query     = 'INSERT INTO session.users SET  first_name = ?, last_name = ?, phone = ?, national_code = ?, password = ?, create_at = now() ;';
                                    $password  = password_hash( $_POST[ 'password' ], PASSWORD_DEFAULT );
                                    $statement = $pdo->prepare( $query, [ $_POST[ 'first_name' ], $_POST[ 'last_name' ], $_POST[ 'phone' ], $_POST[ 'national_code' ], $password ] );
                                    $statement->execute();
//                                redirect('index.php');
                                }
                                else
                                {
                                    $error = 'شما قبلا ثبت نام کرده اید';
                                }
//                              $query = 'SELECT * FROM session.users WHERE national_code = ?';
//                              $statement = $pdo->prepare($query);
//                              $statement->execute([$_POST['national_code']]);
//                              $user = $statement->fetch();
//
//                              if ($user === false) {
//                                  $query = "INSERT INTO session.users (first_name, last_name, phone, national_code, password)
//                VALUES (:first_name, :last_name, :phone, :national_code, :password)";
//                                  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//                                  $statement = $pdo->prepare($query);
//                                  $statement->execute([
//                                      ':first_name' => $_POST['first_name'],
//                                      ':last_name' => $_POST['last_name'],
//                                      ':phone' => $_POST['phone'],
//                                      ':national_code' => $_POST['national_code'],
//                                      ':password' => $password
//                                  ]);
//                                  redirect('/login.php');
//                              } else {
//                                  $error = 'شما قبلا ثبت نام کرده اید';
//                              }

                            }
                            else $error = 'رمز عبور باید حداقل 8 کارکتر باشد';
                        }
                        else $error = 'پسورد باید حداقل یک حرف بزرک و یک حرف کوچک و یک عدد و علامت هایی مثل @#$ داشته باشد';
                    }
                    else
                    {
                        $error = 'لطفا نام خود را به فارسی وارد کنید';
                    }

                }
                else
                {
                    $error = 'لطفا فامیل خود را به فارسی فارد کنید';
                }
            }
            else
            {
                $error = 'شماره موبایل صحیح نمی باشد';
            }
        }
        else
        {
            $error = 'کدملی وارد شده صحیح نمی باشد';
        }
    }
    else
    {
        $error = 'رمز عبور با تکرار رمز عبور مطابقت ندارد';
    }
}


?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    <style>

    </style>
</head>
<body dir="rtl">
<div class="container">
    <div class="row">
        <div class="col-5 mx-auto my-5">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center"> عضویت</h3>
                </div>
                <div class="card-body">
                    <form method="post" class="numbers"
                    ">
                    <div class="text-danger">
                        <?php
                        if ( $error !== '' )
                        {
                            echo 'خطا=' . $error;
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-right">نام </label>
                        <input type="text" class="form-control form-start" name="first_name">

                    </div>
                    <div class="mb-3">
                        <label class="form-label ">نام خانوادگی </label>
                        <input type="text" class="form-control form-start" name="last_name">

                    </div>
                    <div class="mb-3">
                        <label class="form-label text-right">شماره موبایل </label>
                        <input type="text" class="form-control form-start" name="phone">

                    </div>
                    <div class="mb-3">
                        <label class="form-label ">کد ملی </label>
                        <input type="text" class="form-control form-start" name="national_code">

                    </div>
                    <div class="mb-3">
                        <label class="form-label text-right">پسورد </label>
                        <input type="password" class="form-control form-start" name="password">

                    </div>
                    <div class="mb-3">
                        <label class="form-label ">تکرار پسورد </label>
                        <input type="password" class="form-control form-start" name="confirm">

                    </div>

                    <button type="submit" class="btn btn-outline-secondary" name="submit">ثبت نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</html>