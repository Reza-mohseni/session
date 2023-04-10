<?php
/*
 @The title  of the project is to remove the empty space before and after
this function return array
  */
function myinfo()
{
    $name="      RezaMohseni " ;
    $age=19;
    return ["your name is: " , $name , "your age is: " , $age];
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
/*
variable return array
*/
$valiu=myinfo();
$val1= $valiu[0].$valiu[1]."<br>".$valiu[2].$valiu[3];
//function trim remove empty space
$string_2 = trim($val1);
echo($string_2);

?>
</body>
</html>
