<footer class="container">
    <div class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="assets/img/<?php echo $config['logo']; ?>" alt="" width="50" height="50">
                <small class="d-block mb-3 text-muted">NPGB &copy; 2018</small>
            </div>
            <?php
                foreach ($footer as $h5 => $array) {
                    ?>
                    <div class="col-6 col-md">
                        <h5><?php echo $h5 ?></h5>
                        <ul class="list-unstyled text-small">
                        <?php
                        foreach ($array as $key => $value) {
                            ?>
                            <li><a class="text-muted" href="<?php echo $value ?>"><?php echo $key ?></a></li>
                            <?php
                        }
                        ?>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</footer>