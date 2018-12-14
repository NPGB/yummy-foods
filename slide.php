<div class="slide">
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php 
                foreach ($imgslide as $key => $value) {
                    ?>
                    <div class="class-item">
                        <img class="style-img" src="assets/img/product/<?php echo $value ?>" alt="">
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>