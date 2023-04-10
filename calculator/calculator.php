<?php


{
//Adding the first number to the second number
    if(isset($_POST['sum'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2!=""||$number1!="") {

            $result = $number1 + $number2;
        }else {
            echo "<script >alert('لطفا اعداد را به طور کامل بدهید.')</script>";
        }
    }

// Subtract the first number from the second number
    if(isset($_POST['min'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2!=""||$number1!="") {

            $result = $number1 - $number2;
        }else {
            echo "<script >alert('لطفا اعداد را به طور کامل بدهید.')</script>";
        }
    }

//  Multiply the first number by the second number
    if(isset($_POST['mul'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2!=""||$number1!="") {

            $result = $number1 * $number2;
        }else {
            echo "<script >alert('لطفا اعداد را به طور کامل بدهید.')</script>";
        }
    }

//  Dividing the first number by the second number
    if(isset($_POST['div'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2!=""||$number1!="") {

            $result = $number1 / $number2;
        }else {
            echo "<script >alert('لطفا اعداد را به طور کامل بدهید.')</script>";
        }
    }

//  To be able to reach the first number to the second target
    if(isset($_POST['pow'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2!=""||$number1!="") {

            $result = pow($number1,$number2);
        }else {
            echo "<script >alert('لطفا اعداد را به طور کامل بدهید.')</script>";
        }
    }


//  Taking the square root of a prime number
    if(isset($_POST['root'])){
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        if ($number2==""){
            if ($number1!="") {
            $result = sqrt($number1);
        }else {
            echo "<script >alert('لطفا برای گرفتن جذر یک عدد فقط عدد اول را پر کنید')</script>";
        }
        }else {
            echo "<script >alert(' لطفا فقظ عدد اول را پر کنید')</script>";
        }
    }
}


?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ماشین حساب</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .btn{
            margin-top: 10px;
        }
        </style>
</head>
<body dir="rtl">

<div class="container">
        <div class="row">
            <div class="col-8 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="text-center"> ماشین حساب</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" class="numbers">
                            <div class="mb-3">
                                <label class="form-label text-right">عدد اول </label>
                                <input type="number" class="form-control form-start" name="number1">

                            </div>
                            <div class="mb-3">
                                <label class="form-label ">عدد دوم </label>
                                <input type="number" class="form-control form-start" name="number2">

                            </div>
                            <button type="submit" class="btn btn-info" name="sum">+</button>
                            <button type="submit" class="btn btn-danger" name="min">-</button>
                            <button type="submit" class="btn btn-outline-primary" name="mul">*</button>
                            <button type="submit" class="btn btn-dark" name="div">/</button>
                            <button type="submit" class="btn btn-info" name="pow">pow</button>
                            <button type="submit" class="btn btn-outline-secondary" name="root">root</button>
                        </form>

                            <?php
                            if (isset($result)){
                            ?>
                                <div class="alert-info">نتیجه: <?php echo  $result?></div>
                            <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


<!--    get bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
<style>
</html>