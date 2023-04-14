<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
        @font-face {
            font-family: IRANSansWebFaNum-med;
            font-style: normal;
            font-weight: 100;
            src: url("fonts/woff/IRANSansX-Medium.woff") format("woff"),
            url("fonts/woff2/IRANSansX-Medium.woff2") format("woff2");
        }

        @font-face {
            font-family: IRANSansWebFaNum-bold;
            font-style: normal;
            font-weight: 500;
            src: url("fonts/woff/IRANSansX-Bold.woff") format("woff"),
            url("fonts/woff2/IRANSansX-Bold.woff2") format("woff2");
        }

        .h3 {
            font-family: "IRANSansWebFaNum-bold";
        }
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
                    <form method="post" class="numbers">
                        <div class="mb-3">
                            <label class="form-label text-right">نام </label>
                            <input type="text" class="form-control form-start" name="name">

                        </div>
                        <div class="mb-3">
                            <label class="form-label ">نام خانوادگی </label>
                            <input type="text" class="form-control form-start" name="lastname">

                        </div>
                        <div class="mb-3">
                            <label class="form-label text-right">شماره موبایل </label>
                            <input type="text" class="form-control form-start" name="phone">

                        </div>
                        <div class="mb-3">
                            <label class="form-label ">کد ملی </label>
                            <input type="text" class="form-control form-start" name="meli">

                        </div>
                        <div class="mb-3">
                            <label class="form-label text-right">پسورد </label>
                            <input type="password" class="form-control form-start" name="pass">

                        </div>
                        <div class="mb-3">
                            <label class="form-label ">تکرار پسورد </label>
                            <input type="password" class="form-control form-start" name="passrep">

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