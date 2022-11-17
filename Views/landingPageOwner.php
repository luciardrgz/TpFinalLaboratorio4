<?php

namespace Views;

include("navOwner.php");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Owner Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "landingPage.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <!-- Carousel -->
    <div class="carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo FRONT_ROOT . IMG_PATH . "bannerImage1.jpg" ?>" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "bannerImage2.jpg" ?>" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo FRONT_ROOT . IMG_PATH . "bannerImage3.jpg" ?>" class="d-block w-100">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </div>

    <div class="error-msg">
        <?php if (isset($_GET['message'])) { ?>
        <div class="alert alert-danger">
            <?php echo $_GET['message']; ?>
        </div>
        <?php } ?>
    </div>

    <!-- Cards -->
    <div class="container">

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="ownerCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card1.png" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>Don't leave your pet alone!</b></h5>
                        <h6 align='center'>Away from home for a few days and can't take your pet with you? Pet Hero
                            <b>helps you</b>
                        </h6>
                    </div>
                </div>
            </div>

            <div class="ownerCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card2.jpg" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>An exceptional experience</b></h5>
                        <h6 align='center'>Pet Hero guardians are rated by <b>owners who trusted them</b>, so
                            neither you nor your pet will have any surprises
                        </h6>
                    </div>
                </div>
            </div>

            <div class="ownerCol">
                <div class="card">
                    <img src="<?php echo  FRONT_ROOT . IMG_PATH . "card3.jpg" ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 align='center'><b>They'll have a wonderful time</b></h5>
                        <h6 align='center'>Our guardians will not only provide food and water for your pet, they'll
                            will also spend <b>quality time</b> with them :)
                        </h6>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <!-- Us  -->
    <div class="home-footer">
        Lab 4 2022 - <b>Alemán Tomás, Lalli Brian, Rodriguez Lucía</b>
    </div>

</body>

</html>