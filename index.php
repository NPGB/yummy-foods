<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/products_page.css">
    <!-- css cua owl -->
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/owlcarousel/slide.js"></script>
    <!-- js cua owl -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/owlcarousel/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <?php 
        $config = include('config/config.php'); 
        include('config/page_config.php');
        include('header.php');
        include('slide.php');
        include('products_page.php');
        include('footer.php');
    ?>
</body>
    <script>
        $('.owl-carousel').owlCarousel({
            items:1,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true
        });

        function loadDoc(url, cFunction) {
            var xhttp = new XMLHttpRequest(url, cFunction);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cFunction(this);
                // document.getElementById("products").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        

        function search(xhttp) {
            document.getElementById("products").innerHTML = xhttp.responseText;
        } 

        function category(xhttp) {
            document.getElementById("category").innerHTML = xhttp.responseText;
        } 

        function addtocart(xhttp) {
            document.getElementById(id).innerHTML = 'added to shopping cart';
        } 

        function setid(a) {
            id = a;
        }
</script>
</html>