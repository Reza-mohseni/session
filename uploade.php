<?php

//index.php
$file_names=[];
$connect = new PDO("mysql:host=localhost;dbname=images", "root", "");

$message = '';
$watermark_image='';
// ایجاد یک شیء ZipArchive
$zip = new ZipArchive();

// نام فایل زیپ که می‌خواهید ایجاد کنید
$zip_filename = "uploads/"."zip_".uniqid()."_".date("d-m-Y-H-i-s").'.zip';

if (isset($_POST["upload"])) {
    if (!empty($_FILES["select_image"]["name"])) {
//تنظیمات مربوط به واترمارک
        $extension_watermark = pathinfo($_FILES["select_image_watermark"]["name"], PATHINFO_EXTENSION);
        $allow_extension_watermark = array('jpg', 'png', 'jpeg');
        $file_name_watermark = uniqid() . '.' . $extension_watermark;
        $upload_location_watermark = 'uploads/watermark/' . $file_name_watermark;

// بارگذاری تصویر
        $source_image = imagecreatefromstring(file_get_contents($_FILES["select_image_watermark"]["tmp_name"]));
// تعیین ابعاد جدید تصویر
        $newWidth = 50; // عرض جدید
        $newHeight = 50; // ارتفاع جدید

// ایجاد تصویر خالی با پس‌زمینه شفاف
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        $transparentColor = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127); // رنگ پس‌زمینه شفاف
        imagefill($resizedImage, 0, 0, $transparentColor);

// بارگذاری تصویر اصلی
        $source_image = imagecreatefromstring(file_get_contents($_FILES["select_image_watermark"]["tmp_name"]));

// تنظیم پس‌زمینه شفاف در تصویر اصلی
        imagecolortransparent($source_image, $transparentColor);

// تغییر اندازه تصویر
        imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($source_image), imagesy($source_image));

// ذخیره تصویر تغییر اندازه‌داده شده با پس‌زمینه شفاف
        if ($extension_watermark == 'jpg' || $extension_watermark == 'jpeg') {
            imagejpeg($resizedImage, $upload_location_watermark);


        } elseif ($extension_watermark == 'png') {
            imagepng($resizedImage, $upload_location_watermark);



        }

// آزادسازی حافظه
        imagedestroy($source_image);
        imagedestroy($resizedImage);

////////////////////////////
//شروع واترمارک سازی
        if ($zip->open($zip_filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

            for ($i = 0; $i < count($_FILES["select_image"]["name"]); $i++) {
            $extension = pathinfo($_FILES["select_image"]["name"][$i], PATHINFO_EXTENSION);
            $allow_extension = array('jpg', 'png', 'jpeg');
            $file_name = uniqid() . '.' . $extension;
            $upload_location = 'uploads/' . $file_name;
            $file_names[$i]=$file_name;

            if (in_array($extension_watermark, $allow_extension)) {
                $image_size = $_FILES["select_image"]["size"][$i];

                if (move_uploaded_file($_FILES["select_image"]["tmp_name"][$i], $upload_location)) {
                    if ($extension_watermark == 'jpg' || $extension_watermark == 'jpeg') {
                        $watermark_image = imagecreatefromjpeg($upload_location_watermark);

                    } elseif ($extension_watermark == 'png') {

                        $watermark_image = imagecreatefrompng($upload_location_watermark);

                    }
                    if ($extension == 'jpg' || $extension == 'jpeg') {
                        $image = imagecreatefromjpeg($upload_location);

                    }

                    if ($extension == 'png') {
                        $image = imagecreatefrompng($upload_location);
                    }


                    $newWidth = $_POST['image_size_Width']; // عرض جدید
                    $newHeight = $_POST['image_size_Height']; // ارتفاع جدید


                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));

                    $margin_left = 10; // فاصله از حاشیه چپ
                    $margin_bottom = 10; // فاصله از حاشیه پایین

                    $watermark_image_width = imagesx($watermark_image); // عرض تصویر واترمارک
                    $watermark_image_height = imagesy($watermark_image); // ارتفاع تصویر واترمارک

                   // افزودن واترمارک به تصویر
                    imagecopy(
                        $resizedImage,
                        $watermark_image,
                        $margin_left,
                        imagesy($resizedImage) - $watermark_image_height - $margin_bottom,
                        0,
                        0,
                        $watermark_image_width,
                        $watermark_image_height
                    );


                    imagepng($resizedImage, $upload_location);

                    // افزودن فایل واترمارک شده به فایل زیپ
                    $zip->addFile($upload_location, $file_name);


                    imagedestroy($image);
                    imagedestroy($resizedImage);
                    if (file_exists($upload_location)) {
                        $message = "تصویر همراه با واترمارک ایجاد شد";
                        $data = array(
                            ':image_name' => $file_name
                        );
                        $query = "INSERT INTO images_table 
                            (image_name, upload_datetime) 
                            VALUES (:image_name, now())";
                        $statement = $connect->prepare($query);
                        $statement->execute($data);
                    } else {
                        $message = "ایجاد تصویر با خطا مواجه شد";
                    }
                } else {
                    $message = "انتقال تصویر با خطا مواجه شد";
                }
            } else {
                $message = 'حهت آپلود فایل فقط فرمت های jpg, .png و .jpeg مجاز است';
            }


            }
            $zip->close();

            // مسیر فایل زیپ را در یک متغیر بریزید
            $zip_path = realpath('zip/' . $zip_filename).$zip_filename;

            for ($i = 0; $i < count($_FILES["select_image"]["name"]); $i++){
                unlink("uploads/".$file_names[$i]);
            }



        }else {
            // خطا در باز کردن فایل زیپ
            $message = 'خطا در ایجاد فایل زیپ';
        }
    } else {
        $message = 'لطفاً عکس های خود را انتخاب کنید';
    }
}

$query = "
SELECT * FROM images_table 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();



?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>واترمارک زدن بر روی تصاویر</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
<br />
<div class="container">
    <h3 align="center">اعمال واترمارک به عکس</h3>
    <br />
    <?php
    if($message != '')
    {
        echo '
        <div class="alert alert-info">
        '.$message.'
        </div>
        ';
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">تصویر واترمارک و تصویر های اصلی خود را وارد کنید</div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group">

                        <div class="col-md-6">
                            <label >انتخاب عکس ها</label>
                            <input type="file"  name="select_image[]" accept="image/png, image/jpeg, .jpg, .jpeg" multiple />
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label >انتخاب عکس واترمارک</label>

                            <input type="file" name="select_image_watermark" accept="image/png, image/jpeg, .jpg, .jpeg" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label  >ارتفاع تصویر خروجی را مشخص کنید</label>
                            <input type="text" name="image_size_Height"  />
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label >عرض تصویر خروجی را مشخص کنید</label>

                            <input type="text" name="image_size_Width" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="form-group" align="center">
                    <input type="submit" name="upload" class="btn btn-primary" value="آپلود" />
                    <br />
                    <br />
                    <?php
                    if (!empty($zip_path)) {
                        echo '<a href="' . $zip_path . '" class="btn btn-primary">دانلود فایل نهایی</a>';
                    }
                    ?>
                    <br />
                    <br />
                    <?php
                    if (!empty($zip_path)) {
                        $lastRecord = end($result);
                        echo '<p class="btn btn-primary">تعداد عکس هایی که برای شما واتر مارک زدم : ' . $lastRecord["id"] . '</p>';
                    }
                    ?>

                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

