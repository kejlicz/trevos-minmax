<?php
require "src/MinMax.php";
$minMax = new \Trevos\MinMax();
?><!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Trevos - MinMax</title>
    <?php echo $minMax->proccessForm();?>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Trevos - MinMax</h1>

            <?php echo $minMax->renderForm(); ?>

            <?php echo $minMax->renderMatrix(); ?>

        </div>
    </div>
</div>


</body>
</html>