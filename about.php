<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
    </head>
<body>
    <?php 
        $config = include('config/config.php'); 
        include('config/page_config.php');
        include('header.php');
    ?>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="assets/img/<?php echo $config['logo']; ?>" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <p><?php echo $config['name_store'] ?></p>
                    <p><?php echo $config['address'] ?></p>
                    <p>day la cho viet may cau gioi thieu nhung bao h ranh se viet dua nao co doc may dong nay thi bam nut bien gium</p>
                </div>
            </div>
        </div>
    </section>
    <?php
        include('footer.php');
    ?>
</body>
</html>